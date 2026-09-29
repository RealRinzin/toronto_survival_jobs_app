"use client";
import { useState } from "react";

type Coords = { latitude: number; longitude: number; accuracy: number };

export default function GeoLocation({
  onLocate,
}: {
  onLocate?: (c: Coords) => void;
}) {
  const [coords, setCoords] = useState<Coords | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const locate = () => {
    if (!("geolocation" in navigator)) {
      setError("Geolocation is not supported in this browser.");
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
            ? "Location permission was denied."
            : "Could not determine your location.",
        );
        setLoading(false);
      },
      { enableHighAccuracy: false, timeout: 10000, maximumAge: 5 * 60 * 1000 },
    );
  };

  return (
    <div>
      <button onClick={locate} disabled={loading}>
        {loading ? "Locating…" : "Use my location"}
      </button>
      {coords && (
        <p>
          {coords.latitude}, {coords.longitude}
        </p>
      )}
      {error && <p>{error}</p>}
    </div>
  );
}
