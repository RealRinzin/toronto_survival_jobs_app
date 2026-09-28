import Link from "next/link";
import React from "react";
import PageWrapper from "./PageWrapper";
import MobileMenu from "./MobileMenu";

export default function Navigation() {
  return (
    <header className="flex  sticky justify-between items-center max-w-7xl mx-auto w-full p-2 sm:px-4 lg:px-2">
      <Link href="/" className="font-medium">
        TorontSurvivalJobs
        <span className="text-yellow-600 font-extrabold text-3xl">.</span>ca
      </Link>
      <MobileMenu/>
      <nav className="md:flex hidden gap-3 ">
        <ul className="flex gap-4 text-gray-500 text-xs font-bold">
          <li className="hover:bg-gray-50  rounded-md p-2 cursor-pointer">
            <Link href="/"> Browse Jobs </Link>
          </li>
          <li className="hover:bg-gray-50  rounded-md p-2 cursor-pointer">
            <Link href="/"> Companies </Link>
          </li>
          <li className="hover:bg-gray-50  rounded-md p-2 cursor-pointer">
            <Link href="/"> Categories </Link>
          </li>
        </ul>
      </nav>
      <ul className="md:flex hidden">
        <li className="border border-gray-100 bg-amber-500 rounded-xl px-3 py-2 text-xs font-bold ">
        <Link href="/"> Sign In </Link>

        </li>
      </ul>
    </header>
  );
}
