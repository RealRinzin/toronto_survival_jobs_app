"use client"
import { useState } from 'react'

type LoginPageProps = {
  onHome: () => void
  onGoRegister: () => void
  onLoginSuccess: () => void
}

export default function LoginPage({ onHome, onGoRegister, onLoginSuccess }: LoginPageProps) {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [loading, setLoading] = useState(false)
  const [googleLoading, setGoogleLoading] = useState(false)
  const [error, setError] = useState('')
  const [forgotSent, setForgotSent] = useState(false)
  const [showForgot, setShowForgot] = useState(false)
  const [forgotEmail, setForgotEmail] = useState('')

  const handleEmailLogin = async (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    if (!email || !password) { setError('Please fill in all fields.'); return }
    setLoading(true)
    // TODO: replace with Supabase auth
    // const { error } = await supabase.auth.signInWithPassword({ email, password })
    await new Promise(r => setTimeout(r, 1200))
    setLoading(false)
    onLoginSuccess()
  }

  const handleGoogleLogin = async () => {
    setGoogleLoading(true)
    // TODO: replace with Supabase OAuth
    // await supabase.auth.signInWithOAuth({ provider: 'google', options: { redirectTo: window.location.origin } })
    await new Promise(r => setTimeout(r, 1000))
    setGoogleLoading(false)
    onLoginSuccess()
  }

  const handleForgotPassword = async (e: React.FormEvent) => {
    e.preventDefault()
    // TODO: await supabase.auth.resetPasswordForEmail(forgotEmail)
    await new Promise(r => setTimeout(r, 800))
    setForgotSent(true)
  }

  return (
    <div className="min-h-screen flex" style={{ fontFamily: "'DM Sans', sans-serif" }}>

      {/* ── LEFT PANEL — branding ── */}
      <div className="hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col relative overflow-hidden"
        style={{ background: 'linear-gradient(160deg, #0d2137 0%, #1e4976 60%, #0d2137 100%)' }}>
        {/* Subtle grid texture */}
        <div className="absolute inset-0 opacity-5"
          style={{ backgroundImage: 'linear-gradient(rgba(255,255,255,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.4) 1px, transparent 1px)', backgroundSize: '48px 48px' }} />

        {/* Toronto skyline photo strip */}
        <div className="absolute bottom-0 left-0 right-0 h-48 opacity-20">
          <img src="https://images.unsplash.com/photo-1507992781348-310259076fe0?w=800&h=300&fit=crop&auto=format"
            alt="" className="w-full h-full object-cover object-top" />
          <div className="absolute inset-0" style={{ background: 'linear-gradient(to bottom, #0d2137, transparent 40%)' }} />
        </div>

        <div className="relative flex flex-col justify-between h-full p-10">
          {/* Logo */}
          <button onClick={onHome} className="flex items-center gap-2.5 w-fit">
            <div className="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold"
              style={{ background: 'rgba(255,255,255,0.12)', border: '1px solid rgba(255,255,255,0.2)' }}>T</div>
            <span className="font-bold text-xl text-white" style={{ fontFamily: "'Fraunces', serif" }}>
              TorontoJobs<span style={{ color: '#f0a94a' }}>.</span>ca
            </span>
          </button>

          {/* Central copy */}
          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-6"
              style={{ background: 'rgba(240,169,74,0.15)', color: '#f0a94a', border: '1px solid rgba(240,169,74,0.25)' }}>
              <span className="w-1.5 h-1.5 rounded-full bg-current animate-pulse" />
              14,200+ jobs across the GTA
            </div>
            <h2 className="text-4xl font-bold text-white leading-tight mb-4"
              style={{ fontFamily: "'Fraunces', serif" }}>
              Your next Toronto<br />job is one click away
            </h2>
            <p className="text-base leading-relaxed" style={{ color: 'rgba(255,255,255,0.6)' }}>
              Sign in to save jobs, track your applications, and get alerts when new roles match your profile.
            </p>
          </div>

          {/* Trust badges */}
          <div className="space-y-3">
            {[
              { icon: '💼', text: 'Save jobs and apply with one tap' },
              { icon: '🔔', text: 'Get alerts for new matching jobs' },
              { icon: '📊', text: 'Track all your applications in one place' },
            ].map(item => (
              <div key={item.text} className="flex items-center gap-3">
                <div className="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                  style={{ background: 'rgba(255,255,255,0.08)' }}>
                  <span className="text-sm">{item.icon}</span>
                </div>
                <span className="text-sm" style={{ color: 'rgba(255,255,255,0.65)' }}>{item.text}</span>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* ── RIGHT PANEL — form ── */}
      <div className="flex-1 flex flex-col justify-center items-center px-5 py-12" style={{ background: '#fff' }}>
        {/* Mobile logo */}
        <button onClick={onHome} className="lg:hidden flex items-center gap-2 mb-8">
          <div className="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm font-bold"
            style={{ background: 'linear-gradient(135deg, #0d2137, #1e4976)' }}>T</div>
          <span className="font-bold text-lg" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
            TorontoJobs<span style={{ color: '#d4821a' }}>.</span>ca
          </span>
        </button>

        <div className="w-full" style={{ maxWidth: 420 }}>

          {!showForgot ? (
            <>
              <div className="mb-8">
                <h1 className="text-3xl font-bold mb-1" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
                  Welcome back
                </h1>
                <p className="text-sm" style={{ color: '#6b7c93' }}>
                  Sign in to your TorontoJobs account
                </p>
              </div>

              {/* Google Sign In */}
              <button onClick={handleGoogleLogin} disabled={googleLoading}
                className="w-full flex items-center justify-center gap-3 py-3 rounded-xl border text-sm font-semibold transition-all hover:bg-gray-50 hover:shadow-sm active:scale-95 mb-4 disabled:opacity-60"
                style={{ borderColor: '#e2e8f0', color: '#0f1923', background: '#fff' }}>
                {googleLoading ? (
                  <Spinner size="sm" />
                ) : (
                  <svg className="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                  </svg>
                )}
                {googleLoading ? 'Signing in…' : 'Continue with Google'}
              </button>

              {/* Divider */}
              <div className="flex items-center gap-3 mb-4">
                <div className="flex-1 h-px" style={{ background: '#e2e8f0' }} />
                <span className="text-xs font-medium" style={{ color: '#94a3b8' }}>or sign in with email</span>
                <div className="flex-1 h-px" style={{ background: '#e2e8f0' }} />
              </div>

              {/* Error */}
              {error && (
                <div className="flex items-center gap-2 px-3 py-2.5 rounded-lg mb-4 text-sm"
                  style={{ background: '#fef2f2', border: '1px solid #fecaca', color: '#dc2626' }}>
                  <svg className="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {error}
                </div>
              )}

              {/* Email/Password form */}
              <form onSubmit={handleEmailLogin} className="space-y-4">
                <FormField label="Email Address" htmlFor="email">
                  <input id="email" type="email" placeholder="you@email.com" value={email}
                    onChange={e => setEmail(e.target.value)} autoComplete="email"
                    className="w-full text-sm px-4 py-3 rounded-xl border outline-none transition-all"
                    style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                    onFocus={e => e.target.style.borderColor = '#d4821a'}
                    onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                </FormField>

                <FormField label="Password" htmlFor="password"
                  action={
                    <button type="button" onClick={() => setShowForgot(true)}
                      className="text-xs font-semibold transition-colors hover:opacity-70"
                      style={{ color: '#d4821a' }}>
                      Forgot password?
                    </button>
                  }>
                  <div className="relative">
                    <input id="password" type={showPassword ? 'text' : 'password'}
                      placeholder="••••••••" value={password}
                      onChange={e => setPassword(e.target.value)} autoComplete="current-password"
                      className="w-full text-sm px-4 py-3 pr-11 rounded-xl border outline-none transition-all"
                      style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                      onFocus={e => e.target.style.borderColor = '#d4821a'}
                      onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                    <button type="button" onClick={() => setShowPassword(!showPassword)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 p-1 transition-colors hover:opacity-70"
                      style={{ color: '#94a3b8' }}>
                      {showPassword
                        ? <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}><path strokeLinecap="round" strokeLinejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21" /></svg>
                        : <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}><path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path strokeLinecap="round" strokeLinejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                      }
                    </button>
                  </div>
                </FormField>

                <button type="submit" disabled={loading}
                  className="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90 active:scale-95 disabled:opacity-60 mt-2"
                  style={{ background: 'linear-gradient(135deg, #d4821a, #e0972e)', boxShadow: '0 4px 14px rgba(212,130,26,0.3)' }}>
                  {loading ? <span className="flex items-center justify-center gap-2"><Spinner size="sm" color="white" /> Signing in…</span> : 'Sign In'}
                </button>
              </form>

              <p className="text-sm text-center mt-6" style={{ color: '#6b7c93' }}>
                Don't have an account?{' '}
                <button onClick={onGoRegister} className="font-semibold transition-colors hover:opacity-70" style={{ color: '#d4821a' }}>
                  Create one free
                </button>
              </p>
            </>
          ) : (
            /* ── FORGOT PASSWORD ── */
            <>
              <button onClick={() => { setShowForgot(false); setForgotSent(false) }}
                className="flex items-center gap-1.5 text-sm font-medium mb-6 transition-colors hover:opacity-70"
                style={{ color: '#6b7c93' }}>
                <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                  <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to sign in
              </button>

              {!forgotSent ? (
                <>
                  <div className="mb-6">
                    <div className="w-12 h-12 rounded-xl flex items-center justify-center mb-4"
                      style={{ background: 'rgba(212,130,26,0.1)' }}>
                      <span className="text-2xl">🔑</span>
                    </div>
                    <h2 className="text-2xl font-bold mb-1" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
                      Reset your password
                    </h2>
                    <p className="text-sm" style={{ color: '#6b7c93' }}>
                      Enter your email and we'll send you a reset link.
                    </p>
                  </div>
                  <form onSubmit={handleForgotPassword} className="space-y-4">
                    <FormField label="Email Address" htmlFor="forgot-email">
                      <input id="forgot-email" type="email" placeholder="you@email.com"
                        value={forgotEmail} onChange={e => setForgotEmail(e.target.value)}
                        className="w-full text-sm px-4 py-3 rounded-xl border outline-none transition-all"
                        style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                        onFocus={e => e.target.style.borderColor = '#d4821a'}
                        onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                    </FormField>
                    <button type="submit"
                      className="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90"
                      style={{ background: 'linear-gradient(135deg, #d4821a, #e0972e)' }}>
                      Send Reset Link
                    </button>
                  </form>
                </>
              ) : (
                <div className="text-center py-6">
                  <div className="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4"
                    style={{ background: 'rgba(34,197,94,0.1)' }}>
                    <svg className="w-7 h-7" style={{ color: '#16a34a' }} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                      <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <h3 className="text-xl font-bold mb-2" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>Check your email</h3>
                  <p className="text-sm" style={{ color: '#6b7c93' }}>
                    We sent a reset link to <strong style={{ color: '#0d2137' }}>{forgotEmail}</strong>.<br />
                    It expires in 15 minutes.
                  </p>
                </div>
              )}
            </>
          )}

          {/* Footer note */}
          <p className="text-xs text-center mt-8" style={{ color: '#94a3b8' }}>
            By signing in you agree to our{' '}
            <a href="#" className="underline hover:text-gray-700">Terms</a> and{' '}
            <a href="#" className="underline hover:text-gray-700">Privacy Policy</a>.
          </p>
        </div>
      </div>
    </div>
  )
}

/* ── Helpers ── */

function FormField({ label, htmlFor, children, action }: {
  label: string; htmlFor: string; children: React.ReactNode; action?: React.ReactNode
}) {
  return (
    <div>
      <div className="flex items-center justify-between mb-1.5">
        <label htmlFor={htmlFor} className="text-xs font-semibold" style={{ color: '#0d2137' }}>{label}</label>
        {action}
      </div>
      {children}
    </div>
  )
}

function Spinner({ size = 'md', color = 'amber' }: { size?: 'sm' | 'md'; color?: 'amber' | 'white' }) {
  const sz = size === 'sm' ? 'w-4 h-4' : 'w-5 h-5'
  const col = color === 'white' ? 'border-white border-t-transparent' : 'border-amber-500 border-t-transparent'
  return <div className={`${sz} rounded-full border-2 ${col} animate-spin`} />
}
