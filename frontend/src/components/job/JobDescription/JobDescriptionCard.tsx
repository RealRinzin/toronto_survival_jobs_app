import React, { Suspense } from "react";
import sanitizeHtml from "sanitize-html";
import JobOverviewSkeletonCard from "../JobOverview/JobOverviewSkeletonCard";
export default function JobDescriptionCard({
  description,
}: {
  description: string;
}) {
  const style = {};
  return (
    <Suspense fallback={<JobOverviewSkeletonCard />}>
      <div
        className="bg-white rounded-2xl my-10 p-6 shadow-sm"
        id="job_description"
      >
        <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(description) }}></div>
      </div>
    </Suspense>
  );
}
