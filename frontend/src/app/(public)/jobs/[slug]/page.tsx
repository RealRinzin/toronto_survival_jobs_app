import JobCardSkeleton from "@/components/job/JobCardSkeleton";
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
        <PageGridWrapper sm={1} md={3}>
          <div className="bg-red-400">asdf</div>
          <div className="bg-green-400">asdf</div>
          <div className="bg-yellow-400">asdf</div>
          <div className="bg-pink-400">asdf</div>
        </PageGridWrapper>
      </Suspense>
    </PageWrapper>
  );
}
