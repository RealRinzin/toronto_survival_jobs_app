
import React from "react";
export default  function Job() {
  return (
    <div>
      <p>Public - {process.env.NEXT_PUBLIC_API_URL}</p>
      <p>Server-{process.env.API_URL}</p>
    </div>
  );
}
