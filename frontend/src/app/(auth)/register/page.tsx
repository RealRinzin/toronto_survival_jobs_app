"use client"
import { useState } from 'react'

type RegisterPageProps = {
  onHome: () => void
  onGoLogin: () => void
  onRegisterSuccess: () => void
}

const AREAS = ['Downtown Toronto', 'Scarborough', 'North York', 'Etobicoke', 'Mississauga', 'Brampton', 'Other GTA']
export default function RegisterPage({ onHome, onGoLogin, onRegisterSuccess }: RegisterPageProps) {
  const [step, setStep] = useState<1 | 2>(1)
  const [googleLoading, setGoogleLoading] = useState(false)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [showConfirm, setShowConfirm] = useState(false)

  // Step 1 fields
  const [firstName, setFirstName] = useState('')
  const [lastName, setLastName] = useState('')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [confirmPassword, setConfirmPassword] = useState('')

  // Step 2 fields
  const [area, setArea] = useState('')
  const [jobType, setJobType] = useState('')
  const [resumeFile, setResumeFile] = useState<File | null>(null)
  const [agreedToTerms, setAgreedToTerms] = useState(false)

  const passwordStrength = getPasswordStrength(password)

  const handleGoogleRegister = async () => {
    setGoogleLoading(true)
    // TODO: await supabase.auth.signInWithOAuth({ provider: 'google' })
    await new Promise(r => setTimeout(r, 1000))
    setGoogleLoading(false)
    onRegisterSuccess()
  }

  const handleStep1 = (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    if (!firstName || !lastName || !email || !password || !confirmPassword) {
      setError('Please fill in all fields.'); return
    }
    if (password !== confirmPassword) {
      setError('Passwords do not match.'); return
    }
    if (passwordStrength.score < 2) {
      setError('Please choose a stronger password.'); return
    }
    setStep(2)
  }

  const handleStep2 = async (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    if (!agreedToTerms) {
      setError('Please agree to the Terms of Service to continue.'); return
    }
    setLoading(true)
    // TODO: Supabase sign up
    // const { data, error } = await supabase.auth.signUp({ email, password, options: { data: { full_name: `${firstName} ${lastName}`, area, job_type: jobType } } })
    // if (data.user) await supabase.from('users').insert({ id: data.user.id, full_name: ..., area, ... })
    await new Promise(r => setTimeout(r, 1400))
    setLoading(false)
    onRegisterSuccess()
  }

  return (
    <div className="min-h-screen flex" style={{ fontFamily: "'DM Sans', sans-serif" }}>

      {/* ── LEFT PANEL ── */}
      <div className="hidden lg:flex lg:w-5/12 xl:w-1/2 flex-col relative overflow-hidden"
        style={{ background: 'linear-gradient(160deg, #0d2137 0%, #1e4976 60%, #0d2137 100%)' }}>
        <div className="absolute inset-0 opacity-5"
          style={{ backgroundImage: 'linear-gradient(rgba(255,255,255,0.4) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.4) 1px, transparent 1px)', backgroundSize: '48px 48px' }} />

        <div className="absolute bottom-0 left-0 right-0 h-48 opacity-20">
          <img src="https://images.unsplash.com/photo-1569982615761-66697da68502?w=800&h=300&fit=crop&auto=format"
            alt="" className="w-full h-full object-cover object-top" />
          <div className="absolute inset-0" style={{ background: 'linear-gradient(to bottom, #0d2137, transparent 40%)' }} />
        </div>

        <div className="relative flex flex-col justify-between h-full p-10">
          <button onClick={onHome} className="flex items-center gap-2.5 w-fit">
            <div className="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold"
              style={{ background: 'rgba(255,255,255,0.12)', border: '1px solid rgba(255,255,255,0.2)' }}>T</div>
            <span className="font-bold text-xl text-white" style={{ fontFamily: "'Fraunces', serif" }}>
              TorontoJobs<span style={{ color: '#f0a94a' }}>.</span>ca
            </span>
          </button>

          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold mb-6"
              style={{ background: 'rgba(240,169,74,0.15)', color: '#f0a94a', border: '1px solid rgba(240,169,74,0.25)' }}>
              <span className="w-1.5 h-1.5 rounded-full bg-current animate-pulse" />
              Free to join · No hidden fees
            </div>
            <h2 className="text-4xl font-bold text-white leading-tight mb-4"
              style={{ fontFamily: "'Fraunces', serif" }}>
              Join 92,000+<br />Torontonians<br />who found work here
            </h2>
            <p className="text-base leading-relaxed" style={{ color: 'rgba(255,255,255,0.6)' }}>
              Create a free account and start applying to jobs across the GTA — no resume required to get started.
            </p>
          </div>

          {/* Step indicator on left panel */}
          <div className="space-y-3">
            {[
              { num: 1, label: 'Create your account' },
              { num: 2, label: 'Set your preferences' },
            ].map(s => (
              <div key={s.num} className="flex items-center gap-3">
                <div className={`w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 transition-all`}
                  style={{
                    background: step >= s.num ? '#d4821a' : 'rgba(255,255,255,0.1)',
                    color: step >= s.num ? '#fff' : 'rgba(255,255,255,0.4)',
                    border: step === s.num ? '2px solid #f0a94a' : '2px solid transparent',
                  }}>
                  {step > s.num
                    ? <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={3}><path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" /></svg>
                    : s.num}
                </div>
                <span className="text-sm" style={{ color: step >= s.num ? 'rgba(255,255,255,0.9)' : 'rgba(255,255,255,0.35)' }}>
                  {s.label}
                </span>
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* ── RIGHT PANEL ── */}
      <div className="flex-1 flex flex-col justify-center items-center px-5 py-12" style={{ background: '#fff' }}>

        {/* Mobile logo */}
        <button onClick={onHome} className="lg:hidden flex items-center gap-2 mb-8">
          <div className="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm font-bold"
            style={{ background: 'linear-gradient(135deg, #0d2137, #1e4976)' }}>T</div>
          <span className="font-bold text-lg" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
            TorontoJobs<span style={{ color: '#d4821a' }}>.</span>ca
          </span>
        </button>

        {/* Mobile step indicator */}
        <div className="lg:hidden flex items-center gap-2 mb-6">
          {[1, 2].map(s => (
            <div key={s} className="flex items-center gap-2">
              <div className="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold"
                style={{
                  background: step >= s ? '#d4821a' : '#f0f4f8',
                  color: step >= s ? '#fff' : '#6b7c93',
                }}>
                {step > s ? '✓' : s}
              </div>
              {s < 2 && <div className="w-8 h-0.5" style={{ background: step > s ? '#d4821a' : '#e2e8f0' }} />}
            </div>
          ))}
          <span className="text-xs ml-1" style={{ color: '#6b7c93' }}>Step {step} of 2</span>
        </div>

        <div className="w-full" style={{ maxWidth: 420 }}>

          {/* ── STEP 1 ── */}
          {step === 1 && (
            <>
              <div className="mb-6">
                <h1 className="text-3xl font-bold mb-1" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
                  Create your account
                </h1>
                <p className="text-sm" style={{ color: '#6b7c93' }}>Free forever. No credit card needed.</p>
              </div>

              {/* Google */}
              <button onClick={handleGoogleRegister} disabled={googleLoading}
                className="w-full flex items-center justify-center gap-3 py-3 rounded-xl border text-sm font-semibold transition-all hover:bg-gray-50 hover:shadow-sm active:scale-95 mb-4 disabled:opacity-60"
                style={{ borderColor: '#e2e8f0', color: '#0f1923', background: '#fff' }}>
                {googleLoading
                  ? <Spinner size="sm" />
                  : <svg className="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                  </svg>
                }
                {googleLoading ? 'Connecting…' : 'Sign up with Google'}
              </button>

              <div className="flex items-center gap-3 mb-4">
                <div className="flex-1 h-px" style={{ background: '#e2e8f0' }} />
                <span className="text-xs font-medium" style={{ color: '#94a3b8' }}>or register with email</span>
                <div className="flex-1 h-px" style={{ background: '#e2e8f0' }} />
              </div>

              {error && <ErrorBanner message={error} />}

              <form onSubmit={handleStep1} className="space-y-4">
                <div className="grid grid-cols-2 gap-3">
                  <FormField label="First Name" htmlFor="firstName">
                    <input id="firstName" type="text" placeholder="Alex" value={firstName}
                      onChange={e => setFirstName(e.target.value)} autoComplete="given-name"
                      className="w-full text-sm px-4 py-3 rounded-xl border outline-none transition-all"
                      style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                      onFocus={e => e.target.style.borderColor = '#d4821a'}
                      onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                  </FormField>
                  <FormField label="Last Name" htmlFor="lastName">
                    <input id="lastName" type="text" placeholder="Chen" value={lastName}
                      onChange={e => setLastName(e.target.value)} autoComplete="family-name"
                      className="w-full text-sm px-4 py-3 rounded-xl border outline-none transition-all"
                      style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                      onFocus={e => e.target.style.borderColor = '#d4821a'}
                      onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                  </FormField>
                </div>

                <FormField label="Email Address" htmlFor="reg-email">
                  <input id="reg-email" type="email" placeholder="you@email.com" value={email}
                    onChange={e => setEmail(e.target.value)} autoComplete="email"
                    className="w-full text-sm px-4 py-3 rounded-xl border outline-none transition-all"
                    style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                    onFocus={e => e.target.style.borderColor = '#d4821a'}
                    onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                </FormField>

                <FormField label="Password" htmlFor="reg-password">
                  <div className="relative">
                    <input id="reg-password" type={showPassword ? 'text' : 'password'}
                      placeholder="Min. 8 characters" value={password}
                      onChange={e => setPassword(e.target.value)} autoComplete="new-password"
                      className="w-full text-sm px-4 py-3 pr-11 rounded-xl border outline-none transition-all"
                      style={{ borderColor: '#e2e8f0', color: '#0f1923' }}
                      onFocus={e => e.target.style.borderColor = '#d4821a'}
                      onBlur={e => e.target.style.borderColor = '#e2e8f0'} />
                    <button type="button" onClick={() => setShowPassword(!showPassword)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 p-1" style={{ color: '#94a3b8' }}>
                      <EyeIcon show={showPassword} />
                    </button>
                  </div>
                  {/* Password strength bar */}
                  {password.length > 0 && (
                    <div className="mt-2">
                      <div className="flex gap-1 mb-1">
                        {[0, 1, 2, 3].map(i => (
                          <div key={i} className="flex-1 h-1 rounded-full transition-all"
                            style={{ background: i < passwordStrength.score ? passwordStrength.color : '#e2e8f0' }} />
                        ))}
                      </div>
                      <p className="text-xs" style={{ color: passwordStrength.color }}>{passwordStrength.label}</p>
                    </div>
                  )}
                </FormField>

                <FormField label="Confirm Password" htmlFor="confirm-password">
                  <div className="relative">
                    <input id="confirm-password" type={showConfirm ? 'text' : 'password'}
                      placeholder="Repeat your password" value={confirmPassword}
                      onChange={e => setConfirmPassword(e.target.value)} autoComplete="new-password"
                      className="w-full text-sm px-4 py-3 pr-11 rounded-xl border outline-none transition-all"
                      style={{
                        borderColor: confirmPassword && confirmPassword !== password ? '#ef4444' : '#e2e8f0',
                        color: '#0f1923'
                      }}
                      onFocus={e => e.target.style.borderColor = '#d4821a'}
                      onBlur={e => e.target.style.borderColor = confirmPassword && confirmPassword !== password ? '#ef4444' : '#e2e8f0'} />
                    <button type="button" onClick={() => setShowConfirm(!showConfirm)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 p-1" style={{ color: '#94a3b8' }}>
                      <EyeIcon show={showConfirm} />
                    </button>
                  </div>
                  {confirmPassword && confirmPassword !== password && (
                    <p className="text-xs mt-1" style={{ color: '#ef4444' }}>Passwords don't match</p>
                  )}
                  {confirmPassword && confirmPassword === password && (
                    <p className="text-xs mt-1" style={{ color: '#16a34a' }}>✓ Passwords match</p>
                  )}
                </FormField>

                <button type="submit"
                  className="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90 active:scale-95 mt-2"
                  style={{ background: 'linear-gradient(135deg, #d4821a, #e0972e)', boxShadow: '0 4px 14px rgba(212,130,26,0.3)' }}>
                  Continue →
                </button>
              </form>

              <p className="text-sm text-center mt-6" style={{ color: '#6b7c93' }}>
                Already have an account?{' '}
                <button onClick={onGoLogin} className="font-semibold hover:opacity-70 transition-colors" style={{ color: '#d4821a' }}>
                  Sign in
                </button>
              </p>
            </>
          )}

          {/* ── STEP 2 ── */}
          {step === 2 && (
            <>
              <div className="mb-6">
                <button onClick={() => setStep(1)}
                  className="flex items-center gap-1.5 text-sm font-medium mb-4 transition-colors hover:opacity-70"
                  style={{ color: '#6b7c93' }}>
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                  </svg>
                  Back
                </button>
                <h2 className="text-3xl font-bold mb-1" style={{ color: '#0d2137', fontFamily: "'Fraunces', serif" }}>
                  Almost there
                </h2>
                <p className="text-sm" style={{ color: '#6b7c93' }}>
                  Help us show you the right jobs from the start.
                </p>
              </div>

              {error && <ErrorBanner message={error} />}

              <form onSubmit={handleStep2} className="space-y-5">
                {/* Area */}
                <div>
                  <label className="block text-xs font-semibold mb-1.5" style={{ color: '#0d2137' }}>
                    Where in the GTA are you looking? <span style={{ color: '#94a3b8' }}>(optional)</span>
                  </label>
                  <div className="flex flex-wrap gap-2">
                    {AREAS.map(a => (
                      <button key={a} type="button" onClick={() => setArea(area === a ? '' : a)}
                        className="text-xs px-3 py-1.5 rounded-full border font-medium transition-all"
                        style={{
                          background: area === a ? '#0d2137' : '#fff',
                          color: area === a ? '#fff' : '#6b7c93',
                          borderColor: area === a ? '#0d2137' : '#e2e8f0',
                        }}>
                        {a}
                      </button>
                    ))}
                  </div>
                </div>

                {/* Job type */}
                <div>
                  <label className="block text-xs font-semibold mb-1.5" style={{ color: '#0d2137' }}>
                    What type of work are you looking for? <span style={{ color: '#94a3b8' }}>(optional)</span>
                  </label>
                  <div className="flex flex-wrap gap-2">
                    {['Full-time', 'Part-time', 'Contract', 'Any'].map(t => (
                      <button key={t} type="button" onClick={() => setJobType(jobType === t ? '' : t)}
                        className="text-xs px-3 py-1.5 rounded-full border font-medium transition-all"
                        style={{
                          background: jobType === t ? '#0d2137' : '#fff',
                          color: jobType === t ? '#fff' : '#6b7c93',
                          borderColor: jobType === t ? '#0d2137' : '#e2e8f0',
                        }}>
                        {t}
                      </button>
                    ))}
                  </div>
                </div>

                {/* Resume upload */}
                <div>
                  <label className="block text-xs font-semibold mb-1.5" style={{ color: '#0d2137' }}>
                    Upload your resume <span style={{ color: '#94a3b8' }}>(optional — you can do this later)</span>
                  </label>
                  <label className="flex flex-col items-center justify-center gap-2 p-5 rounded-xl border-2 border-dashed cursor-pointer transition-all hover:border-orange-300 hover:bg-orange-50"
                    style={{ borderColor: resumeFile ? '#d4821a' : '#e2e8f0', background: resumeFile ? '#fff5eb' : '#fafbfc' }}>
                    <input type="file" accept=".pdf,.doc,.docx" className="hidden"
                      onChange={e => setResumeFile(e.target.files?.[0] ?? null)} />
                    {resumeFile ? (
                      <>
                        <svg className="w-6 h-6" style={{ color: '#d4821a' }} fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                          <path strokeLinecap="round" strokeLinejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span className="text-xs font-semibold" style={{ color: '#d4821a' }}>{resumeFile.name}</span>
                        <span className="text-xs" style={{ color: '#6b7c93' }}>Click to replace</span>
                      </>
                    ) : (
                      <>
                        <span className="text-2xl">📎</span>
                        <span className="text-xs font-medium" style={{ color: '#6b7c93' }}>
                          Drop your resume or <span style={{ color: '#d4821a' }}>browse</span>
                        </span>
                        <span className="text-xs" style={{ color: '#94a3b8' }}>PDF, DOC, DOCX — up to 5MB</span>
                      </>
                    )}
                  </label>
                </div>

                {/* Terms */}
                <label className="flex items-start gap-3 cursor-pointer">
                  <div onClick={() => setAgreedToTerms(!agreedToTerms)}
                    className="w-4 h-4 rounded border-2 flex items-center justify-center flex-shrink-0 mt-0.5 transition-all"
                    style={{ borderColor: agreedToTerms ? '#d4821a' : '#cbd5e1', background: agreedToTerms ? '#d4821a' : '#fff' }}>
                    {agreedToTerms && (
                      <svg className="w-2.5 h-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={3}>
                        <path strokeLinecap="round" strokeLinejoin="round" d="M5 13l4 4L19 7" />
                      </svg>
                    )}
                  </div>
                  <span className="text-xs leading-relaxed" style={{ color: '#6b7c93' }}>
                    I agree to the{' '}
                    <a href="#" className="font-semibold underline" style={{ color: '#0d2137' }}>Terms of Service</a> and{' '}
                    <a href="#" className="font-semibold underline" style={{ color: '#0d2137' }}>Privacy Policy</a>.
                    I may receive job alert emails (unsubscribe anytime).
                  </span>
                </label>

                <button type="submit" disabled={loading}
                  className="w-full py-3 rounded-xl font-bold text-sm text-white transition-all hover:opacity-90 active:scale-95 disabled:opacity-60"
                  style={{ background: 'linear-gradient(135deg, #d4821a, #e0972e)', boxShadow: '0 4px 14px rgba(212,130,26,0.3)' }}>
                  {loading
                    ? <span className="flex items-center justify-center gap-2"><Spinner size="sm" color="white" /> Creating account…</span>
                    : 'Create My Account 🎉'}
                </button>
              </form>
            </>
          )}

          <p className="text-xs text-center mt-6" style={{ color: '#94a3b8' }}>
            Protected by 256-bit encryption · We never sell your data
          </p>
        </div>
      </div>
    </div>
  )
}

/* ── Helpers ── */

function FormField({ label, htmlFor, children }: {
  label: string; htmlFor: string; children: React.ReactNode
}) {
  return (
    <div>
      <label htmlFor={htmlFor} className="block text-xs font-semibold mb-1.5" style={{ color: '#0d2137' }}>{label}</label>
      {children}
    </div>
  )
}

function ErrorBanner({ message }: { message: string }) {
  return (
    <div className="flex items-center gap-2 px-3 py-2.5 rounded-lg mb-4 text-sm"
      style={{ background: '#fef2f2', border: '1px solid #fecaca', color: '#dc2626' }}>
      <svg className="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
        <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      {message}
    </div>
  )
}

function Spinner({ size = 'md', color = 'amber' }: { size?: 'sm' | 'md'; color?: 'amber' | 'white' }) {
  const sz = size === 'sm' ? 'w-4 h-4' : 'w-5 h-5'
  const col = color === 'white' ? 'border-white border-t-transparent' : 'border-amber-500 border-t-transparent'
  return <div className={`${sz} rounded-full border-2 ${col} animate-spin`} />
}

function EyeIcon({ show }: { show: boolean }) {
  return show
    ? <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
        <path strokeLinecap="round" strokeLinejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21" />
      </svg>
    : <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
        <path strokeLinecap="round" strokeLinejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path strokeLinecap="round" strokeLinejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
}

function getPasswordStrength(password: string): { score: number; label: string; color: string } {
  let score = 0
  if (password.length >= 8) score++
  if (/[A-Z]/.test(password)) score++
  if (/[0-9]/.test(password)) score++
  if (/[^A-Za-z0-9]/.test(password)) score++

  if (score <= 1) return { score: 1, label: 'Weak', color: '#ef4444' }
  if (score === 2) return { score: 2, label: 'Fair', color: '#f59e0b' }
  if (score === 3) return { score: 3, label: 'Good', color: '#3b82f6' }
  return { score: 4, label: 'Strong', color: '#16a34a' }
}
