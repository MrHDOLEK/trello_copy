import React from "react";

const AuthButton = ({ text }) => {
  return (
    <button
      type="submit"
      className="bg-green-500 hover:bg-green-600 focus:bg-green-600 w-full rounded p-2 mt-3"
    >
      {text}
    </button>
  );
};

export default AuthButton;
