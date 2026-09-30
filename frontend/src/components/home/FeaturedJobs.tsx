import React from 'react'
import JobCard from '../job/JobCard'
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
export default function HomeFeaturedJobs() {
  return (
      <section className="py-14" style={{ background: '#f5f7fa' }}>
        <div className="max-w-7xl mx-auto px-5">
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
              <h2 className="text-2xl font-bold" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>Featured Jobs</h2>
              <p className="text-sm mt-0.5" style={{ color: '#6b7c93',fontFamily:"'DM_Sans',serif" }}>Updated every hour · salary shown upfront</p>
            <div className="flex items-center gap-2 flex-wrap">
              {/* {JOB_TYPES.map(t => (
                <button key={t} onClick={() => setJobType(t)}
                  className="text-xs px-3 py-1.5 rounded-full border font-semibold transition-all"
                  style={{ background: jobType === t ? '#0d2137' : '#fff', color: jobType === t ? '#fff' : '#6b7c93', borderColor: jobType === t ? '#0d2137' : '#e2e8f0' }}>
                  {t}
                </button>
              ))} */}
            </div>
          </div>

          
            <div className="text-center py-16 bg-white rounded-2xl border" style={{ borderColor: '#e2e8f0' }}>
              <svg className="w-10 h-10 mx-auto mb-3" style={{ color: '#94a3b8' }} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={1.5} aria-hidden="true">
                <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
              </svg>
              <p className="font-semibold" style={{ color: '#0d2137' }}>No jobs match your filter.</p>
              <button 
              // onClick={() => setJobType('All Types')} 
              className="mt-3 text-sm font-semibold" style={{ color: '#d4821a' }}>Clear filter</button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">

                  <JobCard/>
            </div>


          <div className="mt-8 text-center">
            <button 
            // onClick={() => setPage('search')}
              className="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90 hover:-translate-y-0.5"
              style={{ background: 'linear-gradient(135deg, #0d2137, #1e4976)', boxShadow: '0 4px 16px rgba(13,33,55,0.25)' }}>
              View all {'>'}14,000 jobs with advanced filters →
            </button>
          </div>
        </div>
      </section>
  )
}
