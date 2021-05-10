import React, { Fragment, useState } from "react";

import { Link, Redirect, useHistory } from "react-router-dom";

import InputField from "../common/InputField";
import Button from "../common/Button";
import Checkbox from "../common/Checkbox";

import { useDispatch, useSelector } from "react-redux";
import { registerUser } from "../../actions/auth";

const Register = () => {
  const [state, setState] = useState({});
  const dispatch = useDispatch();
  const history = useHistory();
  const isAuthenticated = useSelector(
    (state) => state.authReducer.isAuthenticated
  );
  const [checked, setChecked] = useState(false);

  const onChange = (event) => {
    setState((prevState) => ({
      ...prevState,
      [event.target.name]: event.target.value,
    }));
  };

  const acceptTerms = (checked) => {
    setState((prevState) => ({
      ...prevState,
      regulation_accepted: checked,
    }));
  };

  const onSubmit = (event) => {
    event.preventDefault();
    console.log(state);
    checked && dispatch(registerUser(state)) && history.push("/login");
  };

  return (
    <Fragment>
      {isAuthenticated && <Redirect to="/" />}

      <h1 className="text-gray-200 text-center text-4xl mb-5">Register</h1>
      <form onSubmit={onSubmit}>
        <InputField
          label="Name"
          type="name"
          name="name"
          id="name"
          onChange={onChange}
          variant="variantOne"
        />
        <InputField
          label="Addres email"
          type="email"
          name="email"
          id="email"
          onChange={onChange}
          variant="variantOne"
        />
        <InputField
          label="Password"
          type="password"
          onChange={onChange}
          name="password"
          id="password"
          variant="variantOne"
        />
        <InputField
          label="Confirm password"
          type="password"
          onChange={onChange}
          name="password_confirmation"
          id="password_confirmation"
          variant="variantOne"
        />
        <Checkbox
          labelText="I have read and accept the terms and conditions."
          checked={checked}
          onChange={() => {
            setChecked(!checked);
            acceptTerms(!checked);
          }}
        />
        <Button
          text="Register"
          type="submit"
          variant="variantOne"
          width="full"
          disabled={!checked}
        />
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
