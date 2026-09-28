import React from "react";
const TICKER_LOGOS = [
  { logo: "AM", color: "#FF9900", name: "Amazon" },
  { logo: "TH", color: "#c8102e", name: "Tim Hortons" },
  { logo: "RC", color: "#da1f2b", name: "Rogers" },
  { logo: "PU", color: "#ff6200", name: "Purolator" },
  { logo: "LC", color: "#e2231a", name: "Loblaws" },
  { logo: "SC", color: "#cc0000", name: "Securitas" },
  { logo: "HB", color: "#003087", name: "Hudson's Bay" },
  { logo: "FR", color: "#5cb85c", name: "Freshii" },
  { logo: "CT", color: "#d92b3a", name: "Canadian Tire" },
  { logo: "TG", color: "#0072ce", name: "Toronto General" },
];

export default function HomeHiringticker() {
  return (
    <div
      className="overflow-hidden border-b"
      style={{ background: "#fafbfc", borderColor: "#f0f4f8" }}
    >
      <div
        className="flex items-center py-2.5 gap-0"
        style={{
          animation: "ticker 28s linear infinite",
          width: "max-content",
        }}
      >
        {[...TICKER_LOGOS, ...TICKER_LOGOS].map((item, i) => (
          <div key={i} className="flex items-center gap-2 px-5 shrink-0">
            <div
              className="w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold"
              style={{ background: item.color + "18", color: item.color }}
            >
              {item.logo}
            </div>
            <span
              className="text-xs font-medium whitespace-nowrap"
              style={{ color: "#6b7c93" }}
            >
              {item.name}
            </span>
            <span className="ml-4 text-xs" style={{ color: "#cbd5e1" }}>
              ·
            </span>
          </div>
        ))}
      </div>
      <style>{`
          @keyframes ticker { from { transform: translateX(0) } to { transform: translateX(-50%) } }
        `}</style>
    </div>
  );
}
