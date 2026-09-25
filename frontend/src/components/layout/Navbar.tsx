import Link from 'next/link'
import React from 'react'

export default function Navigation() {
  return (
    <header className='flex justify-between items-center border-b border-gray-200/70 py-2'>
      <Link href="/" className='font-medium'>TorontSurvivalJobs<span className='text-yellow-600 font-extrabold text-3xl'>.</span>ca</Link>
      <nav className='flex gap-3'>
        <ul className='flex gap-4'>
          <li>Browse Jobs</li>
          <li>Companies</li>
          <li>Categories</li>
        </ul>
        <Link href="/"> Login </Link>
      </nav>
    </header>
  )
}
