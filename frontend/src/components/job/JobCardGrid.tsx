import React from "react";
import JobCardSkeleton from "./JobCardSkeleton";
type Cols = 1 | 2 | 3 | 4 | 5 | 6;
type Gap = 1 | 2 | 3 | 4;

interface JobCardGridInterface {
  cols?: Cols;
  gap?: Gap;
  children: React.ReactNode;
  className?: string;
}
const colClasses: Record<Cols, string> = {
  1: "grid-cols-1",
  2: "grid-cols-1 sm:grid-cols-2",
  3: "grid-cols-1 sm:grid-cols-2 lg:grid-cols-3",
  4: "grid-cols-1 sm:grid-cols-2 lg:grid-cols-4",
  5: "grid-cols-1 sm:grid-cols-2 lg:grid-cols-5",
  6: "grid-cols-1 sm:grid-cols-3 lg:grid-cols-6",
};
const gapClasses: Record<Gap, string> = {
  1: "gap-1",
  2: "gap-2",
  3: "gap-3",
  4: "gap-4",
};
export default function JobCardGrid({ cols = 4,gap=4,children,className='' }:JobCardGridInterface) {
  return (
    <div className={`grid ${colClasses[cols]} ${gapClasses[gap]} ${className}`}>
      {children}
    </div>
  );
}
