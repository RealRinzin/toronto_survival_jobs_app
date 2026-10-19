import type { Metadata } from "next";

export const SITE_NAME = "Toronto Survival Jobs.ca";
export const SITE_URL = process.env.NEXT_PUBLIC_SITE_URL ?? "http://localhost:3000";
const DEFAULT_OG_IMAGE = "/og-default.png"; // put a 1200x630 image in /public

type BuildMetadataProps = {
  title: string;
  description: string;
  path: string;
  image?: string;
  type?: "website" | "article";
  noIndex?: boolean;
  keywords?: string[];
};

export function buildMetadata({
  title,
  description,
  path,
  image = DEFAULT_OG_IMAGE,
  type = "website",
  noIndex = false,
  keywords,
}: BuildMetadataProps): Metadata {
  return {
    title,
    description,
    keywords,
    alternates: { canonical: path },
    robots: noIndex ? { index: false, follow: false } : undefined,
    openGraph: {
      title: `${title} | ${SITE_NAME}`,
      description,
      url: path,
      siteName: SITE_NAME,
      type,
      locale: "en_CA",
      images: [{ url: image, width: 1200, height: 630, alt: title }],
    },
    twitter: {
      card: "summary_large_image",
      title: `${title} | ${SITE_NAME}`,
      description,
      images: [image],
    },
  };
}

export function toPlainText(html: string, maxLength = 155) {
  // pass sanitizeHtml(html, { allowedTags: [], allowedAttributes: {} }) as the input
  const text = html.replace(/\s+/g, " ").trim();
  return text.length > maxLength ? text.slice(0, maxLength - 1) + "…" : text;
}