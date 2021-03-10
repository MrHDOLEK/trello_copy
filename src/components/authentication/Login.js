import React, { Fragment, useState } from "react";

import { Link, Redirect } from "react-router-dom";

import InputField from "../common/InputField";
import AuthButton from "../common/AuthButton";

import { useDispatch, useSelector } from "react-redux";
import { loginUser } from "../../actions/auth";

const Login = () => {
  const [state, setState] = useState({ remember_me: 1 });
  const dispatch = useDispatch();
  const isAuthenticated = useSelector(
    (state) => state.authReducer.isAuthenticated
  );

  const onChange = (event) => {
    setState((prevState) => ({
      ...prevState,
      [event.target.name]: event.target.value,
    }));
  };

  const onSubmit = async (event) => {
    event.preventDefault();
    dispatch(loginUser(state));
  };

  return (
    <Fragment>
      {isAuthenticated && <Redirect to="/test" />}

      <h1 className="text-gray-200 text-center text-4xl mb-5">Login</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="Email"
          type="email"
          name="email"
          id="email"
          onChange={onChange}
        />
        <InputField
          label="Password"
          type="password"
          name="password"
          id="password"
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
