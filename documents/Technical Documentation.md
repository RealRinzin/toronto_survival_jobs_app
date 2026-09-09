# Toronto Survival Jobs — Technical Documentation

**Course:** HTTP 5310 — Capstone Project
**Instructors:** Bernie Monette & Sean Doyle
**Author:** Rinzin
**Document Version:** 1.0

---

## 1. Project Overview

Toronto Survival Jobs is a job-search platform aimed at people who need accessible entry-level employment in Toronto — new immigrants, high school students on summer break, college students, recent graduates, and asylum seekers. Rather than requiring users to check individual company career pages, the platform aggregates postings from supported companies (retail, grocery, food service, warehousing, customer service, and similar industries) into a single searchable database, and keeps that database fresh through automated scraping and expiry cleanup.

### 1.1 Goals

- Centralize survival-job postings from multiple company career pages into one searchable index.
- Let users filter by job role, location, company, and employment type.
- Keep listings current with minimal admin effort via scheduled scraping and automatic deactivation of expired postings.
- Notify subscribed users by email when new jobs matching their interests appear.

### 1.2 Out of Scope (v1)

- Direct application submission through the platform (postings link out to the source).
- Employer-facing self-service portal (job entry is admin-managed in v1).
- Resume building / applicant tracking.

---

## 2. System Architecture

### 2.1 High-Level Architecture

```
                        ┌─────────────────────────┐
                        │   Next.js Frontend       │
                        │  (SSR/SSG, React, TS)    │
                        └───────────┬──────────────┘
                                    │ REST / JSON (HTTPS)
                                    ▼
                        ┌─────────────────────────┐
                        │   Laravel Backend API    │
                        │  Controllers, Auth,      │
                        │  Policies, Jobs, Queue    │
                        └──────┬───────────┬───────┘
                                │           │
                    ┌───────────┘           └───────────┐
                    ▼                                    ▼
          ┌───────────────────┐              ┌───────────────────────┐
          │   MySQL Database   │              │  Scraper Workers        │
          │  (job postings,    │              │  (Laravel Queue Jobs +  │
          │  users, companies) │              │  Scheduler / cron)      │
          └───────────────────┘              └───────────┬───────────┘
                                                            │
                                                            ▼
                                              ┌───────────────────────┐
                                              │ External Company        │
                                              │ Career Pages (scraped)  │
                                              └───────────────────────┘

          ┌───────────────────────┐
          │ ipwho.is (Location API) │  ← consumed by frontend/backend for
          └───────────────────────┘     geolocation-based job suggestions
```

All components are containerized and run behind a reverse proxy on Ubuntu 26 LTS.

### 2.2 Component Responsibilities

| Component             | Responsibility                                                                                                                      |
| --------------------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| Next.js Frontend      | Renders search UI, job details, favourites, subscription management, auth flows (social + email)                                    |
| Laravel Backend API   | Auth, authorization, CRUD for companies/roles/employment types, search/filter API, favourites, subscriptions, notification dispatch |
| MySQL                 | Persistent storage for all relational data                                                                                          |
| Scraper / System Jobs | Scheduled scraping of career pages, posting ingestion, expired-posting deactivation                                                 |
| Docker                | Packages frontend, backend, database, and queue worker as isolated, reproducible services                                           |

---

## 3. Technology Stack

