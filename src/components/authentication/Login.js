import React from "react";

import InputField from "../common/InputField";

const Login = ({ onChange }) => {
  return (
    <div>
      <h1 className="text-gray-200 text-center text-4xl mb-5">Login</h1>
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
      <button className="bg-green-500 hover:bg-green-600 w-full rounded p-2 mt-3">
        Login
      </button>
    </div>
  );
};

export default Login;
