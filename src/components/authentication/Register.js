import React, { Fragment, useState } from "react";

import { Link, useHistory } from "react-router-dom";

import InputField from "../common/InputField";
import AuthButton from "../common/AuthButton";

import { useDispatch } from "react-redux";
import { loginUser } from "../../actions/auth";

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
    console.log(state);
    history.push("/test");
  };

  return (
    <Fragment>
      <h1 className="text-gray-200 text-center text-4xl mb-5">Register</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="Adres email"
          type="email"
          name="Email"
          id="Email"
          onChange={onChange}
        />
        <InputField
          label="First name"
          type="text"
          onChange={onChange}
          name="FirstName"
          id="FirstName"
        />
        <InputField
          label="Last name"
          type="text"
          onChange={onChange}
          name="LastName"
          id="LastName"
        />
        <InputField
          label="Password"
          type="password"
          onChange={onChange}
          name="Password"
          id="Password"
        />
        <InputField
          label="Confirm password"
          type="password"
          onChange={onChange}
          name="ConfirmPassword"
          id="ConfirmPassoword"
        />
        <AuthButton text="Register" />
      </form>
      <small className="text-gray-400 mt-3 text-sm">
        You already have an account?{" "}
        <Link to="/login" className="hover:text-green-500">
          Sign in!
        </Link>
      </small>
      <button
        className="bg-yellow-600 w-full hover:bg-yellow-700"
        onClick={() => dispatch(loginUser())}
      >
        Test redux
      </button>
    </Fragment>
  );
};

export default Register;
