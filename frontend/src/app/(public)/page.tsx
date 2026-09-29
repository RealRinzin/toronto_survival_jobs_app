import AdUnit from "@/components/Ads/Ads";
import HomeCategoryGrid from "@/components/home/CategoryGrid";
import HomeFeaturedJobs from "@/components/home/FeaturedJobs";
import HomeHeroSection from "@/components/home/HeroSection";
import HomeHiringticker from "@/components/home/HiringTicker";
import HomePopular from "@/components/home/Popular";
import HomeStatsBar from "@/components/home/Statsbar";
import GeoLocation from "@/components/ui/geo/GeoLocation";
import Image from "next/image";

export default function Home() {

  return (
    <>
      <HomeHeroSection />
      <HomeStatsBar />
      <HomeHiringticker />
      <div className="max-w-7xl mx-auto px-5 py-6 w-full">
        <AdUnit size="leaderboard" />
      </div>
      <HomeCategoryGrid />
      <HomePopular/>
      <HomeFeaturedJobs />
      {/* <GeoLocation/> */}
    </>
    // HeroSection
  );
}