| Layer            | Technology                                                                                    |
| ---------------- | --------------------------------------------------------------------------------------------- |
| Frontend         | Next.js (React, TypeScript)                                                                   |
| Backend API      | Laravel (PHP)                                                                                 |
| Database         | MySQL                                                                                         |
| Containerization | Docker / Docker Compose                                                                       |
| Server OS        | Ubuntu 2026 LTS                                                                               |
| Geolocation      | [ipwho.is](https://ipwho.is) — IP-based location lookup for job suggestions                   |
| Scheduled Jobs   | Laravel Task Scheduler (`schedule:run` via system cron) + Laravel Queues for scrape workloads |
| Auth             | Laravel session/token auth + social login (OAuth)                                             |

### 3.1 Suggested Package Additions

- **Backend:** `laravel/socialite` (social login), `laravel/sanctum` (API token auth for the Next.js SPA/SSR client), a queue driver (`database` or `redis`) for scraping jobs, an HTTP scraping toolkit (`guzzlehttp/guzzle` + a DOM parser such as `symfony/dom-crawler`).
- **Frontend:** `react-hook-form` for search/filter and subscription forms, a data-fetching layer (`fetch`/`axios` wrapped in a typed API client) for talking to the Laravel API.

---

## 4. Database Schema

### 4.1 Entity-Relationship Summary

```
users ──< saved_jobs >── job_postings ──> companies
users ──< subscriptions                  job_postings ──> roles
companies ──< job_postings               job_postings ──> employment_types
```

### 4.2 Core Tables

**`users`**
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | varchar | |
| email | varchar, unique | |
| password | varchar, nullable | null if social-login-only |
| social_provider | varchar, nullable | e.g. `google`, `facebook` |
| social_provider_id | varchar, nullable | |
| role | enum(`user`,`admin`) | default `user` |
| location_lat / location_lng | decimal, nullable | populated via ipwho.is |
| created_at / updated_at | timestamp | |

**`companies`**
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | varchar | |
| career_page_url | varchar | scrape target |
| scrape_config | json, nullable | selectors/config for the scraper |
| is_active | boolean | admin can pause scraping per company |
| created_at / updated_at | timestamp | |

**`roles`** (job roles, e.g. "Sales Associate" — distinct from user auth roles)
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | varchar | |
| created_at / updated_at | timestamp | |

**`employment_types`**
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | varchar | e.g. Full-time, Part-time, Seasonal |

**`job_postings`**
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| company_id | FK → companies | |
| role_id | FK → roles | |
| employment_type_id | FK → employment_types | |
| title | varchar | |
| description | text | |
| location | varchar | |
| latitude / longitude | decimal, nullable | for proximity sorting |
| source_url | varchar | link back to original posting |
| external_id | varchar, nullable | dedupe key from source page |
| is_active | boolean | default true; set false by daily cleanup job |
| posted_at | timestamp, nullable | |
| scraped_at | timestamp | last time this posting was seen |
| created_at / updated_at | timestamp | |

**`saved_jobs`** (favourites)
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | |
| job_posting_id | FK → job_postings | |
| created_at | timestamp | |

**`subscriptions`**
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| user_id | FK → users | |
| role_id | FK → roles, nullable | |
| company_id | FK → companies, nullable | |
| location | varchar, nullable | |
| created_at | timestamp | |

**`scrape_logs`** (recommended for observability, not in original spec)
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| company_id | FK → companies | |
| run_at | timestamp | |
| status | enum(`success`,`failed`,`partial`) | |
| jobs_found / jobs_added / jobs_updated | int | |
| error_message | text, nullable | |

---

## 5. API Design

Base path: `/api/v1`

### 5.1 Public / Job Seeker Endpoints

| Method   | Endpoint                                        | Description                                                                                         |
| -------- | ----------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| POST     | `/auth/register`                                | Email registration                                                                                  |
| POST     | `/auth/login`                                   | Email/password login                                                                                |
| GET/POST | `/auth/social/{provider}/redirect`, `/callback` | Social login (Socialite)                                                                            |
| GET      | `/jobs`                                         | Search/filter job postings — query params: `role`, `location`, `company`, `employment_type`, `page` |
| GET      | `/jobs/{id}`                                    | Job posting detail                                                                                  |
| POST     | `/jobs/{id}/save`                               | Save job to favourites (auth required)                                                              |
| DELETE   | `/jobs/{id}/save`                               | Remove from favourites (auth required)                                                              |
| GET      | `/me/saved-jobs`                                | List current user's saved jobs (auth required)                                                      |
| POST     | `/me/subscriptions`                             | Create a subscription (role/company/location) (auth required)                                       |
| DELETE   | `/me/subscriptions/{id}`                        | Cancel a subscription (auth required)                                                               |
| GET      | `/roles`, `/companies`, `/employment-types`     | Lookup lists for search filters                                                                     |

### 5.2 Admin Endpoints (role: `admin`)

| Method     | Endpoint                           | Description                                          |
| ---------- | ---------------------------------- | ---------------------------------------------------- |
| POST       | `/admin/companies`                 | Add a company (name, career page URL, scrape config) |
| PUT/DELETE | `/admin/companies/{id}`            | Update/remove company                                |
| POST       | `/admin/roles`                     | Add job role                                         |
| POST       | `/admin/employment-types`          | Add employment type                                  |
| GET        | `/admin/scrape-logs`               | View scraper run history                             |
| POST       | `/admin/companies/{id}/scrape-now` | Manually trigger a scrape (ops convenience)          |

### 5.3 Authorization Model

- Implemented with Laravel **Policies** / **Gates**, keyed off `users.role`.
- Sanctum-issued tokens authenticate the Next.js client; admin routes are additionally guarded by an `EnsureUserIsAdmin` middleware.

---

## 6. User Roles & Permissions

| Capability                                  | Job Seeker | Admin |     System     |
| ------------------------------------------- | :---------: | :---: | :------------: |
| Search & filter jobs                        |     ✅      |  ✅   |       —        |
| Save jobs to favourites                     |     ✅      |  ✅   |       —        |
| Subscribe to role/company/location alerts   |     ✅      |  ✅   |       —        |
| Login via social or email                   |     ✅      |  ✅   |       —        |
| Add/edit companies, roles, employment types |     ❌      |  ✅   |       —        |
| Scrape company career pages                 |     ❌      |  ❌   | ✅ (scheduled) |
| Deactivate expired postings                 |     ❌      |  ❌   | ✅ (scheduled) |

---

## 7. Scheduled Jobs (System Role)

Implemented via Laravel's task scheduler (`app/Console/Kernel.php`), driven by a single system cron entry (`* * * * * php artisan schedule:run`) as recommended by Laravel.

| Job                         | Schedule                              | Description                                                                                                                                                                              |
| --------------------------- | ------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `ScrapeCompanyPostings`     | Daily at **12:30 PM** and **7:00 PM** | Iterates active companies, fetches career pages, parses postings, upserts into `job_postings` (dedupe via `external_id` or a hash of title+company+location), writes a `scrape_logs` row |
| `DeactivateExpiredPostings` | Daily at **12:00 AM**                 | Flags postings as `is_active = false` where they are no longer present on the source page or have passed an inferred expiry window                                                       |

```php
// app/Console/Kernel.php (illustrative)
protected function schedule(Schedule $schedule): void
{
    $schedule->job(new ScrapeCompanyPostings)->dailyAt('12:30');
    $schedule->job(new ScrapeCompanyPostings)->dailyAt('19:00');
    $schedule->job(new DeactivateExpiredPostings)->dailyAt('00:00');
}
```

Scrape jobs are dispatched onto a **queue** (rather than run synchronously) so a slow or failing company scrape doesn't block others; each company is scraped in its own queued job with retry/backoff.

---

## 8. External Integrations

### 8.1 ipwho.is (Location API)

- Used to resolve a visitor's approximate location from IP address for location-aware job suggestions (e.g., defaulting search results to "near you").
- Called client-side (or backend-proxied, to avoid exposing rate limits/behavior to the browser) on first visit; result cached in the user's session or profile (`users.location_lat` / `location_lng`) to avoid repeat lookups.
- Should degrade gracefully — if the lookup fails or is blocked (VPN, privacy extensions), fall back to manual location entry in the search filters.

---

## 9. Feature Requirements (MoSCoW)

### Must Have

- **Job Seeker:** login via social login or email; save favourite jobs; search by location, role, and company.
- **Admin:** add companies (with details), job roles (e.g. Sales Associate), and employment types (Full-time / Part-time / etc.).
- **System:** scrape company career pages daily at 12:30 PM and 7:00 PM; deactivate expired postings daily at 12:00 AM.

### Should Have

- User-facing job search (general search capability beyond structured filters).

### Nice to Have

- Subscriptions to specific job roles, companies, or locations, with email notifications when matching jobs are added.

---

## 10. Non-Functional Requirements

| Category      | Requirement                                                                                                                                                                |
| ------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Reliability   | Scraping failures for one company must not block scraping of others; failed runs are logged and retryable                                                                  |
| Performance   | Job search/filter endpoint should return paginated results; consider indexing `job_postings` on `role_id`, `company_id`, `employment_type_id`, `location`, and `is_active` |
| Security      | Passwords hashed (bcrypt/argon2 via Laravel default); admin routes protected by role-based middleware; scraping respects each target site's terms of use and `robots.txt`  |
| Portability   | Entire stack (frontend, backend, DB, queue worker) runs via Docker Compose for consistent local/staging/production environments                                            |
| Observability | `scrape_logs` table plus application logging for scrape success/failure counts                                                                                             |

---

## 11. Deployment Architecture

Proposed Docker Compose services:

| Service              | Image basis             | Notes                                                                      |
| -------------------- | ----------------------- | -------------------------------------------------------------------------- |
| `frontend`           | Node (Next.js build)    | Served via Node runtime or exported to a static/CDN layer where applicable |
| `backend`            | PHP-FPM + Laravel       | Application code, Artisan CLI                                              |
| `queue-worker`       | Same image as `backend` | Runs `php artisan queue:work` for scrape jobs                              |
| `scheduler`          | Same image as `backend` | Runs cron → `php artisan schedule:run` every minute                        |
| `db`                 | MySQL                   | Persistent volume for data                                                 |
| `nginx` (or similar) | Reverse proxy           | Routes `/api/*` to backend, everything else to frontend; TLS termination   |

Host: Ubuntu 2026 LTS.

---

## 12. Narrative Flows (Reference)

- **Job Seeker:** Searches for roles such as Grocery Clerk, Sales Associate, Cashier, or Customer Service Representative; narrows by location, company, or employment type; saves useful postings to favourites; optionally subscribes to a role/company/location for email alerts.
- **Admin:** Maintains companies, job roles, and employment types; relies on scheduled jobs to keep listings current, reducing manual upkeep.
- **System:** Scrapes supported career pages twice daily (12:30 PM, 7:00 PM) to ingest new postings, and runs a nightly cleanup (12:00 AM) to deactivate postings that are no longer live.

---

## 13. Future Enhancements

- Employer self-service portal for direct posting management.
- In-app application submission / resume attachment.
- SMS notifications alongside email subscriptions.
- Admin dashboard analytics (scrape success rates, most-searched roles/locations).
- Multi-language UI to better serve the newcomer/asylum-seeker user base.

---

_This document translates the HTTP 5310 Capstone Project Overview into an implementation-oriented technical reference. Schema, API routes, and NFRs beyond the original overview (e.g. `scrape_logs`, indexing notes) are proposed additions to support the stated features and should be validated against final course requirements._
