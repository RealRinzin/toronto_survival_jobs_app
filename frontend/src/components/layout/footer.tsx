import React from "react";
import PageWrapper from "./PageWrapper";
import Link from "next/link";
const FooterLinks = [
  {
    title: "jobSeeker",
    links: [
      { label: "Browser Jobs", href: "/jobs" },
      { label: "Companies", href: "/companies" },
      { label: "categories", href: "/categories" },
      { label: "Blogs", href: "/blogs" },
    ],
  },
  {
    title: "Company",
    links: [
      { label: "About Us", href: "/about" },
      { label: "Contact Us", href: "/contact" },
      { label: "Privacy Policy", href: "/privacy" },
      { label: "Blogs", href: "/blogs" },
    ],
  },
];
export default function Footer() {
  return (
    <footer className="bg-blue-950 text-white ">
      <PageWrapper>
        <div className="grid grid-cols-1 md:grid-cols-4">
          <ul className="flex flex-col">
            <li>Test</li>
          </ul>
          <ul>
            <li>
              <Link href="">Browser</Link>
            </li>
          </ul>
          <ul>
            <li>ONe</li>
          </ul>
          <ul>
            <li>ONe</li>
          </ul>
        </div>
      </PageWrapper>
    </footer>
  );
}
