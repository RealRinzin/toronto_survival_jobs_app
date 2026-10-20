import PaddingGap from "@/components/layout/PaddingGap";
import SimilarJobList from "./SimilarJobList";
import JobOverviewSkeletonCard from "../JobOverview/JobOverviewSkeletonCard";
import { Suspense } from "react";
import AdUnit from "@/components/Ads/Ads";

export default async function SimilarJobCard() {
  const res = await fetch(`${process.env.API_URL}/jobs`);
  const { data: jobs } = await res.json();
  return (
    <PaddingGap>
      <h1 className="font-bold">Similart Jobs in Toronto</h1>
      {jobs.map((job: JobsDType, index: number) => (
        <Suspense fallback={<JobOverviewSkeletonCard />} key={index}>
          <SimilarJobList job={job} key={index} />
          {(index+1)%4==0 && (<AdUnit size="leaderboard"/>)}
        </Suspense>
      ))}
    </PaddingGap>
  );
}
