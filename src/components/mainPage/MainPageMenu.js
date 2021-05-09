import React from "react";
import { Link, useRouteMatch } from "react-router-dom";

const MainPageMenu = () => {
  const { path } = useRouteMatch();
  const classes =
    "hover:bg-gray-700 focus:bg-gray-700 rounded p-1 text-gray-200";
  return (
    <nav className="md:w-1/4 p-0 m-0 sm:mr-1 mb-1 md:mb-0 border border-gray-700 rounded ">
      <ul>
        <li className={classes}>
          <Link className="block p-0.5" to={`${path}/boards_list`}>
            Boards list
          </Link>
        </li>
        {/* <li className={classes}>
          <Link className="block p-0.5" to={`${path}/teams_list`}>
            Teams list
          </Link>
        </li> */}
        <li className={classes}>
          <Link className="block p-0.5" to={`${path}/create_board`}>
            Create new board
          </Link>
        </li>
        <li className={classes}>
          <Link className="block p-0.5" to={`${path}/create_team`}>
            Create new team
          </Link>
        </li>
      </ul>
    </nav>
  );
};

export default MainPageMenu;
