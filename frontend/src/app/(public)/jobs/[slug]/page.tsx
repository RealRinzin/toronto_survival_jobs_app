import JobCardSkeleton from "@/components/job/JobCardSkeleton";
import PageWrapper from "@/components/layout/PageWrapper";
import React, { Suspense } from "react";
export default async function JobDetailPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const res = await fetch(`${process.env.API_URL}/jobs/${slug}`);
  const job = await res.json();

  return (
    <PageWrapper>
      <Suspense fallback={<JobCardSkeleton />}>
        {/* <p className="p-0">{job.data.description}</p> */}
        <div className="grid grid-cols-1 md:grid-cols-4">
          <div className="bg-red-">sadfads</div>
          <div>sadfads</div>
          <div>sadfads</div>
          <div>sadfads</div>
        </div>
      </Suspense>
    </PageWrapper>
  );
}
