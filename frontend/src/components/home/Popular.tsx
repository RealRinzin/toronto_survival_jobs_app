import React from "react";
import PageWrapper from "../layout/PageWrapper";
import HomeTagCard from "../tag/HomeTagCard";
const POPULAR_SEARCHES = [
  {
    eyebrow: "Start right away",
    title: "No experience jobs",
    count: "1,240 open roles",
    tag: "Most popular",
  },
  {
    eyebrow: "Work when it suits you",
    title: "Evening & night shifts",
    count: "680 open roles",
    tag: "Flexible",
  },
  {
    eyebrow: "Get paid every week",
    title: "Weekly pay jobs",
    count: "415 open roles",
    tag: "Fast pay",
  },
  {
    eyebrow: "Stay close to home",
    title: "Jobs near a TTC stop",
    count: "930 open roles",
    tag: "Easy commute",
  },
];
export default function HomePopular() {
  return (
    <PageWrapper>
      <div className="rounded-3xl p-6 sm:p-8" style={{ background: "#f5f7fa" }}>
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
          <div>
            <span
              className="text-xs font-bold uppercase tracking-[0.16em]"
              style={{ color: "#d4821a" }}
            >
              Popular in Toronto
            </span>
            <h2
              className="text-2xl font-bold mt-1"
              style={{ color: "#0d2137", fontFamily: "'Fraunces', serif" }}
            >
              Find work your way
            </h2>
            <p className="text-sm mt-1" style={{ color: "#6b7c93" }}>
              Shortcuts built around what matters most to hourly workers.
            </p>
          </div>
          <button
            // onClick={() => setPage("search")}
            className="text-sm font-bold self-start sm:self-auto"
            style={{ color: "#0d2137" }}
          >
            Explore all searches →
          </button>
        </div>
        <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
          {POPULAR_SEARCHES.map((item, index) => (
            <button
              key={item.title}
              //   onClick={() => {
              //     setSearch(item.title);
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
                {item.tag}
              </span>
              <span
                className="block text-xs mb-1"
                style={{
                  color: index === 0 ? "rgba(255,255,255,0.58)" : "#6b7c93",
                }}
              >
                {item.eyebrow}
              </span>
              <span
                className="block text-base font-bold"
                style={{ color: index === 0 ? "#fff" : "#0d2137" }}
              >
                {item.title}
              </span>
              <span
                className="block text-xs mt-4 font-semibold"
                style={{ color: index === 0 ? "#f0a94a" : "#d4821a" }}
              >
                {item.count} →
              </span>
            </button>
          ))}
        </div>
        <HomeTagCard/>
      </div>
    </PageWrapper>
  );
}
