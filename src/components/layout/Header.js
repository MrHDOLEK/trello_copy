import React from "react";

function Header() {
  return (
    <header className="bg-green-500 flex justify-between items-center p-1">
      <nav>
        <ul className="flex">
          <li className="w-7 h-7 rounded bg-green-300 hover:bg-green-400 cursor-pointer flex justify-center items-center">
            {/* <i class="fi-rr-apps"></i> */}
          </li>
        </ul>
      </nav>
      <div className="group cursor-pointer">
        <span className="text-white text-xl font-bold group-hover:text-gray-200">
          Trello Copy
        </span>
      </div>
      <nav>
        <ul className="flex">
          <li className="w-7 h-7 rounded bg-green-300 hover:bg-green-400 cursor-pointer flex justify-center items-center"></li>
        </ul>
      </nav>
    </header>
  );
}

export default Header;
