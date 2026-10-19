import Image from "next/image";
import React, { Suspense } from "react";
import JobOverviewSkeletonCard from "./JobOverviewSkeletonCard";

export default function JobOverviewCard({ job }: { job: JobsDType }) {
  console.log(job);
  return (
    <Suspense fallback={<JobOverviewSkeletonCard />}>
      <div className="bg-white rounded-2xl my-6 p-6 shadow-sm">
        <div className="flex gap-3">
          <div className="border rounded-lg border-gray-100 p-2 h-20 w-20 flex justify-center items-center">
            <Image
              src={`${process.env.API_URL_STORAGE}/${job?.company?.logo}`}
              height={100}
              width={100}
              alt="Company Logo"
              style={{ backgroundColor: `${job?.company?.brand_color}` }}
            />
          </div>
          <div className="flex flex-col gap-1 text-">
            <h2 className="font-bold text-2xl text-gray-900">{job?.title}</h2>
            <h3 className="text-gray-600"></h3>
          </div>
        </div>
        <ul className="flex gap-3 text-sm text-gray-500 font-light my-2">
          <li>North</li>
          <li>Full Time</li>
          <li>Mid level</li>
        </ul>
        <div className="flex justify-between">
          <p className="font-bold text-2xl"> $29- $30/hr</p>
          <a href="" className="bg-orange-400 p-2 rounded-lg  shadow">
            Apply Now
          </a>
        </div>
      </div>
    </Suspense>
  );
}
