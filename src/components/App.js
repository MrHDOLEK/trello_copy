import React, { useEffect } from "react";

import {
  BrowserRouter as Router,
  Redirect,
  Route,
  Switch,
} from "react-router-dom";
import { useDispatch } from "react-redux";

import PrivateRoute from "./common/PrivateRoute";
import AuthenticationPage from "./authentication/AuthenticationPage";
import MainPage from "./mainPage/MainPage";
import Header from "./layout/Header";

import { getUser } from "../actions/auth";
import { getCookie } from "../functions/cookies";
import Dashboard from "./dashboard/Dashboard";

import "react-loader-spinner/dist/loader/css/react-spinner-loader.css";

function App() {
  const dispatch = useDispatch();

  useEffect(() => {
    const token = getCookie("token");
    token && dispatch(getUser());
  });

  return (
    <div className="bg-gray-800 min-h-screen h-full text">
      <Header />
      <Router>
        <Switch>
          <Route exact path="/register">
            <AuthenticationPage option={"register"} />
          </Route>
          <Route exact path="/login">
            <AuthenticationPage option={"login"} />
          </Route>

          <PrivateRoute component={MainPage} path="/main" />
          <PrivateRoute component={Dashboard} path="/dashboard/:id" />
          <Redirect from="/" to="/main/boards_list" />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
