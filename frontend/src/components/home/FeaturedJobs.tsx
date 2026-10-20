import React, { Suspense } from "react";
import JobCard from "../job/JobCard";
import JobCardGrid from "../job/JobCardGrid";
import JobCardSkeleton from "../job/JobCardSkeleton";
const JOB_TYPES = [
  "All Types",
  "Full-time",
  "Part-time",
  "Contract",
  "Temporary",
];


export default async function HomeFeaturedJobs() {
  const res = await fetch(`${process.env.API_URL}/jobs`)
  if(!res.ok) return <p>Something went wrong.. reload</p>
  const jobs = await res.json()
  return (
    <section className="py-14 bg-muted">
      <div className="max-w-7xl mx-auto px-5">
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
          <div>
            <h2 className="text-2xl font-bold text-primary font-display">
              Latest Job
            </h2>
            <p className="text-sm mt-0.5 text-muted-foreground">
              Updated every hour · salary shown upfront
            </p>
          </div>
          <div className="flex items-center gap-2 flex-wrap">
            {JOB_TYPES.map((t) => (
              <button
                key={t}
                // onClick={() => setJobType(t)}
                className={`text-sm px-3 py-1.5 rounded-full border font-medium transition-all border-gray-200 text-gray-500`}
              >
                {t}
              </button>
            ))}
          </div>
        </div>
        <JobCardGrid cols={2} gap={4}>
          {jobs.data.map((jobs: JobsDType, index: number) => {
            return (
              <Suspense key={index} fallback={<JobCardSkeleton />}>
                <JobCard job={jobs} />
              </Suspense>
            );
          })}
        </JobCardGrid>
        <div className="mt-8 text-center">
          <button
            // onClick={() => setPage("search")}
            className="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90 hover:-translate-y-0.5"
            style={{
              background:
                "linear-gradient(135deg, var(--primary), var(--primary-mid))",
              boxShadow:
                "0 4px 16px color-mix(in srgb, var(--primary) 25%, transparent)",
            }}
          >
            View all &gt;14,000 jobs with advanced filters →
          </button>
        </div>
      </div>
    </section>
  );
}
