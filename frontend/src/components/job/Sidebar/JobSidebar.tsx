import LinkButton from "@/app/(public)/jobs/Button/LinkButton";
import AdUnit from "@/components/Ads/Ads";
import PaddingGap from "@/components/layout/PaddingGap";
import { timeAgo } from "@/lib/timeAgo";
export default function JobSidebar({job}:{job:JobsDType}) {
  return (
    <aside className="md:col-span-2">
      <div className="hidden md:block sticky top-20">
        <div className="bg-white rounded-2xl border border-border p-6 sm:p-8 space-y-6 my-6">
          <h2>$20-10/hr</h2>
          <LinkButton text="Apply" classes="bg-blue-900" link={job?.apply_url} />
          <LinkButton text="Save" classes="bg-gray-900" link="/jobs" />
          <div className="flex flex-col gap-2 text-sm">
            <ul className="flex justify-between items-center">
              <li className="text-gray-500 text-sm">Job Type</li>
              <li>{job?.jobCategory?.name}</li>
            </ul>
            <ul className="flex justify-between items-center">
              <li className="text-gray-500 text-sm">Location</li>
              <li>{job?.city?.name}</li>
            </ul>
            <ul className="flex justify-between items-center">
              <li className="text-gray-500 text-sm">Industries</li>
              <li>{job?.company?.businessCategory?.name}</li>
            </ul>
            <ul className="flex justify-between items-center">
              <li className="text-gray-500 text-sm">Experience</li>
              <li>Entry Level</li>
            </ul>
            <ul className="flex justify-between items-center">
              <li className="text-gray-500 text-sm">Posted</li>
              <li>{timeAgo(job?.system_posted_date)}</li>
            </ul>
          </div>
        </div>
          <AdUnit size="sidebar" />

      </div>
    </aside>
  );
}
