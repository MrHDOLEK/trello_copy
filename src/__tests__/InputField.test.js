import React from "react";
import { render, screen } from "@testing-library/react";
import userEvent from "@testing-library/user-event";
import "@testing-library/jest-dom";

import InputField from "../components/common/InputField";

describe("<InputField /> component", () => {
  beforeEach(() => {
    const testObject = {};

    const onChange = (event) => {
      testObject[event.target.name] = event.target.value;
    };

    render(
      <InputField
        label="test"
        type="text"
        name="test"
        id="test"
        placeholder="test"
        variant="variantOne"
        onChange={onChange}
      />
    );
  });

  test("render component", () => {
    expect(screen.getByRole("textbox")).toBeInTheDocument();
  });

  test("containt 'type' field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("type", "text");
  });

  test("containt 'name' field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("name", "test");
  });

  test("containt 'id' field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("id", "test");
  });

  test("containt 'placeholder' field", () => {
    expect(screen.getByRole("textbox")).toHaveAttribute("placeholder", "test");
  });

  test("containt 'label' field, and label", () => {
    expect(screen.getByLabelText("test")).toBeInTheDocument();
  });

  test("typic function working", () => {
    userEvent.type(screen.getByRole("textbox"), "test");
    expect(screen.getByRole("textbox")).toHaveValue("test");
  });
});
