import React from "react";

export default function HomeHeroSection() {
  return (
    <section className="relative overflow-hidden" style={{ minHeight: 560 }}>
      <img
        src="https://images.unsplash.com/photo-1507992781348-310259076fe0?w=1600&h=600&fit=crop&auto=format"
        alt="Toronto skyline at golden hour"
        className="absolute inset-0 w-full h-full object-cover"
        style={{ objectPosition: "center 40%" }}
      />
      {/* Centered dark overlay — evenly covers left-to-right so content can sit center */}
      <div
        className="absolute inset-0"
        style={{
          background:
            "linear-gradient(to bottom, rgba(10,26,17,0.88) 0%, rgba(10,26,17,0.72) 60%, rgba(10,26,17,0.55) 100%)",
        }}
      />
      {/* Subtle dot texture */}
      <div
        className="absolute inset-0 opacity-[0.04]"
        style={{
          backgroundImage:
            "radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px)",
          backgroundSize: "28px 28px",
        }}
      />

      <div className="relative max-w-4xl mx-auto px-5 py-20 sm:py-28 text-center">
        {/* Live badge */}
        <div
          className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-6"
          style={{
            background: "rgba(212,130,26,0.18)",
            color: "#f0a94a",
            border: "1px solid rgba(212,130,26,0.3)",
          }}
        >
          <span
            className="w-1.5 h-1.5 rounded-full animate-pulse"
            style={{ background: "#f0a94a" }}
          />
          14,200+ jobs live in Toronto right now
        </div>

        <h1
          className="text-4xl sm:text-6xl font-bold text-white leading-tight mb-5"
          style={{ fontFamily: "'Fraunces', serif", letterSpacing: "-0.025em" }}
        >
          Real jobs.
          <br />
          <span style={{ color: "#f0a94a" }}>Real pay.</span> Toronto.
        </h1>
        <p
          className="text-base sm:text-lg mb-8 max-w-xl mx-auto"
          style={{ color: "rgba(255,255,255,0.68)", lineHeight: 1.7 }}
        >
          Warehouse, food service, delivery, retail — all across the GTA. Salary
          shown upfront. Always. No surprises.
        </p>

        {/* Search box — centered */}
        <div
          className="bg-white rounded-2xl p-2 flex flex-col sm:flex-row gap-2 mb-5 mx-auto"
          style={{ maxWidth: 680, boxShadow: "0 12px 48px rgba(0,0,0,0.28)" }}
        >
          <div className="flex-1 flex items-center gap-3 px-3">
            <svg
              className="w-5 h-5shrink-0"
              style={{ color: "#6b7c93" }}
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              strokeWidth={2}
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"
              />
            </svg>
            <input
              type="text"
              placeholder="Job title, company, or keyword…"
              // value={search}
              // onChange={(e) => setSearch(e.target.value)}
              // onKeyDown={(e) => e.key === "Enter" && setPage("search")}
              className="flex-1 text-sm outline-none bg-transparent py-2.5"
              style={{ color: "#0f1923" }}
            />
          </div>
          <div
            className="hidden sm:block w-px self-stretch my-1.5"
            style={{ background: "#e2e8f0" }}
          />
          <div className="flex items-center gap-2 px-3">
            <svg
              className="w-4 h-4 shrink-0"
              style={{ color: "#6b7c93" }}
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              strokeWidth={2}
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
              />
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>
            <select
              // value={area}
              // onChange={(e) => setArea(e.target.value)}
              className="text-sm outline-none bg-transparent py-2.5 pr-1 cursor-pointer"
              // style={{ color: area === "All Areas" ? "#6b7c93" : "#0f1923" }}
            >
              {/* {AREAS.map((a) => (
                <option key={a}>{a}</option>
              ))} */}
            </select>
          </div>
          <button
            // onClick={() => setPage("search")}
            className="px-6 py-3 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90 active:scale-95"
            style={{
              background: "linear-gradient(135deg, #d4821a, #e0972e)",
              flexShrink: 0,
              boxShadow: "0 3px 10px rgba(212,130,26,0.4)",
            }}
          >
            Search Jobs
          </button>
        </div>

        {/* Quick search pills — centered */}
        <div className="flex flex-wrap gap-2 justify-center">
          <span
            className="text-xs self-center"
            style={{ color: "rgba(255,255,255,0.4)" }}
          >
            Popular:
          </span>
          {[
            "Warehouse",
            "Food Service",
            "Delivery",
            "Retail",
            "Security",
            "Construction",
          ].map((tag) => (
            <button
              key={tag}
              // onClick={() => {
                // setSearch(tag);
                // setPage("search");
              // }}
              className="text-xs px-3 py-1 rounded-full transition-all hover:bg-white hover:text-gray-900 font-medium"
              style={{
                background: "rgba(255,255,255,0.1)",
                color: "rgba(255,255,255,0.75)",
                border: "1px solid rgba(255,255,255,0.14)",
              }}
            >
              {tag}
            </button>
          ))}
        </div>
      </div>
    </section>
  );
}
