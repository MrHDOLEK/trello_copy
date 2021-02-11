import React from "react";
import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom/extend-expect";
import Logo from "../components/Logo/Logo";

describe("<Logo /> component", () => {
  test("renders without crashing", () => {
    render(<Logo />);
  });

  test("renders 3 dots inside component", () => {
    render(<Logo />);
    expect(screen.getAllByTestId("dot")).toHaveLength(3);
  });
});
