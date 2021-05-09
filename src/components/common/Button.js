import React from "react";

const Button = ({
  text,
  type,
  variant,
  width,
  textColor,
  disabled,
  ...props
}) => {
  let classes;
  let buttonWidth;
  let textClasses;
  let disabledClasses;

  disabledClasses = "bg-gray-700 rounded p-2 mt-3 cursor-auto";

  if (width === "full") buttonWidth = "w-full";
  if (width === "half") buttonWidth = "w-1/2";

  if (variant === "variantOne")
    classes =
      "bg-green-500 hover:bg-green-600 focus:bg-green-600 rounded p-2 mt-3";

  if (textColor === "black") textClasses = "text-gray-900";

  return (
    <button
      type={type}
      className={
        disabled
          ? `${disabledClasses} ${buttonWidth}`
          : `${classes} ${buttonWidth} ${textClasses}`
      }
      disabled={disabled}
      {...props}
    >
      {text}
    </button>
  );
};

export default Button;
