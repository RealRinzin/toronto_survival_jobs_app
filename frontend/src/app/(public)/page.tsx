import AdUnit from "@/components/Ads/Ads";
import HomeCategoryGrid from "@/components/home/CategoryGrid";
import HomeFeaturedJobs from "@/components/home/FeaturedJobs";
import HomeHeroSection from "@/components/home/HeroSection";
import HomeHiringticker from "@/components/home/HiringTicker";
import HomeStatsBar from "@/components/home/Statsbar";
import Image from "next/image";

export default function Home() {
  return (
    <>
      <HomeHeroSection />
      <HomeStatsBar />
      <HomeHiringticker />
      <AdUnit size="leaderboard" />
      <HomeCategoryGrid />
      <HomeFeaturedJobs/>
    </>
    // HeroSection
  );
}
