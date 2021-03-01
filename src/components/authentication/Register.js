import React, { useState } from "react";

import InputField from "../common/InputField";
import AuthButton from "../common/AuthButton";

import { connect } from "react-redux";
import { getAuth } from "../../actions/auth";

const Register = ({ getAuth }) => {
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
      <h1 className="text-gray-200 text-center text-4xl mb-5">Register</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="test_serwisu"
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
        <button
          className="bg-yellow-600 w-full hover:bg-yellow-700"
          onClick={() => getAuth()}
        >
          Test redux
        </button>
      </form>
    </div>
  );
};

const mapStateToProps = (state) => ({
  auth: state.authReducer.auth,
});

export default connect(mapStateToProps, { getAuth })(Register);
