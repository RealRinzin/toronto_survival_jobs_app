import AdUnit from "@/components/Ads/Ads";
import HomeCategoryGrid from "@/components/home/CategoryGrid";
import HomeHeroSection from "@/components/home/HeroSection";
import HomeHiringticker from "@/components/home/HiringTicker";
import HomeStatsBar from "@/components/home/Statsbar";
import Image from "next/image";

export default function Home() {
  return (
    <>
      <HomeHiringticker />
      <HomeHeroSection />
      <HomeStatsBar />
      <AdUnit size="leaderboard" />
      <HomeCategoryGrid />
    </>
    // HeroSection
  );
}
