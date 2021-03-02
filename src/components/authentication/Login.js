import React, { Fragment, useState } from "react";

import { Link } from "react-router-dom";

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
    <Fragment>
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
      <small className="text-gray-400 mt-3 text-sm">
        You don't have an account?{" "}
        <Link to="/register" className="hover:text-green-500">
          Sign up!
        </Link>
      </small>
    </Fragment>
  );
};

export default Login;
