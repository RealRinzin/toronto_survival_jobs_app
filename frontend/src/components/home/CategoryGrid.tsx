import React from "react";
const CATEGORIES = [
  { label: 'Food & Hospitality', icon: '🍽️', count: 842, color: '#e05c2a' },
  { label: 'Warehousing', icon: '📦', count: 619, color: '#FF9900' },
  { label: 'Retail', icon: '🛍️', count: 503, color: '#003087' },
  { label: 'Transportation', icon: '🚚', count: 381, color: '#ff6200' },
  { label: 'Customer Service', icon: '🎧', count: 274, color: '#da1f2b' },
  { label: 'Construction', icon: '🏗️', count: 196, color: '#1a5276' },
]
export default function HomeCategoryGrid() {
  return (
    <section className="max-w-7xl mx-auto px-5 py-14" style={{ paddingTop: 0 }}>
      <div className="flex items-center justify-between mb-7">
        <div>
          <h2
            className="text-2xl font-bold"
            style={{ color: "#0d2137", fontFamily: "'Fraunces', serif" }}
          >
            Browse by Category
          </h2>
          <p className="text-sm mt-0.5" style={{ color: "#6b7c93" }}>
            What kind of work are you looking for?
          </p>
        </div>
        <button
          // onClick={() => setPage("search")}
          className="hidden sm:block text-sm font-semibold px-4 py-2 rounded-lg border transition-all hover:bg-gray-50"
          style={{ color: "#d4821a", borderColor: "#fcd5a0" }}
        >
          All Categories →
        </button>
      </div>
      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        {CATEGORIES.map((cat) => (
          <button
            key={cat.label}
            // onClick={() => setPage("search")}
            className="flex flex-col items-center gap-3 p-5 rounded-2xl border text-center transition-all hover:-translate-y-1 hover:shadow-md group"
            style={{ background: "#fff", borderColor: "#e2e8f0" }}
          >
            <div
              className="w-12 h-12 rounded-xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110"
              style={{ background: cat.color + "15" }}
            >
              {cat.icon}
            </div>
            <div>
              <div
                className="text-xs font-bold leading-tight"
                style={{ color: "#0d2137" }}
              >
                {cat.label}
              </div>
              <div
                className="text-xs mt-0.5 font-medium"
                style={{ color: cat.color }}
              >
                {cat.count.toLocaleString()} jobs
              </div>
            </div>
          </button>
        ))}
      </div>
    </section>
  );
}
