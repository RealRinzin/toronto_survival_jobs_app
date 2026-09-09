# Toronto Survival Jobs — Requirements Documentation

**Course:** HTTP 5310 — Capstone Project
**Instructors:** Bernie Monette & Sean Doyle
**Author:** Rinzin
**Document Version:** 1.0
**Companion document:** Toronto Survival Jobs — Technical Documentation

---

## 1. Introduction

### 1.1 Purpose

This document specifies the functional and non-functional requirements for Toronto Survival Jobs, a job-search platform that aggregates entry-level "survival job" postings from multiple Toronto-area companies into a single, searchable location. It is intended to guide design, implementation, and testing, and to serve as the basis for acceptance of the delivered system.

### 1.2 Intended Audience

Developers, project evaluators/instructors, and anyone assessing whether the delivered platform meets its stated goals.

### 1.3 Project Scope

Toronto Survival Jobs collects job postings from supported companies' career pages, stores them centrally, and lets users search and filter that data by role, location, company, and employment type. Registered users can save favourite postings and subscribe to alerts for specific roles, companies, or locations. Administrators manage the reference data (companies, roles, employment types); a system role keeps postings current through scheduled scraping and expiry cleanup.

**In scope:** job aggregation, search/filter, favourites, email-alert subscriptions, admin management of companies/roles/employment types, automated scraping and posting lifecycle management.

**Out of scope (v1):** in-app job applications, an employer self-service portal, resume/ATS functionality.

### 1.4 Definitions

| Term | Definition |
|---|---|
| Survival job | Accessible, typically entry-level work (retail, grocery, food service, warehousing, customer service) sought by newcomers, students, and asylum seekers |
| Posting | A single job listing ingested from a supported company's career page |
| Scraping | Automated retrieval and parsing of job postings from an external career page |
| Subscription | A user's standing request to be emailed when new postings match a role, company, or location |

---

## 2. Stakeholders

| Stakeholder | Interest |
|---|---|
| Job Seekers (newcomers, students, asylum seekers, job seekers) | Find accessible jobs quickly, in one place, without visiting many sites |
| Administrators | Keep company/role/employment-type reference data accurate with minimal manual effort |
| System (automated processes) | Keep the posting database fresh without human intervention |
| Course instructors / evaluators | Assess the platform against the capstone brief |

---

## 3. Functional Requirements

Requirements are grouped by user role and numbered for traceability (`FR-<Role>-<n>`). Priority follows MoSCoW as given in the project overview.

### 3.1 Job Seeker

| ID | Requirement | Priority |
|---|---|---|
| FR-U-1 | The system must allow a user to register and log in using either a social login provider or an email address/password. | Must |
| FR-U-2 | The system must allow a user to search job postings. | Should |
| FR-U-3 | The system must allow a user to filter search results by location. | Must |
| FR-U-4 | The system must allow a user to filter search results by job role. | Must |
| FR-U-5 | The system must allow a user to filter search results by company. | Must |
| FR-U-6 | The system should allow a user to filter search results by employment type. | Should |
| FR-U-7 | The system must allow an authenticated user to save a job posting to a personal favourites list for later reference. | Must |
| FR-U-8 | The system must allow an authenticated user to remove a posting from their favourites. | Must |
| FR-U-9 | The system must allow an authenticated user to view their list of saved jobs. | Must |
| FR-U-10 | The system should suggest jobs near the user's location using IP-based geolocation. | Should |
| FR-U-11 | The system may allow an authenticated user to subscribe to a specific job role, company, or location and receive an email notification when a matching job is added. | Nice to have |
| FR-U-12 | The system may allow a user to cancel an existing subscription. | Nice to have |

### 3.2 Admin

