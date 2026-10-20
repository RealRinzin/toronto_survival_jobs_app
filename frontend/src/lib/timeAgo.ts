const rtf = new Intl.RelativeTimeFormat("en", { numeric: "auto" });

const UNITS: [Intl.RelativeTimeFormatUnit, number][] = [
  ["year", 31536000],
  ["month", 2592000],
  ["week", 604800],
  ["day", 86400],
  ["hour", 3600],
  ["minute", 60],
];

export function timeAgo(date: Date | string): string {
  const seconds = Math.round((new Date(date).getTime() - Date.now()) / 1000);
  for (const [unit, secs] of UNITS) {
    if (Math.abs(seconds) >= secs) {
      return rtf.format(Math.round(seconds / secs), unit);
    }
  }
  return "just now";
}