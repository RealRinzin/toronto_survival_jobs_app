import Image from "next/image";
import Link from "next/link";
import React from "react";

export default function JobCard({ job }: { job: JobsDType }) {
  return (
    <div className="group bg-white rounded-2xl border border-border p-5 flex flex-col gap-4 transition-all hover:shadow-lg hover:-translate-y-0.5 cursor-pointer relative overflow-hidden">
      <div className="flex items-start gap-3 pl-1">
        <div
          className="w-12 h-12 rounded-xl p-1 flex items-center justify-center text-sm font-bold shrink-0 shadow-sm"
          style={{
            background: job.company.brand_color,
            border: `1.5px solid ${job.company.brand_color} 28`,
          }}
        >
          <Link href={`/jobs/${job.slug}`}>
            <Image
              src={`${process.env.API_URL_STORAGE}/${job?.company?.logo}`}
              alt="Compny"
              width={100}
              height={100}
            />
          </Link>
        </div>

        <div className="flex-1 min-w-0">
          <div className="flex items-start justify-between gap-2">
            <div className="min-w-0">
              <h3 className="font-bold text-base leading-tight truncate transition-colors group-hover:text-blue-900 text-foreground">
                <Link href={`/jobs/${job.slug}`}>{job.title}</Link>
              </h3>
              <p className="text-sm text-muted-foreground font-bold">
                {job.company.name}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div className="flex flex-wrap gap-x-4 gap-y-1 pl-1 text-xs text-muted-foreground">
        <span className="flex items-center gap-1">
          <svg
            className="w-3.5 h-3.5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            strokeWidth={2}
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
            />
          </svg>
          {job.location}
        </span>
        <span className="flex items-center gap-1">
          <svg
            className="w-3.5 h-3.5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            strokeWidth={2}
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
          {job?.employmentType?.name}
        </span>
        <span className="text-xs text-light-foreground">{job.posted_date}</span>
      </div>
      <div className="flex flex-wrap gap-1.5 pl-1">
        {job?.tags?.map((tag) => (
          <Link key={tag.id} href={`/categories/${tag.slug}`}>
            <span className="text-xs px-2.5 py-1 rounded-lg font-medium bg-slate-200 text-slate-500">
              {tag.name}
            </span>
          </Link>
        ))}
      </div>
      <div className="flex items-center justify-between pt-3 border-t border-border pl-1">
        <span
          className="font-bold text-lg text-primary"
          style={{ fontFamily: "'DM Mono', monospace" }}
        >
          {job.salary}
        </span>
        <div className="flex items-center gap-2">
          <button
            className="w-8 h-8 rounded-lg flex items-center justify-center border transition-all hover:border-amber-400"
            aria-label="Save job"
          >
            <svg
              className="w-4 h-4"
              viewBox="0 0 24 24"
              stroke="currentColor"
              strokeWidth={2}
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"
              />
            </svg>
          </button>
          <Link
            className="text-xs font-semibold px-4 py-1.5 rounded-lg text-white transition-all hover:opacity-90 active:scale-95"
            style={{ background: "linear-gradient(135deg, #0d2137, #1a3f5c)" }}
            href={`/jobs/${job.slug}`}
          >
            Read Detail
          </Link>
        </div>
      </div>
    </div>
  );
}
