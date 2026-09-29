import React, { Fragment } from 'react'
const JOBS = [
  { id: 1, title: 'Warehouse Associate', company: 'Amazon Fulfillment', logo: 'AM', logoColor: '#FF9900', location: 'Scarborough, ON', type: 'Full-time', salary: '$19–$22/hr', tags: ['Physical', 'No Experience'], posted: '2h ago', hot: true, rating: 3.8 },
  { id: 2, title: 'Food Service Worker', company: 'Tim Hortons', logo: 'TH', logoColor: '#c8102e', location: 'Downtown Toronto', type: 'Part-time', salary: '$17.20/hr', tags: ['Flexible Hours', 'Entry Level'], posted: '5h ago', hot: false, rating: 3.4 },
  { id: 3, title: 'Customer Service Rep', company: 'Rogers Communications', logo: 'RC', logoColor: '#da1f2b', location: 'North York, ON', type: 'Full-time', salary: '$21–$25/hr', tags: ['Bilingual Bonus', 'Benefits'], posted: '1d ago', hot: false, rating: 3.6 },
  { id: 4, title: 'Line Cook', company: 'Freshii Canada', logo: 'FR', logoColor: '#5cb85c', location: 'Kensington Market', type: 'Full-time', salary: '$18–$20/hr', tags: ['Food Handler Cert', 'Tips'], posted: '3h ago', hot: true, rating: 3.9 },
  { id: 5, title: 'Delivery Driver', company: 'Purolator', logo: 'PU', logoColor: '#ff6200', location: 'Etobicoke, ON', type: 'Full-time', salary: '$23–$27/hr', tags: ['License Required', 'Benefits'], posted: '6h ago', hot: false, rating: 4.0 },
  { id: 6, title: 'Retail Sales Associate', company: "Hudson's Bay", logo: 'HB', logoColor: '#003087', location: 'Eaton Centre, Toronto', type: 'Part-time', salary: '$17.20–$19/hr', tags: ['Staff Discount', 'Flexible'], posted: '2d ago', hot: false, rating: 3.2 },
  { id: 7, title: 'Security Guard', company: 'Securitas Canada', logo: 'SC', logoColor: '#cc0000', location: 'Mississauga, ON', type: 'Full-time', salary: '$20–$24/hr', tags: ['License Required', 'Nights'], posted: '12h ago', hot: true, rating: 3.5 },
  { id: 8, title: 'Cashier', company: 'Loblaws Companies', logo: 'LC', logoColor: '#e2231a', location: 'Brampton, ON', type: 'Part-time', salary: '$17.20/hr', tags: ['No Experience', 'Weekends'], posted: '4h ago', hot: false, rating: 3.7 },
]
export default function JobCard() {
  return (
    <div 
      className="group bg-white rounded-2xl border p-5 flex flex-col gap-4 transition-all hover:shadow-lg hover:-translate-y-0.5 cursor-pointer relative overflow-hidden"
      style={{ borderColor: '#e2e8f0' }}>
        {
          JOBS.map((job:any,index:number)=>{
            return(
              <Fragment key={index}>
            {job.hot && (
              <div className="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl" style={{ background: 'linear-gradient(180deg, #d4821a, #f0a94a)' }} />
            )}
      <div className="flex items-start gap-3 pl-1">
        <div className="w-11 h-11 rounded-xl flex items-center justify-center text-sm font-bold flex-shrink-0 shadow-sm"
          style={{ background: job.logoColor + '18', color: job.logoColor, border: `1.5px solid ${job.logoColor}28` }}>
          {job.logo}
        </div>
        <div className="flex-1 min-w-0">
          <div className="flex items-start justify-between gap-2">
            <div className="min-w-0">
              <h3 className="font-bold text-base leading-tight truncate transition-colors group-hover:text-blue-900" style={{ color: '#0f1923' }}>
                {job.title}
              </h3>
              <p className="text-sm" style={{ color: '#6b7c93' }}>{job.company}</p>
            </div>
            {job.hot && (
              <span className="text-xs font-bold px-2 py-0.5 rounded-full flex-shrink-0 mt-0.5"
                style={{ background: 'rgba(200,129,14,0.1)', color: '#d4821a', border: '1px solid rgba(200,129,14,0.22)' }}>
                Hiring fast
              </span>
            )}
          </div>
          <div className="mt-1.5">
            {/* <StarRating rating={job.rating} /> */}
          </div>
        </div>
      </div>

      <div className="flex flex-wrap gap-x-4 gap-y-1 pl-1 text-xs" style={{ color: '#6b7c93' }}>
        <span className="flex items-center gap-1">
          <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          {job.location}
        </span>
        <span className="flex items-center gap-1">
          <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          {job.type}
        </span>
        <span className="text-xs" style={{ color: '#94a3b8' }}>{job.posted}</span>
      </div>

      <div className="flex flex-wrap gap-1.5 pl-1">
        {job.tags.map(tag => (
          <span key={tag} className="text-xs px-2.5 py-1 rounded-lg font-medium"
            style={{ background: '#e2e8f0', color: '#4a6380' }}>{tag}</span>
        ))}
      </div>

      <div className="flex items-center justify-between pt-3 border-t pl-1" style={{ borderColor: '#e2e8f0' }}>
        <div className="flex items-baseline gap-1">
          <span className="font-bold text-lg" style={{ color: '#0d2137', fontFamily: "'DM Mono', monospace" }}>{job.salary}</span>
        </div>
        <div className="flex items-center gap-2">
          <button 
          // onClick={e => { e.stopPropagation(); onSave() }}
            className="w-8 h-8 rounded-lg flex items-center justify-center border transition-all hover:border-amber-400"
            // style={{ borderColor: saved ? '#d4821a' : '#e2e8f0', background: saved ? '#fff5eb' : '#fff', color: saved ? '#d4821a' : '#cbd5e1' }}
            aria-label="Save job">
            {/* <svg className="w-4 h-4" viewBox="0 0 24 24" fill={saved ? 'currentColor' : 'none'} stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg> */}
          </button>
          <button className="text-xs font-bold px-4 py-2 rounded-lg text-white transition-all hover:opacity-90 active:scale-95"
            style={{ background: 'linear-gradient(135deg, #0d2137, #1e4976)' }}>
            View Job
          </button>
        </div>
      </div>
              </Fragment>
            )
          })
        }
      {/* Hot job left accent */}
    </div>
  )
}
