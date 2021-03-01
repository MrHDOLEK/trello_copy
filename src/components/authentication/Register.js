import React from "react";

import InputField from "../common/InputField";

const Register = ({ onChange }) => {
  return (
    <div>
      <h1 className="text-gray-200 text-center text-4xl mb-5">Register</h1>
      <InputField
        label="Email"
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
      <button className="bg-green-500 hover:bg-green-600 w-full rounded p-2 mt-3">
        Register
      </button>
    </div>
  );
};

export default Register;
