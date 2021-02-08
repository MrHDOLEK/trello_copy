import React from "react";

const InputGroup = ({ name, type, label }) => {
  return (
    <div className="flex flex-col mb-2 group">
      <label htmlFor={name} className="mb-1">
        {label}
      </label>
      <input
        type={type}
        id={name}
        name={name}
        className="border border-transparent bg-transparent focus:outline-none"
      />
      <div className="w-full h-0.5 bg-white group-hover:bg-lime-500"></div>
    </div>
  );
};

export default InputGroup;
