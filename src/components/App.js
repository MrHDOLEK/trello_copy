import React from "react";

import { Provider } from "react-redux";
import store from "../store";

import AuthenticationPage from "./authentication/AuthenticationPage";

function App() {
  return (
    <Provider store={store}>
      <div>
        <AuthenticationPage option={"register"} />
      </div>
    </Provider>
  );
}

export default App;
