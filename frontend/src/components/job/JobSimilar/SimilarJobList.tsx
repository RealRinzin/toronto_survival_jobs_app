import Image from "next/image";
import React from "react";

export default function SimilarJobList({job}:{job:JobsDType}) {
  return (
    <div className="flex justify-between items-center gap-3 my-4 rounded-2xl border border-gray-100 p-3 hover:border-orange-100 hover:cursor-pointer">
      <div className="flex items-center gap-3">
          <Image
            src={`${process.env.API_URL_STORAGE}/img/companies/${job?.company?.logo}`}
            height={100}
            width={100}
            alt="Company Logo"
            className="h-10 w-10 p-1 rounded-md border border-gray-100"
            style={{ backgroundColor: `${job?.company?.brand_color}` }}
          />
        <div className="flex flex-col gap-1">
          <h2 className="font-bold text-sm">{job?.title}</h2>
          <h3 className="text-xs text-gray-600">{job?.company?.name}</h3>
        </div>
      </div>
      <div className="flex flex-col">
        <p className="font-bold">$23 - $30/hr</p>
        <p className="text-sm text-gray-600">Full-time</p>
      </div>
    </div>
  );
}
