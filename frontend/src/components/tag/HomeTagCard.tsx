import React from "react";

export default async function HomeTagCard() {
  const res = await fetch(`${process.env.API_URL}/tags`);
  const { data: tags } = await res.json();
  return (
    <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
      {tags.slice(0,3).map((tag:TagDType, index:number) => (
        <button
          key={index}
          //   onClick={() => {
          //     setSearch(tag.title);
          //     setPage("search");
          //   }}
          className="group text-left rounded-2xl border p-5 transition-all hover:-translate-y-0.5 hover:shadow-md"
          style={{
            background: index === 0 ? "#0d2137" : "#fff",
            borderColor: index === 0 ? "#0d2137" : "#e2e8f0",
          }}
        >
          <span
            className="inline-flex text-[11px] font-bold px-2 py-1 rounded-full mb-5"
            style={{
              background: index === 0 ? "rgba(212,130,26,0.2)" : "#fff5eb",
              color: index === 0 ? "#f0a94a" : "#b85f15",
            }}
          >
            {tag.name}
          </span>
          <span
            className="block text-xs mb-1"
            style={{
              color: index === 0 ? "rgba(255,255,255,0.58)" : "#6b7c93",
            }}
          >
            {/* {tag.eyebrow} */}
          </span>
          <span
            className="block text-base font-bold"
            style={{ color: index === 0 ? "#fff" : "#0d2137" }}
          >
            {/* {tag.title} */}
          </span>
          <span
            className="block text-xs mt-4 font-semibold"
            style={{ color: index === 0 ? "#f0a94a" : "#d4821a" }}
          >
            {tag.job_listings_count} →
          </span>
        </button>
      ))}
    </div>
  );
}
