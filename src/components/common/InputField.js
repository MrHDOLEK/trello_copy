import React from "react";

const InputField = ({ label, type, name, id, value, onChange }) => {
  return (
    <div className="flex flex-col p-2 mt-2">
      <label className="text-xl text-gray-200">{label}</label>
      <input
        className="bg-transparent border-b-2 focus:border-green-400 outline-none text-gray-200"
        type={type}
        name={name}
        id={id}
        value={value}
        onChange={onChange}
      />
    </div>
  );
};

export default InputField;
