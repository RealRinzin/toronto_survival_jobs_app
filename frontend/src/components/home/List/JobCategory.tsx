import Link from "next/link";
import React from "react";

export default async function JobCategory() {
  const res = await fetch(`${process.env.API_URL}/job_categories/meta_data`);
  const { data: categories } = await res.json();

  return (
    <ul className="flex gap-2">
      {categories.slice(0,6).map((category: JobCategoriesDType, index: number) => (
        <li key={index}>
          <Link
            className="text-xs px-3 py-1 rounded-full transition-all hover:bg-white hover:text-gray-900 font-medium"
            style={{
              background: "rgba(255,255,255,0.1)",
              color: "rgba(255,255,255,0.75)",
              border: "1px solid rgba(255,255,255,0.14)",
            }}
            href={`/categories/${category.slug}`}
          >
          {category.name}({category?.job_listings_count})
          </Link>
        </li>
      ))}
    </ul>
  );
}
