import Header from "../layout/Header";
import BoardsList from "./BoardsList";
import CreateNewBoard from "./CreateNewBoard";

import React, { Fragment } from "react";
import { Route, useRouteMatch } from "react-router-dom";

const MainPage = () => {
  const { url } = useRouteMatch();
  console.log(url);

  return (
    <Fragment>
      <Header />
      <div className="h-screen border-2 flex justify-center items-center">
        <Route path={`${url}/board_list`} component={BoardsList} />
        <Route path={`${url}/create_board`} component={CreateNewBoard} />
      </div>
    </Fragment>
  );
};

export default MainPage;
