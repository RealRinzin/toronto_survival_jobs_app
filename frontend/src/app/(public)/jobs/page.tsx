import { Suspense } from "react";
import Loading from "./loding";
import Card from "@/components/job/card";

export default async function Jobs() {
  const data = await fetch("https://api.mydummyapi.com/users");
  const users = await data.json();

  return (
    <div>
      {users.map((user: any) => (
        <Suspense
          key={user.id}
          fallback={<Loading />}
        >
          <Card data={user} />
        </Suspense>
      ))}
    </div>
  );
}