import { ReactNode } from "react";

// Small Columns
const smCols = {
    1:"grid-cols-1",
    2:"grid-cols-2",
} as const;

const mdCols = {
    2:"grid-cols-2",
    3:"grid-cols-3",
    4:"grid-cols-4",
    5:"grid-cols-5",
    6:"grid-cols-6",
} as const;


type PageGridWrapperDtyp = {
  children:ReactNode
  sm?:keyof typeof smCols;
  md?:keyof typeof mdCols;

}
export default function PageGridWrapper(
  {children,sm=1,md=3}:PageGridWrapperDtyp
) {
  return (
    <div className={`grid gap-4 ${smCols[sm]} ${mdCols[md]}`}>
        {children}
    </div>
  );
}
