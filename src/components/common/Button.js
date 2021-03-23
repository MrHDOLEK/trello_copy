import React from "react";

const Button = ({ text, type, variant, width, textColor }) => {
  let classes;
  let buttonWidth;
  let textClasses;

  if (width === "full") buttonWidth = "w-full";
  if (width === "half") buttonWidth = "w-1/2";

  if (variant === "variantOne")
    classes =
      "bg-green-500 hover:bg-green-600 focus:bg-green-600 rounded p-2 mt-3";

  if (textColor === "black") textClasses = "text-gray-900";

  return (
    <button type={type} className={`${classes} ${buttonWidth} ${textClasses}`}>
      {text}
    </button>
  );
};

export default Button;
