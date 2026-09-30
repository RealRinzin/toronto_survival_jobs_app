import Image from 'next/image'
import React from 'react'

export default function Company() {
  return (
    <>
    <div style={{backgroundColor:'#0046BE'}} className='p-2 w-fit rounded-sm m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/best_buy.svg" alt='bestbuy' className='object-cover' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#C8102E'}} className='p-2 w-fit rounded-sm m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/tim_hortons.svg" className='object-fill' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#005568'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/healthy_planet.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#000'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/adidas.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#000'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/nike.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#000'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/banana_republic.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#000'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/athleta.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#fff'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center'>
      <Image src="http://localhost:8001/storage/img/companies/chipotle.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    <div style={{backgroundColor:'#ffffff'}} className='p-2 w-fit rounded-md m-10 h-14 flex justify-center items-center shadow'>
      <Image src="http://localhost:8001/storage/img/companies/a_w.svg" className='object-contain' alt='bestbuy' height={60} width={60}/>
    </div>
    </>


  )
}
