import Image from 'next/image'
import React from 'react'

export default async function Companies() {
  const res = await fetch(`${process.env.API_URL}/companies`)
  const companies = await res.json()
  console.log(companies)
  return (
    <div>
      {
        companies.data.map((company:any,index:number)=>{
          return (
            <div key={index}>
                  <div style={{backgroundColor:`${company.brand_color}`}} className='p-2 w-fit rounded-sm m-10 h-14 flex justify-center items-center'>
                    <Image src="http://localhost:8001/storage/img/companies/adidas.svg" alt='bestbuy' className='object-cover' height={60} width={60}/>
                  </div>
            </div>
          )
        })
      }
    </div>
  )
}
