import PaddingGap from "@/components/layout/PaddingGap";
import SimilarJobList from "./SimilarJobList";

export default async function SimilarJobCard() {
  const res = await fetch(`${process.env.API_URL}/jobs`);
  const { data: jobs } = await res.json();
  return (
    <PaddingGap>
      <h1 className="font-bold">Similart Jobs in Toronto</h1>
      {jobs.map((job: JobsDType, index: number) => (
        <SimilarJobList job={job} key={index}/>
      ))}
    </PaddingGap>
  );
}
