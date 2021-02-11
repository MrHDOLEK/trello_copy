import React, { Fragment } from "react";
import "./App.scss";
import AuthenticationPage from "../Authentication/AuthenticationPage";
import Register from "../Authentication/Register/Register";
import Login from "../Authentication/Login/Login";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";

function App() {
  return (
    <Fragment>
      <Router>
        <Switch>
          <Route exact path="/register">
            <AuthenticationPage children={<Register />} authType="register" />
          </Route>
          <Route exact path="/login">
            <AuthenticationPage children={<Login />} authType="login" />
          </Route>
        </Switch>
      </Router>
    </Fragment>
  );
}

export default App;
