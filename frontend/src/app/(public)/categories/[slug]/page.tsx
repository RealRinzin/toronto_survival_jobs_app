import React from "react";

export default async function CategoryDetailPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
const { slug } = await params;
const res = await fetch(`${process.env.API_URL}/job_categories/${slug}`);
const categories = await res.json();
console.log(categories)
  return <div>Category</div>;
}

