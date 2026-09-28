import PageWrapper from "./PageWrapper";
import Link from "next/link";
import { Icon } from "@phosphor-icons/react";
import {
  XLogoIcon,
  LinkedinLogoIcon,
  FacebookLogoIcon,
  InstagramLogoIcon,
} from "@phosphor-icons/react/ssr";
type socialLinkType = {
  label: string;
  href: string;
  icon: Icon;
};
type BrandType = {
  title: string;
  domain: string;
  description: string;
  social_media: socialLinkType[];
};
const brand: BrandType[] = [
  {
    title: "Brand",
    domain: "TorontonSurvivaljobs.ca",
    description:
      "Connecting Torontonians with work since 2018. Built for newcomers, locals, and everyone making it work.",
    social_media: [
      { label: "x", href: "x.com", icon: XLogoIcon },
      { label: "linkedin", href: "x.com", icon: LinkedinLogoIcon },
      { label: "facebook", href: "x.com", icon: FacebookLogoIcon },
      { label: "instagram", href: "x.com", icon: InstagramLogoIcon },
    ],
  },
];
const footerLinks = [
  {
    title: "Job Seekers",
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
        <div className="grid grid-cols-1 md:grid-cols-4 gap-10 mx-auto">
          {brand.map((brand: BrandType, index: number) => {
            return (
              <ul key={index}>
                <li><p className="text-gray-400">{brand.domain}</p></li>
                <li><p className="text-gray-400">{brand.description}</p></li>
                <ul className="flex gap-4 py-4">
                  {
                    brand?.social_media.map(({label,href,icon:SocialIcon},index:number)=>{
                      return(
                        <li key={index}> <Link href={href}><SocialIcon size={32} weight="fill" className="bg-gray-600 p-1 rounded-sm"/></Link></li>
                      )
                    })
                  }
                </ul>
              </ul>
            );
          })}
          {footerLinks.map((footer: any, index: number) => {
            return (
              <ul key={index} className={"text-xs"}>
                <li className="uppercase py-3 font-bold">{footer?.title}</li>
                <ul>
                  {footer.links.map((link: any, index: number) => {
                    return (
                      <li
                        key={index}
                        className="text-gray-400 font-medium py-1 hover:cursor-pointer"
                      >
                        <Link href={link?.href}>{link?.label}</Link>
                      </li>
                    );
                  })}
                </ul>
              </ul>
            );
          })}
        </div>
      </PageWrapper>
    </footer>
  );
}
