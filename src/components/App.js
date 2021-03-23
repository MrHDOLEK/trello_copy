import React, { useEffect } from "react";

import {
  BrowserRouter as Router,
  Redirect,
  Route,
  Switch,
} from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";

import PrivateRoute from "./common/PrivateRoute";
import AuthenticationPage from "./authentication/AuthenticationPage";
import MainPage from "./mainPage/MainPage";

import { getUser } from "../actions/auth";

// import { getCookie } from "../functions/cookies";

function App() {
  const dispatch = useDispatch();
  const token = useSelector((state) => state.authReducer.token);

  useEffect(() => {
    dispatch(getUser());
  });

  return (
    <div className="bg-gray-800 min-h-screen h-full text">
      <Router>
        <Switch>
          <Route exact path="/register">
            <AuthenticationPage option={"register"} />
          </Route>
          <Route exact path="/login">
            <AuthenticationPage option={"login"} />
          </Route>
          <PrivateRoute component={MainPage} exact path="/s" />
          <Route path="/main">
            <MainPage />
          </Route>
          <Redirect from="/" to="/main" />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
