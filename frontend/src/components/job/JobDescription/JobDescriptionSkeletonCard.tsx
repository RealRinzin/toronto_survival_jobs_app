import Skeleton from '@/components/ui/Skeleton/Skeleton'
import React from 'react'

export default function JobDescriptionSkeletonCard() {
  return (
    <div className="rounded-lg border border-gray-200 p-4 space-y-3 bg-gray-100">
      <div className="flex gap-4">
        <Skeleton className="h-10 w-10" />
        <div className="flex flex-col gap-2 w-full">
          <Skeleton className="h-4 w-2/3" />
          <Skeleton className="h-3 w-1/3" />
        </div>
      </div>
      <Skeleton className="h-2 w-2/3" />
      <div className="flex gap-4">
        <Skeleton className="h-4 w-16 rounded-lg" />
        <Skeleton className="h-4 w-16 rounded-lg" />
      </div>
      <Skeleton className="h-3 w-full" />
    </div>
  )
}
