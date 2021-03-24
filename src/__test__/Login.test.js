import React from "react";
import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom";

import Login from "../components/authentication/Login";
import store from "../store";
import { Provider } from "react-redux";
import { BrowserRouter as Router } from "react-router-dom";

describe("<Login> tests", () => {
  beforeEach(() =>
    render(
      <Provider store={store}>
        <Router>
          <Login option="login" />
        </Router>
      </Provider>
    )
  );

  test("contain 'Login' title", () => {
    expect(screen.getByText(/login/i)).toBeInTheDocument();
  });

  test("contain email input field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("name", "email");
  });

  test("contain password input field", () => {
    expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
  });
});
