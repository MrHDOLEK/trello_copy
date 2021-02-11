import React, { useState } from "react";
import { Grid, Typography } from "@material-ui/core";
import Logo from "../Logo/Logo";
import UnderButtonRedirection from "./UnderButtonRedirection/UnderButtonRedirection";
import "./AuthenticationPage.scss";

const passwordMatches = (passwordOne, passwordTwo) => {
  return passwordOne === passwordTwo && passwordOne.length > 0;
};

const passwordPattern = (password) => {
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  return passwordRegex.test(password);
};

const AuthenticationPage = ({ children, authType }) => {
  const [state, setState] = useState({
    email: "",
    password: "",
    password2: "",
  });

  const handleChange = (e) => {
    setState((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (authType === "register") {
      passwordPattern(state.password) &&
        passwordMatches(state.password, state.password2) &&
        console.log("CORRECT");
    }
    console.log(state);
  };

  return (
    <Grid
      container
      direction="column"
      justify="flex-start"
      alignContent="center"
      className="register-page"
    >
      <Logo />
      <Typography variant="h3" align="center">
        {authType}
      </Typography>
      <form data-testid="form" className="_form" onSubmit={handleSubmit}>
        {children &&
          React.cloneElement(children, { handleChange: handleChange })}
        <UnderButtonRedirection authType={authType} />
      </form>
    </Grid>
  );
};

export default AuthenticationPage;
