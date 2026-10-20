import Image from "next/image";
import React, { Suspense } from "react";
import JobOverviewSkeletonCard from "./JobOverviewSkeletonCard";
import PaddingGap from "@/components/layout/PaddingGap";
import { CalendarDays, Clock5, MapPin } from "lucide-react";
import { timeAgo } from "@/lib/timeAgo";

export default function JobOverviewCard({ job }: { job: JobsDType }) {
  console.log(job);
  return (
    <PaddingGap>
      <div className="flex gap-3">
        <div className="border rounded-lg border-gray-100  flex justify-center items-center">
          <Image
            src={`${process.env.API_URL_STORAGE}/img/companies/${job?.company?.logo}`}
            height={100}
            width={100}
            alt="Company Logo"
            className="h-10 w-10 p-1 rounded-md border border-gray-50"
            style={{ backgroundColor: `${job?.company?.brand_color}` }}
          />
        </div>
        <div className="flex flex-col gap-1 text-">
          <h2 className="font-bold text-2xl text-gray-900">{job?.title}</h2>
          <h3 className="text-gray-600"></h3>
        </div>
      </div>
      <ul className="flex gap-3 text-sm text-gray-500 font-light my-2">
        <li className="flex items-center gap-1"><MapPin  className="h-4"/>{job?.location}</li>
        <li className="flex items-center gap-1"><Clock5  className="h-4"/> {job?.employmentType?.name}</li>
        <li className="flex items-center gap-1"><CalendarDays  className="h-4"/>{timeAgo(job?.system_posted_date)}</li>
      </ul>
      <div className="flex justify-between">
        <p className="font-bold text-lg"> $29- $30/hr</p>
        <a
          href={job?.apply_url}
          target="_blank"
          className="bg-orange-400 p-2 rounded-lg font-medium shadow"
        >
          Apply Now
        </a>
      </div>
    </PaddingGap>
  );
}