| ID | Requirement | Priority |
|---|---|---|
| FR-A-1 | The system must allow an admin to add a new company, including its name, career page details, and any scrape configuration needed to parse it. | Must |
| FR-A-2 | The system must allow an admin to edit or deactivate an existing company. | Must |
| FR-A-3 | The system must allow an admin to add a new job role (e.g., "Sales Associate"). | Must |
| FR-A-4 | The system must allow an admin to add a new employment type (e.g., Full-time, Part-time). | Must |
| FR-A-5 | The system should allow an admin to view a history/log of scraping runs, including success/failure status. | Should |
| FR-A-6 | The system should allow an admin to manually trigger a scrape for a specific company outside the regular schedule. | Should |
| FR-A-7 | Admin-only actions must be restricted to users with the admin role. | Must |

### 3.3 System (Automated)

| ID | Requirement | Priority |
|---|---|---|
| FR-S-1 | The system must automatically scrape each active, supported company's career page daily at 12:30 PM. | Must |
| FR-S-2 | The system must automatically scrape each active, supported company's career page daily at 7:00 PM. | Must |
| FR-S-3 | The system must parse scraped postings and add new, relevant postings to the job database. | Must |
| FR-S-4 | The system must avoid creating duplicate postings for jobs already present in the database (dedupe by source identifier or equivalent). | Must |
| FR-S-5 | The system must automatically deactivate expired or no-longer-available job postings daily at 12:00 AM. | Must |
| FR-S-6 | A failure to scrape one company must not prevent scraping of other companies in the same run. | Should |
| FR-S-7 | Each scrape run should be logged with counts of jobs found/added/updated and any error encountered. | Should |

---

## 4. Non-Functional Requirements

| ID | Category | Requirement |
|---|---|---|
| NFR-1 | Performance | Search/filter results must be paginated and return within an acceptable response time under normal load (target: under ~1s server-side for a filtered query against the indexed dataset). |
| NFR-2 | Reliability | Scheduled scraping and deactivation jobs must run unattended and recover gracefully from a single failed run (retry on next scheduled execution). |
| NFR-3 | Availability | The platform should be available during standard usage hours; scheduled maintenance should avoid the 12:30 PM / 7:00 PM scrape windows and the 12:00 AM cleanup window where possible. |
| NFR-4 | Security | User passwords must be stored hashed, never in plaintext; admin-only endpoints must be inaccessible to Job Seekers; social login must use standard OAuth flows. |
| NFR-5 | Privacy | Location data obtained via IP lookup must be used only for job-suggestion purposes and not exposed to other users. |
| NFR-6 | Portability | The application must be deployable via Docker containers on Ubuntu 2026 LTS, with environment-based configuration (no hardcoded secrets). |
| NFR-7 | Maintainability | Company scrape configurations must be data-driven (stored per company) rather than hardcoded per site, so admins can onboard new companies without a code change. |
| NFR-8 | Usability | Search and filter controls must be usable by non-technical users, including first-time visitors who have not created an account. |
| NFR-9 | Compliance | Scraping must respect each target career page's terms of use / `robots.txt`. |
| NFR-10 | Accessibility | Core user flows (search, view posting, save favourite) should be usable without requiring an account, to minimize friction for the target user base. |

---

## 5. Use Cases

### UC-1: Search for a Job

- **Actor:** Job Seeker (authenticated or anonymous)
- **Preconditions:** None
- **Main flow:**
  1. User navigates to the search page.
  2. User enters or selects filter criteria (role, location, company, employment type).
  3. System returns a paginated list of matching, active postings.
  4. User opens a posting to view full details.
- **Postconditions:** User has viewed relevant postings.
- **Related requirements:** FR-U-2 through FR-U-6

### UC-2: Save a Favourite Job

- **Actor:** Authenticated Job Seeker
- **Preconditions:** User is logged in; a job posting is displayed.
- **Main flow:**
  1. User selects "Save" on a posting.
  2. System adds the posting to the user's favourites.
  3. User can later view it from their favourites list.
- **Related requirements:** FR-U-7, FR-U-8, FR-U-9

### UC-3: Subscribe to Job Alerts

- **Actor:** Authenticated Job Seeker
- **Preconditions:** User is logged in.
- **Main flow:**
  1. User specifies a role, company, and/or location to watch.
  2. System stores the subscription.
  3. When a new matching posting is added by the scraper, the system emails the user.
