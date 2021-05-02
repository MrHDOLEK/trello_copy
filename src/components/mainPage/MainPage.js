import BoardsList from "./BoardsList";
import CreateNewBoard from "./CreateNewBoard";
import MainPageMenu from "./MainPageMenu";
import Teams from "./Teams";

import React, { Fragment } from "react";
import { Route, useRouteMatch } from "react-router-dom";

const MainPage = () => {
  const { url } = useRouteMatch();

  return (
    <Fragment>
      <div className="min-h-screen flex justify-center items-center">
        <div className="flex flex-col md:flex-row w-full md:w-10/12 p-1 overflow-hidden">
          <MainPageMenu />
          <div className="md:w-3/4">
            <Route path={`${url}/boards_list`} component={BoardsList} />
            <Route path={`${url}/create_board`} component={CreateNewBoard} />
            <Route path={`${url}/teams`} component={Teams} />
          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default MainPage;
