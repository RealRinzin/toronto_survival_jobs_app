interface TagDType {
    id:number,
    name:string,
    slug:string,
    active:boolean
    tagline:string,
    description:string,
    job_listings_count?:number,
    jobs?:JobsDType
}