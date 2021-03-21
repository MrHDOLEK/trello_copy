import React, { useEffect } from "react";

import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";

import PrivateRoute from "./common/PrivateRoute";
import AuthenticationPage from "./authentication/AuthenticationPage";
import Board from "./board/Board";

import { getUser } from "../actions/auth";

// import { getCookie } from "../functions/cookies";

function App() {
  const dispatch = useDispatch();
  const token = useSelector((state) => state.authReducer.token);

  useEffect(() => {
    dispatch(getUser());
  });

  return (
    <Router>
      <Switch>
        <Route exact path="/register">
          <AuthenticationPage option={"register"} />
        </Route>
        <Route exact path="/login">
          <AuthenticationPage option={"login"} />
        </Route>
        <PrivateRoute component={Board} path="/" exact />
      </Switch>
    </Router>
  );
}

export default App;
