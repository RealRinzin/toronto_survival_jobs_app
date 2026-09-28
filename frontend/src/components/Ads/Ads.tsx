/**
 * AdUnit — drop-in Google AdSense placeholder.
 * Replace the inner div with a real <ins class="adsbygoogle"> tag when going live.
 *
 * Standard sizes used across this portal:
 *   leaderboard   728×90   — between page sections (desktop)
 *   rectangle     336×280  — in-feed between job cards
 *   sidebar       300×250  — sticky sidebars
 *   mobile-banner 320×50   — top of mobile pages
 */

type AdSize = 'leaderboard' | 'rectangle' | 'sidebar' | 'mobile-banner'

const SIZE_MAP: Record<AdSize, { w: number | string; h: number; label: string; slot: string }> = {
  'leaderboard':    { w: '100%', h: 90,  label: 'Leaderboard — 728×90',      slot: 'XXXXXXXXXX' },
  'rectangle':      { w: '100%', h: 280, label: 'Large Rectangle — 336×280',  slot: 'XXXXXXXXXX' },
  'sidebar':        { w: '100%', h: 250, label: 'Medium Rectangle — 300×250', slot: 'XXXXXXXXXX' },
  'mobile-banner':  { w: '100%', h: 50,  label: 'Mobile Banner — 320×50',     slot: 'XXXXXXXXXX' },
}

export default function AdUnit({ size, className = '' }: { size: AdSize; className?: string }) {
  const { w, h, label } = SIZE_MAP[size]

  return (
    <div className={className} style={{ width: w, maxWidth: size === 'sidebar' ? 300 : size === 'rectangle' ? 336 : '100%' }}>
      {/*
        LIVE SWAP: replace everything below with:

        <ins
          className="adsbygoogle"
          style={{ display: 'block' }}
          data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
          data-ad-slot={SIZE_MAP[size].slot}
          data-ad-format="auto"
          data-full-width-responsive="true"
        />

        And add this to index.html <head>:
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX" crossOrigin="anonymous"></script>
      */}
      <div
        style={{
          width: '100%',
          height: h,
          background: 'repeating-linear-gradient(45deg, #f8fafc, #f8fafc 10px, #f0f4f8 10px, #f0f4f8 20px)',
          border: '1.5px dashed #cbd5e1',
          borderRadius: 8,
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          justifyContent: 'center',
          gap: 4,
          userSelect: 'none',
        }}
      >
        <span style={{ fontSize: 11, color: '#94a3b8', fontWeight: 600, letterSpacing: '0.05em', textTransform: 'uppercase' }}>
          Advertisement
        </span>
        <span style={{ fontSize: 10, color: '#cbd5e1' }}>{label}</span>
        <span style={{ fontSize: 10, color: '#cbd5e1' }}>Google AdSense</span>
      </div>
    </div>
  )
}
