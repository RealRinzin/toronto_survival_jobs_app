import Link from 'next/link'
import React from 'react'
type button ={
    text:string,
    link?:string,
    classes:string,
}
export default function LinkButton({text,link="/",classes=""}:button) {
  return (
    <Link href={link} target='_blank' className={`py-2 flex justify-center text-white items-center rounded-sm font-bold ${classes}`}>
        {text}
    </Link>
    
  )
}
