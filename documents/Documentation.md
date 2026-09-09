# Notes on capstone project guide and ideas

## Location API track for the city
```js
const torontoDistricts = [
  { name: 'Etobicoke',  latMin: 43.58, latMax: 43.75, lonMin: -79.62, lonMax: -79.50 },
  { name: 'North York', latMin: 43.71, latMax: 43.80, lonMin: -79.50, lonMax: -79.35 },
  { name: 'York',       latMin: 43.66, latMax: 43.71, lonMin: -79.50, lonMax: -79.44 },
  { name: 'Old Toronto',latMin: 43.63, latMax: 43.71, lonMin: -79.44, lonMax: -79.30 },
  { name: 'East York',  latMin: 43.68, latMax: 43.72, lonMin: -79.34, lonMax: -79.29 },
  { name: 'Scarborough',latMin: 43.70, latMax: 43.83, lonMin: -79.30, lonMax: -79.13 },
];
```
<!-- Get the system internet IP with detaial of the GEO coordinate -->
```js
async function getPublicIP() {
  // console.log(data)
   const detail = await fetch(`https://ipwho.is/`);
  // return res.json();
console.log(await detail.json())
  return data.ip;
}

const ip = await getPublicIP();
console.log(ip)
// console.log(check)
```