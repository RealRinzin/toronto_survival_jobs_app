interface areaDtype{
    id:number,
    name:string,
    slug:string,
    overview:string,
    latitude:number,
    longitude:number,
    active:boolean,
    // Relationship Table
    city:CityDType,
}