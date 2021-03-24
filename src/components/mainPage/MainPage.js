import Header from "../layout/Header";
import BoardsList from "./BoardsList";
import CreateNewBoard from "./CreateNewBoard";
import MainPageMenu from "./MainPageMenu";

import React, { Fragment } from "react";
import { Route, useRouteMatch } from "react-router-dom";

const MainPage = () => {
  const { url } = useRouteMatch();

  return (
    <Fragment>
      <Header />
      <div className="h-screen flex justify-center items-center">
        <div className="flex flex-col md:flex-row w-full md:w-10/12 max-w-2xl">
          <MainPageMenu />
          <div className="md:w-3/4">
            <Route path={`${url}/boards_list`} component={BoardsList} />
            <Route path={`${url}/create_board`} component={CreateNewBoard} />
          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default MainPage;
