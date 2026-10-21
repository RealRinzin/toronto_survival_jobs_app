import PageWrapper from "../layout/PageWrapper";
import HomeTagCard from "../tag/HomeTagCard";
import Link from "next/link";

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
          <Link
            href="/tags"
            className="text-sm font-bold self-start sm:self-auto"
            style={{ color: "#0d2137" }}
          >
            Explore all searches →
          </Link>
        </div>
        <HomeTagCard />
      </div>
    </PageWrapper>
  );
}
