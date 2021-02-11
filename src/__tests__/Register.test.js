import React from "react";
import { fireEvent, render, screen } from "@testing-library/react";
import "@testing-library/jest-dom/extend-expect";

import Register from "../components/Authentication/Register/Register";

describe("<Register /> component", () => {
  describe("Basic renders", () => {
    beforeEach(() => {
      render(<Register></Register>);
    });

    test("renders email input field", () => {
      expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
    });

    test("renders password nad password2 input field", () => {
      expect(screen.getAllByLabelText(/password/i)).toHaveLength(2);
    });

    test("renders button in form", () => {
      expect(screen.getByRole("button")).toBeInTheDocument();
    });
  });

  test("Calls the handleChange callback handler", () => {
    const handleChange = jest.fn();
    render(<Register handleChange={handleChange} />);

    fireEvent.change(screen.getByLabelText(/email/i), {
      target: { value: "test@test.com" },
    });

    expect(handleChange).toHaveBeenCalledTimes(1);
  });
});
