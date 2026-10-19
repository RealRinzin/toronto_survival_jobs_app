import JobCardSkeleton from "@/components/job/JobCardSkeleton";
import JobDescriptionCard from "@/components/job/JobDescription/JobDescriptionCard";
import JobOverviewCard from "@/components/job/JobOverview/JobOverviewCard";
import PageGridWrapper from "@/components/layout/PageGridWrapper";
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
        {/* <PageGridWrapper sm={1} md={3}> */}
        {/* </PageGridWrapper> */}
        <div className="grid grid-cols-1 md:grid-cols-6">
          <div className="col-span-4">
          <JobOverviewCard/>
          <JobDescriptionCard/>
          </div>
          <div>
            side
          </div>
        </div>
      </Suspense>
    </PageWrapper>
  );
}
