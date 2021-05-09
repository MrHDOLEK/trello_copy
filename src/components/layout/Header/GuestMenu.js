import React, { Fragment, useState } from "react";
import MenuLink from "./MenuLink";
import { useMediaQuery } from "react-responsive";
import Icon from "../../common/Icon";

const redirects = [
  { path: "/register", name: "Sign Up" },
  { path: "/login", name: "Sign In" },
];

const MobileGuestMenu = () => {
  const [isOpen, setOpen] = useState(false);

  return (
    <Fragment>
      <button onClick={() => setOpen(!isOpen)} className="focus:outline-none">
        <Icon
          icon={isOpen ? "x" : "hamburger"}
          width="24"
          heigth="24"
          viewBox="0 0 24 24"
        />
      </button>
      <nav
        className={`flex-grow -left-full top-9 w-full transition-transform duration-500 ease-in-out absolute transform ${
          isOpen && "translate-x-full"
        }`}
      >
        <ul className="bg-green-300">
          {redirects.map((link) => (
            <MenuLink
              key={link.path}
              link={link}
              className="p-2 hover:bg-green-400 text-center"
            />
          ))}
        </ul>
      </nav>
    </Fragment>
  );
};

const DesktopGuestMenu = () => {
  return (
    <nav>
      <ul className="flex">
        {redirects.map((link) => (
          <MenuLink
            key={link.path}
            link={link}
            className="bg-green-200 hover:bg-green-300 rounded ml-2 py-0.5 px-2"
          />
        ))}
      </ul>
    </nav>
  );
};

const GuestMenu = () => {
  const isMobile = useMediaQuery({ query: `(max-width: 760px)` });

  return (
    <Fragment>{isMobile ? <MobileGuestMenu /> : <DesktopGuestMenu />}</Fragment>
  );
};

export default GuestMenu;
