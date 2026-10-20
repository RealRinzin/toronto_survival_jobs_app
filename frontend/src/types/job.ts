interface JobsDType{
    id:number,
    title:string,
    slug:string,
    description:string,
    address:string,
    location:string,
    country:string,
    salary:number,
    published:boolean,
    apply_url:string,
    posted_date:string,
    due_date:string,
    system_posted_date:string,
    // Relationship tables
    employmentType?:EmploymentTypeDType,
    jobCategory:JobCategoriesDType,
    company:CompanyDType,
    area?:areaDtype,
    city:CityDType,
    province:ProvinceDType,
    tags?:TagDType[]
}