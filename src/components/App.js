import React from "react";

import {
  BrowserRouter as Router,
  // Redirect,
  Route,
  Switch,
} from "react-router-dom";

import PrivateRoute from "./common/PrivateRoute";
import AuthenticationPage from "./authentication/AuthenticationPage";
import Test from "./layout/Test";

// import { getCookie } from "../functions/cookies";

function App() {
  return (
    <Router>
      <Switch>
        {/* {getCookie("token") && <Redirect to="/test" />} */}
        <Route exact path="/register">
          <AuthenticationPage option={"register"} />
        </Route>
        <Route exact path="/login">
          <AuthenticationPage option={"login"} />
        </Route>
        <PrivateRoute component={Test} path="/test" exact />
      </Switch>
    </Router>
  );
}

export default App;
