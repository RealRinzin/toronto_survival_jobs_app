"use client";

import Link from "next/link";
import { useState } from "react";

export const navLinks = [
  { href: "/jobs", label: "Browse Jobs" },
  { href: "/", label: "Companies" },
  { href: "/", label: "Categories" },
];

export default function MobileMenu() {
  const [open, setOpen] = useState(false);

  return (
    <nav className="md:hidden">
      <button
        type="button"
        onClick={() => setOpen((o) => !o)}
        aria-expanded={open}
        aria-controls="mobile-menu"
        aria-label={open ? "Close menu" : "Open menu"}
        className="rounded-md p-2 hover:bg-gray-50"
      >
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round">
          {open ? (
            <path d="M6 6l12 12M18 6L6 18" />
          ) : (
            <path d="M4 6h16M4 12h16M4 18h16" />
          )}
        </svg>
      </button>

      {open && (
        <ul
          id="mobile-menu"
          className="absolute left-0 right-0 top-full flex flex-col border-b bg-white p-2 text-sm font-bold text-gray-600 shadow-md z-10"
        >
          {navLinks.map((link) => (
            <li key={link.label}>
              <Link
                href={link.href}
                onClick={() => setOpen(false)}
                className="block rounded-md p-3 hover:bg-gray-50"
              >
                {link.label}
              </Link>
            </li>
          ))}
          <li className="p-2">
            <Link
              href="/"
              onClick={() => setOpen(false)}
              className="block rounded-xl bg-amber-500 px-3 py-2 text-center"
            >
              Sign In
            </Link>
          </li>
        </ul>
      )}
    </nav>
  );
}