import React, { useState } from "react";

import Register from "./Register";
import Login from "./Login";

const AuthenticationPage = ({ option }) => {
  const [state, setState] = useState({});

  const onChange = (event) => {
    setState((prevState) => ({
      ...prevState,
      [event.target.name]: event.target.value,
    }));
  };

  const onSubmit = (event) => {
    event.preventDefault();
    console.log(state);
  };

  return (
    <div className="flex flex-col justify-center items-center w-screen h-screen bg-gray-800">
      <form onSubmit={onSubmit}>
        {option === "register" && <Register onChange={onChange} />}
        {option === "login" && <Login onChange={onChange} />}
      </form>
    </div>
  );
};

export default AuthenticationPage;
