import React from "react";
import { useSelector } from "react-redux";
import { Link } from "react-router-dom";
import GuestMenu from "./GuestMenu";
import UserMenu from "./UserMenu";

function Header() {
  const isAuthenticated = useSelector(
    (state) => state.authReducer.isAuthenticated
  );

  return (
    <header className="bg-green-500 flex justify-between items-center p-1 fixed w-full">
      <div className="group cursor-pointer">
        <Link
          to="/"
          className="text-white text-xl font-bold group-hover:text-gray-200"
        >
          Trello Copy
        </Link>
      </div>
      {isAuthenticated ? <UserMenu /> : <GuestMenu />}
    </header>
  );
}

export default Header;
