import React, { useState } from "react";

import InputField from "../common/InputField";
import AuthButton from "../common/AuthButton";

const Login = () => {
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
    <div>
      <h1 className="text-gray-200 text-center text-4xl mb-5">Login</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="Email"
          type="email"
          name="Email"
          id="Email"
          onChange={onChange}
        />
        <InputField
          label="Password"
          type="password"
          name="Password"
          id="Passoword"
          onChange={onChange}
        />
        <AuthButton text="Login" />
      </form>
    </div>
  );
};

export default Login;
