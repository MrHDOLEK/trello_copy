import React from "react";

import Register from "./Register";
import Login from "./Login";

const AuthenticationPage = ({ option }) => {
  return (
    <div className="flex flex-col justify-center items-center w-screen h-screen bg-gray-800">
      {option === "register" && <Register />}
      {option === "login" && <Login />}
    </div>
  );
};

export default AuthenticationPage;
