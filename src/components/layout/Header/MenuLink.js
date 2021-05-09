import React from "react";
import { Link } from "react-router-dom";

const MenuLink = ({ link, className }) => {
  const { path, name } = link;
  return (
    <li className="m-0 p-0">
      <Link className={`block ${className}`} to={path}>
        {name}
      </Link>
    </li>
  );
};

export default MenuLink;
