import { Suspense } from "react";
import Loading from "./loding";
import Card from "@/components/job/card";

export default async function Jobs() {
  const res = await fetch("https://api.mydummyapi.com/users");
  if(!res.ok) return <p> Error Reload later..</p>
  const users = await res.json();

  return (
    <div>
      {users.map((user: any) => (
        <Suspense key={user.id} fallback={<Loading />}>
          <Card data={user} />
        </Suspense>
      ))}
    </div>
  );
}
