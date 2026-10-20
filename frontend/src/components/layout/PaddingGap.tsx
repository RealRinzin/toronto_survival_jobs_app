import { ReactNode } from "react";

export default function PaddingGap({children}:{children:ReactNode}) {
  return (
    <div className="bg-white rounded-2xl border border-border p-6 sm:p-8 space-y-6 my-6"> 
        {children}
    </div>
  )
}
