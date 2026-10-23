import React, { Suspense } from "react";
import sanitizeHtml from "sanitize-html";
import JobOverviewSkeletonCard from "../JobOverview/JobOverviewSkeletonCard";
import PaddingGap from "@/components/layout/PaddingGap";
import TagLink from "@/components/tag/TagLink";
export default function JobDescriptionCard({
  description,
  tags,
}: {
  description: string;
  tags: TagDType[];
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
        {tags && (
          <>
            <h3 className="font-bold text-xl">Tags and Keywords</h3>
            <TagLink tags={tags} />
          </>
        )}
      </PaddingGap>
    </Suspense>
  );
}
