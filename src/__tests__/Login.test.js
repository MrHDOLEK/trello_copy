import React from "react";
import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom/extend-expect";

import Login from "../components/Authentication/Login/Login";

describe("<Login /> component", () => {
  beforeEach(() => {
    render(<Login></Login>);
  });

  test("renders email input field", () => {
    expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
  });

  test("renders password  input field", () => {
    expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
  });

  test("renders button in form", () => {
    expect(screen.getByRole("button")).toBeInTheDocument();
  });
});
