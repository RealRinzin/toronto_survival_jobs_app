import JobGridCols from "@/components/job/JobCardGrid";
import React from "react";

export default function Industries() {
  return (
    <div>
      Industries
      {/* <JobGridCols/> */}
      <div className="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>5</div>
        <div>6</div>
      </div>
    </div>
  );
}
