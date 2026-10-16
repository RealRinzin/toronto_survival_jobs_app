import JobCardSkeleton from "@/components/job/JobCardSkeleton";
import React, { Suspense } from "react";
export default async function JobDetailPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const res = await fetch(`${process.env.API_URL}/jobs/${slug}`);
const job = await res.json()
console.log(job)
  return (
    <div>
      <Suspense fallback={<JobCardSkeleton />}>
        {/* <JobContent slug={slug} /> */}
        <p>{job.data.description}</p>
      </Suspense>
    </div>
  );
}
