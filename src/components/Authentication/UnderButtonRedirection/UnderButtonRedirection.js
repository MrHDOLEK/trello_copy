import { Typography } from "@material-ui/core";
import React, { Fragment } from "react";
import { Link } from "react-router-dom";
import "./UnderButtonRedirection.scss";

const UnderButtonRedirection = ({ authType }) => {
  console.log(authType);
  const login = () => {
    return (
      <Fragment>
        You dont have an account yet? <Link to="/register">Sign up!</Link>
      </Fragment>
    );
  };

  const register = () => {
    return (
      <Fragment>
        Do you already have an account? <Link to="/login">Sign in!</Link>
      </Fragment>
    );
  };

  return (
    <Typography variant="body2" align="center">
      {authType === "login" && login()}
      {authType === "register" && register()}
    </Typography>
  );
};

export default UnderButtonRedirection;
