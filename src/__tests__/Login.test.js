import React from "react";
import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";

import AuthenticationPage from "../components/authentication/AuthenticationPage";
import store from "../store";
import { Provider } from "react-redux";
import { BrowserRouter as Router } from "react-router-dom";

describe("<Login> tests", () => {
  beforeEach(() => {
    render(
      <Provider store={store}>
        <Router>
          <AuthenticationPage option="login" />
        </Router>
      </Provider>
    );
  });

  test("contain 'Login' title", () => {
    expect(screen.getByText(/login/i)).toBeInTheDocument();
  });

  test("contain email input field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("name", "email");
  });

  test("contain password input field", () => {
    expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
  });

  test("contain button", () => {
    expect(screen.getByRole("button")).toBeInTheDocument();
  });

  test("contain small text", () => {
    expect(screen.getByText(/you don't have an account/i)).toBeInTheDocument();
    expect(screen.getByRole("link")).toBeInTheDocument();
    expect(screen.getByRole("link")).toHaveTextContent(/sign up!/i);
  });
});
