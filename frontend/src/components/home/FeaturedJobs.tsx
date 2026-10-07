import React, { Suspense } from "react";
import JobCard from "../job/JobCard";
import JobCardGrid from "../job/JobCardGrid";
import JobCardSkeleton from "../job/JobCardSkeleton";
const JOBS = [
  {
    id: 1,
    title: "Warehouse Associate",
    company: "Amazon Fulfillment",
    logo: "AM",
    logoColor: "#FF9900",
    location: "Scarborough, ON",
    type: "Full-time",
    salary: "$19–$22/hr",
    tags: ["Physical", "No Experience"],
    posted: "2h ago",
    hot: true,
    rating: 3.8,
  },
  {
    id: 2,
    title: "Food Service Worker",
    company: "Tim Hortons",
    logo: "TH",
    logoColor: "#c8102e",
    location: "Downtown Toronto",
    type: "Part-time",
    salary: "$17.20/hr",
    tags: ["Flexible Hours", "Entry Level"],
    posted: "5h ago",
    hot: false,
    rating: 3.4,
  },
  {
    id: 3,
    title: "Customer Service Rep",
    company: "Rogers Communications",
    logo: "RC",
    logoColor: "#da1f2b",
    location: "North York, ON",
    type: "Full-time",
    salary: "$21–$25/hr",
    tags: ["Bilingual Bonus", "Benefits"],
    posted: "1d ago",
    hot: false,
    rating: 3.6,
  },
  {
    id: 4,
    title: "Line Cook",
    company: "Freshii Canada",
    logo: "FR",
    logoColor: "#5cb85c",
    location: "Kensington Market",
    type: "Full-time",
    salary: "$18–$20/hr",
    tags: ["Food Handler Cert", "Tips"],
    posted: "3h ago",
    hot: true,
    rating: 3.9,
  },
  {
    id: 5,
    title: "Delivery Driver",
    company: "Purolator",
    logo: "PU",
    logoColor: "#ff6200",
    location: "Etobicoke, ON",
    type: "Full-time",
    salary: "$23–$27/hr",
    tags: ["License Required", "Benefits"],
    posted: "6h ago",
    hot: false,
    rating: 4.0,
  },
  {
    id: 6,
    title: "Retail Sales Associate",
    company: "Hudson's Bay",
    logo: "HB",
    logoColor: "#003087",
    location: "Eaton Centre, Toronto",
    type: "Part-time",
    salary: "$17.20–$19/hr",
    tags: ["Staff Discount", "Flexible"],
    posted: "2d ago",
    hot: false,
    rating: 3.2,
  },
  {
    id: 7,
    title: "Security Guard",
    company: "Securitas Canada",
    logo: "SC",
    logoColor: "#cc0000",
    location: "Mississauga, ON",
    type: "Full-time",
    salary: "$20–$24/hr",
    tags: ["License Required", "Nights"],
    posted: "12h ago",
    hot: true,
    rating: 3.5,
  },
  {
    id: 8,
    title: "Cashier",
    company: "Loblaws Companies",
    logo: "LC",
    logoColor: "#e2231a",
    location: "Brampton, ON",
    type: "Part-time",
    salary: "$17.20/hr",
    tags: ["No Experience", "Weekends"],
    posted: "4h ago",
    hot: false,
    rating: 3.7,
  },
];
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
