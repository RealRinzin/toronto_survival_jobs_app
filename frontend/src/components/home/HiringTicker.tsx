import Image from "next/image";

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

// const companies = await
export default async function HomeHiringticker() {
  const res = await fetch(`${process.env.API_URL}/companies`);
  if (!res.ok) return <p>Something went wrong </p>;
  const companies = await res.json();
  return (
    <section
      className="border-b overflow-hidden"
      style={{ background: "#fff", borderColor: "#e2e8f0" }}
    >
      <div className="max-w-7xl mx-auto px-5 pt-6 text-center">
        <p
          className="text-xs font-bold uppercase tracking-[0.18em]"
          style={{ color: "#6b7c93" }}
        >
          Hiring now across the GTA
        </p>
      </div>
      <div
        className="flex items-center py-5 gap-0"
        style={{
          animation: "ticker 28s linear infinite",
          width: "max-content",
        }}
      >
        {/* {[...TICKER_LOGOS, ...TICKER_LOGOS].map((item, i) => (
          <div key={i} className="flex items-center gap-3 px-7 shrink-0">
            <div
              className="w-9 h-9 rounded-lg flex items-center justify-center text-xs font-bold"
              style={{ background: item.color + "14", color: item.color }}
            >
              {item.logo}
            </div>
            <span
              className="text-sm font-semibold whitespace-nowrap"
              style={{ color: "#4a6380" }}
            >
              {item.name}
            </span>
          </div>
        ))}
      </div>
      <div
        className="flex items-center py-5 gap-0"
        style={{
          animation: "ticker 28s linear infinite",
          width: "max-content",
        }}
      > */}
        {companies.data.map((item:any, i:number) => (
          <div key={i} className="flex items-center gap-3 px-7 shrink-0">
            <div
              style={{ backgroundColor:  `${item.brand_color}`}}
              className="p-2 w-fit rounded flex justify-center items-center"
            >
              <Image
                src={`http://localhost:8001/storage/img/companies/${item.logo}`}
                className="object-contain"
                alt="bestbuy"
                height={14}
                width={14}
              />
            </div>
            <span
              className="text-sm font-semibold whitespace-nowrap"
              style={{ color: "#4a6380" }}
            >
              {item.name}
            </span>
          </div>
        ))}
      </div>
      <style>{`
          @keyframes ticker { from { transform: translateX(0) } to { transform: translateX(-50%) } }
          @media (prefers-reduced-motion: reduce) { [style*="ticker"] { animation: none !important; } }
        `}</style>
    </section>
  );
}
