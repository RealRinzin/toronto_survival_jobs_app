'use client';
import { useState } from 'react';

type Coords = { latitude: number; longitude: number; accuracy: number };

export default function GeoLocation({ onLocate }: { onLocate?: (c: Coords) => void }) {
  const [coords, setCoords] = useState<Coords | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const locate = () => {
    if (!('geolocation' in navigator)) {
      setError('Geolocation is not supported in this browser.');
      return;
    }
    setLoading(true);
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const c = {
          latitude: pos.coords.latitude,
          longitude: pos.coords.longitude,
          accuracy: pos.coords.accuracy, // meters
        };
        setCoords(c);
        setError(null);
        setLoading(false);
        onLocate?.(c);
      },
      (err) => {
        setError(
          err.code === err.PERMISSION_DENIED
            ? 'Location permission was denied.'
            : 'Could not determine your location.'
        );
        setLoading(false);
      },
      { enableHighAccuracy: false, timeout: 10000, maximumAge: 5 * 60 * 1000 }
    );
  };

  return (
    <div>
      <button onClick={locate} disabled={loading}>
        {loading ? 'Locating…' : 'Use my location'}
      </button>
      {coords && <p>{coords.latitude}, {coords.longitude}</p>}
      {error && <p>{error}</p>}
<article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/211850">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>19 WESTERN BATTERY RD TORONTO, ON M6K 3S4</address>ntttttttttt<p>Reference Number CL 211850</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/crew-member/21216">ntttttttttt<h4>Crew Member</h4>ntttttttttt<address>3411 MAVIS ROAD MISSISSAUGA, ON L5C 1T7</address>ntttttttttt<p>Reference Number CL 21216</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/82316">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>8801 WOODBINE AVE MARKHAM, ON L3R 5W9</address>ntttttttttt<p>Reference Number CL 82316</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/82317">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>7690 WOODBINE AVE MARKHAM, ON L3R 1A2</address>ntttttttttt<p>Reference Number CL 82317</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/82322">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>1152 DAVIS DRIVE NEWMARKET, ON L3Y 7V1</address>ntttttttttt<p>Reference Number CL 82322</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/82325">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>2151 STEELES AVE W TORONTO, ON M3J 3N2</address>ntttttttttt<p>Reference Number CL 82325</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/part-time-full-time-crew/211272">ntttttttttt<h4>Part Time/Full Time Crew</h4>ntttttttttt<address>1889 SCUGOG STREET PORT PERRY, ON L9L 1H9</address>ntttttttttt<p>Reference Number CL 211272</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/210266">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>110 BLUE JAYS WAY TORONTO, ON M5V 1K1</address>ntttttttttt<p>Reference Number CL 210266</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members-overnight-shifts/210267">ntttttttttt<h4>Hiring Crew Members Overnight shifts</h4>ntttttttttt<address>110 BLUE JAYS WAY TORONTO, ON M5V 1K1</address>ntttttttttt<p>Reference Number CL 210267</p>ntttttttt</a>ntttttt</article><article className="result">ntttttttt<a href="/job-search/posting/hiring-crew-members/210268">ntttttttttt<h4>Hiring Crew Members</h4>ntttttttttt<address>482 QUEEN STREET WEST TORONTO, ON M5V 2B3</address>ntttttttttt<p>Reference Number CL 210268</p>ntttttttt</a>ntttttt</article>
    </div>
  );
}