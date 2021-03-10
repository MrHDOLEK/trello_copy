import React, { Fragment, useState } from "react";

import { Link, useHistory } from "react-router-dom";

import InputField from "../common/InputField";
import AuthButton from "../common/AuthButton";

import { useDispatch } from "react-redux";
import { registerUser } from "../../actions/auth";

const Register = () => {
  const [state, setState] = useState({});
  const dispatch = useDispatch();
  const history = useHistory();

  const onChange = (event) => {
    setState((prevState) => ({
      ...prevState,
      [event.target.name]: event.target.value,
    }));
  };

  const onSubmit = (event) => {
    event.preventDefault();
    dispatch(registerUser(state));
    history.push("/test");
  };

  return (
    <Fragment>
      <h1 className="text-gray-200 text-center text-4xl mb-5">Register</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="Name"
          type="name"
          name="name"
          id="name"
          onChange={onChange}
        />
        <InputField
          label="Addres email"
          type="email"
          name="email"
          id="email"
          onChange={onChange}
        />
        <InputField
          label="Password"
          type="password"
          onChange={onChange}
          name="password"
          id="password"
        />
        <InputField
          label="Confirm password"
          type="password"
          onChange={onChange}
          name="password_confirmation"
          id="password_confirmation"
        />
        <AuthButton text="Register" />
      </form>
      <small className="text-gray-400 mt-3 text-sm">
        You already have an account?{" "}
        <Link to="/login" className="hover:text-green-500">
          Sign in!
        </Link>
      </small>
    </Fragment>
  );
};

export default Register;
