import React from "react";
export default async function JobDetailPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const res = await fetch(`${process.env.API_URL}/jobs/${slug}`);
const job = await res.json()
console.log(job)
  return (
    <div>
      <p>Public - {process.env.NEXT_PUBLIC_API_URL}</p>
      <p>Server-{process.env.API_URL}</p>
    </div>
  );
}