- **Related requirements:** FR-U-11, FR-U-12

### UC-4: Add a Company (Admin)

- **Actor:** Admin
- **Preconditions:** Admin is logged in.
- **Main flow:**
  1. Admin enters company name and career page details/scrape configuration.
  2. System validates and saves the company as active.
  3. Company becomes eligible for the next scheduled scrape.
- **Related requirements:** FR-A-1, FR-A-7

### UC-5: Scheduled Scrape (System)

- **Actor:** System (scheduler)
- **Preconditions:** At least one active company exists.
- **Main flow:**
  1. At 12:30 PM or 7:00 PM, the scheduler triggers a scrape job per active company.
  2. Each company's career page is fetched and parsed.
  3. New/updated postings are written to the database; duplicates are skipped.
  4. A run log entry is recorded.
- **Exception flow:** If a company's page fails to scrape, the error is logged and other companies continue processing.
- **Related requirements:** FR-S-1 through FR-S-7

### UC-6: Deactivate Expired Postings (System)

- **Actor:** System (scheduler)
- **Preconditions:** Postings exist in the database.
- **Main flow:**
  1. At 12:00 AM, the system checks existing active postings against current source availability.
  2. Postings no longer present or past their expected expiry are marked inactive.
- **Related requirements:** FR-S-5

---

## 6. User Stories (Reference)

- *As a newcomer to Toronto, I want to search entry-level jobs by location, so I can find work close to where I live.*
- *As a student, I want to filter jobs by employment type, so I can find part-time roles that fit my class schedule.*
- *As a job seeker, I want to save postings I'm interested in, so I don't lose track of them while I decide.*
- *As a returning user, I want to subscribe to alerts for a specific role or company, so I don't have to keep checking manually.*
- *As an admin, I want to add a new company once, so the system can keep pulling its postings automatically going forward.*
- *As an admin, I want outdated postings removed automatically, so users don't waste time on jobs that no longer exist.*

---

## 7. Acceptance Criteria (Sample)

**For FR-U-7 (save favourite):**
- Given a logged-in user viewing an active job posting, when they select "Save," then the posting appears in their favourites list without a page reload error.
- A user cannot save the same posting twice (duplicate save is a no-op or shows already-saved state).
- An anonymous (non-logged-in) user attempting to save is prompted to log in.

**For FR-S-1 / FR-S-2 (scheduled scraping):**
- Given at least one active company, when the scheduled time (12:30 PM or 7:00 PM) is reached, then a scrape job runs for every active company without manual intervention.
- A scrape failure for one company is logged and does not stop scraping of subsequent companies in the same run.

**For FR-S-5 (deactivation):**
- Given a posting that is no longer found on its source career page, when the 12:00 AM cleanup runs, then that posting's `is_active` flag is set to false and it no longer appears in default search results.

---

## 8. Assumptions and Constraints

- Supported companies' career pages are structured consistently enough to be scraped with a per-company configuration (no full JavaScript-rendering requirement assumed unless a given site requires it).
- Email delivery (for subscriptions) relies on a transactional email service/provider to be selected during implementation.
- The system targets Toronto-area postings; broader geographic scope is not assumed for v1.
- Ubuntu 2026 LTS and Docker are fixed platform constraints per the technology stack.

---

## 9. Traceability Summary

| Requirement group | Source in Capstone Overview |
|---|---|
| FR-U-1, FR-U-7, FR-U-3–5 | Section 6, "Must Have — Job Seeker" |
| FR-U-2 | Section 6, "Should Have" |
| FR-U-11, FR-U-12 | Section 6, "Nice to Have — Job Seeker" |
| FR-A-1, FR-A-3, FR-A-4 | Section 6, "Must Have — Admin" |
| FR-S-1, FR-S-2, FR-S-5 | Section 6, "Must Have — System Role" |

---

*This requirements document should be reviewed alongside the Technical Documentation, which specifies how these requirements are implemented (schema, API, scheduling mechanism, deployment).*
