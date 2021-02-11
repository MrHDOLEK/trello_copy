import React from "react";
import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom/extend-expect";

import AuthenticationPage from "../components/Authentication/AuthenticationPage";
import Login from "../components/Authentication/Login/Login";
import Register from "../components/Authentication/Register/Register";
import { BrowserRouter as Router } from "react-router-dom";

describe("<Login /> component", () => {
  test("render <Logo /> in component", () => {
    render(<AuthenticationPage></AuthenticationPage>);
    expect(screen.getByTestId("logo")).toBeInTheDocument();
  });

  test("render login form", () => {
    render(
      <Router>
        <AuthenticationPage children={<Login />} authType="login" />
      </Router>
    );
    expect(screen.getByText("login")).toBeInTheDocument();
  });

  test("render reggister form", () => {
    render(
      <Router>
        <AuthenticationPage children={<Register />} authType="register" />
      </Router>
    );
    expect(screen.getByText("register")).toBeInTheDocument();
  });
});
