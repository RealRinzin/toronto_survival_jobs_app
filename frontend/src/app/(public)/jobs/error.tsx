// app/jobs/error.tsx
"use client";

export default function Error({
  error,
  reset,
}: {
  error: Error;
  reset: () => void;
}) {
  return (
    <div>
      <h2>Couldn't load jobs</h2>
      <button onClick={() => reset()}>Try again</button>
    </div>
  );
}