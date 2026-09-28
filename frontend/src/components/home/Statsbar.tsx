import React from "react";
const STATS = [
  { value: '14,200+', label: 'Active Listings', icon: '💼' },
  { value: '3,800+', label: 'Companies Hiring', icon: '🏢' },
  { value: '92K+', label: 'Torontonians Placed', icon: '🤝' },
  { value: '$17.20', label: 'Min. Wage (ON)', icon: '💰' },
]
export default function HomeStatsBar() {
  return (
    <section style={{ background: "#0d2137" }}>
      <div className="max-w-7xl mx-auto px-5">
        <div className="grid grid-cols-2 md:grid-cols-4">
          {STATS.map((s, i) => (
            <div
              key={s.label}
              className="flex items-center gap-3 px-6 py-5"
              style={{
                borderRight:
                  i < 3 ? "1px solid rgba(255,255,255,0.08)" : "none",
              }}
            >
              <span className="text-2xl hidden sm:block">{s.icon}</span>
              <div>
                <div
                  className="text-xl font-bold"
                  style={{ color: "#f0a94a", fontFamily: "'Fraunces', serif" }}
                >
                  {s.value}
                </div>
                <div
                  className="text-xs"
                  style={{ color: "rgba(255,255,255,0.5)" }}
                >
                  {s.label}
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
