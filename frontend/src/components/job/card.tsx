import Image from "next/image";
export default  function Card({ product }: any) {
  return (
    <div className="py-10">
      <p>{product?.title}</p>
      <div className="flex gap-2">
      <Image src={product?.image} height={80} width={60} alt="Image"/>
      <p className="text-md">{product?.description}</p>

      </div>
    </div>
  );
}