import AdUnit from "@/components/Ads/Ads";
import JobDescriptionCard from "@/components/job/JobDescription/JobDescriptionCard";
import JobOverviewCard from "@/components/job/JobOverview/JobOverviewCard";
import JobOverviewSkeletonCard from "@/components/job/JobOverview/JobOverviewSkeletonCard";

import PageWrapper from "@/components/layout/PageWrapper";
import { buildMetadata, toPlainText } from "@/lib/metadata";
import { Metadata } from "next";
import { Suspense } from "react";

export async function generateMetadata({
  params,
}: metaDataDType): Promise<Metadata> {
  const { slug } = await params;
  const res = await fetch(`${process.env.API_URL}/jobs/${slug}`);

  const { data: job } = await res.json();

  return buildMetadata({
    title: `${job.title} at ${job.company?.name}`,
    description: toPlainText(job?.description),
    path: `/jobs/${slug}`,
    type: "article",
  });
}

export default async function JobDetailPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const res = await fetch(`${process.env.API_URL}/jobs/${slug}`);
  const { data: job } = await res.json();
  return (
    <PageWrapper background="bg-gray-50">
      {/* <PageGridWrapper sm={1} md={3}> */}
      {/* </PageGridWrapper> */}
      <div className="grid grid-cols-1 md:grid-cols-6 gap-4">
        <div className="col-span-4">
          <Suspense fallback={<JobOverviewSkeletonCard/>}>
            <JobOverviewCard job={job} />
            <JobDescriptionCard description={job?.description} />
            <AdUnit size="leaderboard" />
          </Suspense>
        </div>
        <aside>
          {/* sd */}
          <div className="rounded-md  bg-white my-6 p-6">pasdaf</div>
        </aside>
      </div>
    </PageWrapper>
  );
}
