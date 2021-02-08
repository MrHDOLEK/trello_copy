import React, { Fragment } from "react";
import InputGroup from "../../Common/InputGroup";

const Register = () => {
  return (
    <Fragment>
      <h3 className="text-center">Register</h3>
      <form className="flex flex-col mx-1">
        <InputGroup name="username" type="text" label="Username" />
        <InputGroup name="email" type="email" label="Email" />
        <InputGroup name="firstName" type="text" label="First Name" />
        <InputGroup name="lastName" type="text" label="Last Name" />
        <InputGroup name="password" type="password" label="Password" />
        <InputGroup
          name="confirmPassword"
          type="password"
          label="Confirm Password"
        />
        <button className="bg-lime-500 w-36 mx-auto rounded-md py-2">
          Sign up
        </button>
      </form>
    </Fragment>
  );
};

export default Register;
