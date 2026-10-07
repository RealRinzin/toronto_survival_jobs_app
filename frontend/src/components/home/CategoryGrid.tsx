import Link from "next/link";
import PageWrapper from "../layout/PageWrapper";
export default async function HomeCategoryGrid() {
  const res = await fetch(`${process.env.API_URL}/job_categories/meta_data`)
  if(!res.ok) return <p className="text-red-500 text-xs">Something went wrong, reload again.</p>
  const categories = await res.json()
  console.log(categories)
  return (
    <PageWrapper>
      <div className="flex items-center justify-between mb-7">
        <div>
          <h2
            className="text-2xl font-bold"
            style={{ color: "#0d2137", fontFamily: "'Fraunces', serif" }}
          >
            <Link href='/categories'>
            Browse by Category
            </Link>
          </h2>
          <p className="text-sm mt-0.5" style={{ color: "#6b7c93" }}>
            What kind of work are you looking for?
          </p>
        </div>
        <Link
          href="/categories"
          className="hidden sm:block text-sm font-semibold px-4 py-2 rounded-lg border transition-all hover:bg-gray-50"
          style={{ color: "#d4821a", borderColor: "#fcd5a0" }}
        >
          All Categories →
        </Link>
      </div>
      <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        {categories?.data.slice(0, 6).map((cat:JobCategoriesDType) => (
          <button
            key={cat.slug}
            className="flex flex-col items-center gap-3 p-5 rounded-2xl border text-center transition-all hover:-translate-y-1 hover:shadow-md group"
            style={{ background: "#fff", borderColor: "#e2e8f0" }}
          >
            <div>
              <div
                className="text-sm font-bold leading-tight text-gray-700"
              >
                {cat.name}
              </div>
              <div
                className="text-xs mt-0.5 font-bold"
                style={{ color: cat.color_code }}
              >
                <Link href={`/categories/${cat.slug}`}>
                {cat.job_listings_count} jobs
                </Link>
              </div>
            </div>
          </button>
        ))}
      </div>
    </PageWrapper>
  );
}
