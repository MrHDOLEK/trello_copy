import React, { Fragment } from "react";
import { InputAdornment, TextField, Button } from "@material-ui/core";
import { Email, Lock } from "@material-ui/icons";

const Register = ({ handleChange }) => {
  return (
    <Fragment>
      <TextField
        id="register-email"
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
        id="register-password"
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
      <TextField
        id="register-password2"
        label="Verify Password"
        type="password"
        name="password2"
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
        Sign up
      </Button>
    </Fragment>
  );
};

export default Register;
