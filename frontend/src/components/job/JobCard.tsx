import React from "react";

export default function JobCard({ job }: any) {
  return (
    <div className="group bg-white rounded-2xl border border-border p-5 flex flex-col gap-4 transition-all hover:shadow-lg hover:-translate-y-0.5 cursor-pointer relative overflow-hidden">
      <div className="flex items-start gap-3 pl-1">
        <div
          className="w-11 h-11 rounded-xl flex items-center justify-center text-sm font-bold shrink-0 shadow-sm"
          style={{
            background: job.logoColor + "18",
            color: job.logoColor,
            border: `1.5px solid ${job.logoColor}28`,
          }}
        >
          {job.logo}
        </div>
        <div className="flex-1 min-w-0">
          <div className="flex items-start justify-between gap-2">
            <div className="min-w-0">
              <h3 className="font-bold text-base leading-tight truncate transition-colors group-hover:text-blue-900 text-foreground">
                {job.title}
              </h3>
              <p className="text-sm text-muted-foreground">{job.company}</p>
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
          {job.type}
        </span>
        <span className="text-xs text-light-foreground">{job.posted}</span>
      </div>
      <div className="flex flex-wrap gap-1.5 pl-1">
        {job.tags.map((tag) => (
          <span
            key={tag}
            className="text-xs px-2.5 py-1 rounded-lg font-medium"
            style={{
              background: "var(--border)",
              color: "var(--mid-foreground)",
            }}
          >
            {tag}
          </span>
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
            // onClick={e => { e.stopPropagation(); onSave() }}
            className="w-8 h-8 rounded-lg flex items-center justify-center border transition-all hover:border-amber-400"
            // style={{
            //   borderColor: saved ? "var(--accent)" : "var(--border)",
            //   background: saved ? "var(--accent-tint)" : "#fff",
            //   color: saved ? "var(--accent)" : "var(--light-foreground)",
            // }}
            aria-label="Save job"
          >
            <svg
              className="w-4 h-4"
              viewBox="0 0 24 24"
              // fill={saved ? "currentColor" : "none"}
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
          <button
            className="text-xs font-semibold px-4 py-1.5 rounded-lg text-white transition-all hover:opacity-90 active:scale-95"
            style={{ background: 'linear-gradient(135deg, #0d2137, #1a3f5c)' }}
          >
            Apply Now
          </button>
        </div>
      </div>
    </div>
  );
}
