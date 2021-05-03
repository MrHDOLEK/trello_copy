import React, { useState } from "react";
import { ModalWrapper } from "../../dashboard/Task/Modal";
import { useDispatch } from "react-redux";
import { addPackage } from "../../../actions/admin";

const NewPackage = () => {
  const dispatch = useDispatch();
  const [state, setState] = useState({});
  const [isOpen, setOpen] = useState(false);

  const closeModal = () => {
    setOpen(false);
  };

  const handleChange = (event) => {
    setState({ ...state, [event.target.name]: event.target.value });
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    dispatch(addPackage(state));
  };
  return (
    <div>
      <button
        className="bg-green-500 rounded py-1 px-3 w-full"
        onClick={() => setOpen(true)}
      >
        New package
      </button>
      <ModalWrapper isOpen={isOpen} onRequestClose={closeModal}>
        <h4 className="text-center text-lg mb-3">New package</h4>
        <form onSubmit={handleSubmit}>
          <Input
            label="Name"
            id="name"
            name="name"
            required
            onChange={handleChange}
          />
          <Input
            label="Price"
            id="price"
            name="price"
            required
            type="number"
            step="0.01"
            onChange={handleChange}
          />
          <Input
            label="Description"
            id="description"
            name="description"
            required
            onChange={handleChange}
          />
          <button className="w-full bg-green-500 rounded mt-3 py-1 px-3">
            ADD
          </button>
        </form>
      </ModalWrapper>
    </div>
  );
};

const Input = ({ id, name, value, onChange, label, ...props }) => (
  <div className="w-full">
    <label htmlFor={id} className="text-lg">
      {label}
    </label>
    <input
      type="text"
      id={id}
      value={value}
      name={name}
      onChange={onChange}
      {...props}
      className="w-full rounded focus:outline-none p-1"
    />
  </div>
);

export default NewPackage;
