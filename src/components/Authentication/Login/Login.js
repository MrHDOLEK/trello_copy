import React, { Fragment } from "react";
import { InputAdornment, TextField, Button } from "@material-ui/core";
import { Email, Lock } from "@material-ui/icons";

const Login = ({ handleChange }) => {
  return (
    <Fragment>
      <TextField
        id="login-email"
        label="Email"
        type="text"
        name="email"
        onChange={handleChange}
        InputProps={{
          startAdornment: (
            <InputAdornment>
              <Email />
            </InputAdornment>
          ),
        }}
      />
      <TextField
        id="login-password"
        label="Password"
        type="password"
        name="password"
        onChange={handleChange}
        InputProps={{
          startAdornment: (
            <InputAdornment>
              <Lock />
            </InputAdornment>
          ),
        }}
      />
      <Button variant="contained" type="submit">
        Sign in
      </Button>
    </Fragment>
  );
};

export default Login;
