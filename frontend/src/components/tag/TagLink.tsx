import Link from "next/link";

export default function TagLink({tags}:{tags:TagDType[]}) {
  return (
    <ul className=" flex gap-2">
        {
            tags.map((tag)=>(
                <li key={tag?.id} className="text-xs px-3 py-1.5 rounded-full font-medium border border-border bg-white text-mid-foreground">
                    <Link href={`/tags/${tag?.slug}`}>{tag?.name}</Link>
                </li>
            ))
        }
    </ul>
  )
}
