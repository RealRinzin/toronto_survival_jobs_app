interface CityDType {
    id:number,
    name:string,
    slug:string,
    overview:string,
    latitude:number,
    longitude:number,
    provice_id:number
    active:boolean,
    // Relationship Table
    province:ProvinceDType,
}