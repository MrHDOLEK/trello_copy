import React from "react";

const InputField = (
  { label, type, name, id, value, onChange, placeholder, variant },
  props
) => {
  let classes;
  if (variant === "variantOne")
    classes =
      "bg-transparent border-b-2 focus:border-green-400 outline-none text-gray-200 mb-2 mx-1";
  if (variant === "variantTwo")
    classes =
      "bg-gray-100 border-2 focus:border-green-400 rounded text-gray-900 p-1";
  return (
    <div className="flex flex-col mt-2">
      {label && (
        <label htmlFor={id} className="text-xl text-gray-200 mx-1">
          {label}
        </label>
      )}
      <input
        className={classes}
        type={type}
        name={name}
        id={id}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
      />
    </div>
  );
};

export default InputField;
