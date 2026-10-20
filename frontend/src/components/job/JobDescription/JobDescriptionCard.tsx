import React, { Suspense } from "react";
import sanitizeHtml from "sanitize-html";
import JobOverviewSkeletonCard from "../JobOverview/JobOverviewSkeletonCard";
import PaddingGap from "@/components/layout/PaddingGap";
export default function JobDescriptionCard({
  description,
}: {
  description: string;
}) {
  const style = {};
  return (
    <Suspense fallback={<JobOverviewSkeletonCard />}>
      <PaddingGap>
        <div id="job_description">
          <div
            dangerouslySetInnerHTML={{ __html: sanitizeHtml(description) }}
          ></div>
        </div>
      </PaddingGap>
    </Suspense>
  );
}
