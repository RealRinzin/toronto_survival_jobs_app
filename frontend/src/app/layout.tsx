import type { Metadata } from "next";
import { DM_Mono, DM_Sans, Fraunces } from "next/font/google";
import "./globals.css";
import Navigation from "@/components/layout/Navbar";
import Footer from "@/components/layout/Footer";
import PageWrapper from "@/components/layout/PageWrapper";
import { SITE_NAME, SITE_URL } from "@/lib/metadata";

const fraunces = Fraunces({
  variable: "--font-fraunces",
  subsets: ["latin"],
  // weight: ["400", "600", "700"],
  style: ["normal", "italic"],
  // axes:["opsz"],
});
const dmSans = DM_Sans({
  variable: "--font-dm-sans",
  subsets: ["latin"],
  weight: ["400", "500", "600", "700"],
});

const dmMono = DM_Mono({
  variable: "--font-dm-mono",
  subsets: ["latin"],
  weight: ["400", "500"],
});

export const metadata: Metadata = {
  metadataBase: new URL(SITE_URL),
  title: { default: SITE_NAME, template: `%s | ${SITE_NAME}` },
  description: "Toronto Survival Jobs.ca | Find the surival jobs",
};

export default function RootLayout({ children }: LayoutProps<"/">) {
  return (
    <html
      lang="en"
      className={`${fraunces.variable} ${dmSans.variable}  ${dmMono.variable} h-full antialiased`}
    >
      <body className="min-h-full flex flex-col">
        <Navigation />
        {children}
        <Footer />
      </body>
    </html>
  );
}
