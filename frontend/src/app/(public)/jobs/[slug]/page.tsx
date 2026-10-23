import AdUnit from "@/components/Ads/Ads";
import JobDescriptionCard from "@/components/job/JobDescription/JobDescriptionCard";
import JobDescriptionSkeletonCard from "@/components/job/JobDescription/JobDescriptionSkeletonCard";
import JobOverviewCard from "@/components/job/JobOverview/JobOverviewCard";
import JobOverviewSkeletonCard from "@/components/job/JobOverview/JobOverviewSkeletonCard";
import SimilarJobCard from "@/components/job/JobSimilar/SimilarJobCard";
import JobSidebar from "@/components/job/Sidebar/JobSidebar";
import PaddingGap from "@/components/layout/PaddingGap";

import PageWrapper from "@/components/layout/PageWrapper";
import TagLink from "@/components/tag/TagLink";
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
    image: `${process.env.API_URL_STORAGE}/img/companies/${job?.company?.logo}`,
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
      <div className="grid grid-cols-1 md:grid-cols-6 gap-4">
        <div className="md:col-span-4">
          <Suspense fallback={<JobOverviewSkeletonCard />}>
            <JobOverviewCard job={job} />
          </Suspense>
          <Suspense fallback={<JobDescriptionSkeletonCard />}>
            <JobDescriptionCard description={job?.description} tags={job?.tags} />
          </Suspense>
          <AdUnit size="leaderboard" />
          <SimilarJobCard />
        </div>
        <JobSidebar job={job}/>
      </div>
    </PageWrapper>
  );
}
