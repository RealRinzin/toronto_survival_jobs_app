'use client';
export default function Error({ reset }: { reset: () => void }) {
  return <button onClick={reset}>Something went wrong. Retry</button>;
}