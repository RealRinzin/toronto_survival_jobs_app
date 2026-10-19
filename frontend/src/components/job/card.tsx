import React from "react";

function delay(ms: number) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

export default async function Card({ data }: any) {
  // await delay(4000);

  return (
    <div className="py-10">
      <p>{data?.name}</p>
      <p className="text-4xl">{data?.avatar}</p>
    </div>
  );
}