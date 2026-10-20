import { Suspense } from "react";
import Loading from "./loding";
import Card from "@/components/job/card";
import PageWrapper from "@/components/layout/PageWrapper";

export default async function Jobs() {
  const res = await fetch("https://fakestoreapi.com/products");
  if(!res.ok) return <p> Error Reload later..</p>
  const products = await res.json();

  return (
    <PageWrapper background="bg-gray-50">

      {products.map((product: any) => (
        <Suspense key={product.id} fallback={<Loading />}>
          <Card product={product} />
        </Suspense>
      ))}
      </PageWrapper>
  );
}
