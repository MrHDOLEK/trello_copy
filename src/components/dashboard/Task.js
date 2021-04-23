import React, { Fragment, useState, useRef, useEffect } from "react";
import { useDispatch } from "react-redux";
import Modal from "react-modal";
import { editTaskDescription } from "../../actions/tasks";

const customStyles = {
  overlay: {
    position: "fixed",
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: "rgba(0, 0, 0, 0.5)",
  },
  content: {
    position: "absolute",
    top: "80px",
    left: "100px",
    right: "100px",
    bottom: "80px",
    border: "1px solid #ccc",
    background: "#E5E7EB",
    overflow: "auto",
    WebkitOverflowScrolling: "touch",
    borderRadius: "4px",
    outline: "none",
    padding: "1.5rem",
  },
};

export const Task = ({ data, card }) => {
  const [modalIsOpen, setIsOpen] = useState(false);

  const openModal = () => {
    setIsOpen(true);
  };

  const closeModal = () => {
    setIsOpen(false);
  };

  return (
    <Fragment>
      <div
        onClick={openModal}
        className="shadow bg-gray-50 hover:bg-gray-100 cursor-pointer border border-gray-300 rounded p-1"
      >
        {data.task_name}
      </div>
      <Modal
        isOpen={modalIsOpen}
        onRequestClose={closeModal}
        contentLabel="Example Modal"
        style={customStyles}
      >
        <TaskTitle data={data} card={card} />
        <Description data={data} card={card} />
        <div className="mb-5">Active timer div</div>
        <button
          onClick={closeModal}
          className="absolute right-3 top-3 hover:bg-gray-200 w-10 h-10 p-1 rounded-full outline-none hover:outline-none focus:outline-none"
        >
          X
        </button>
      </Modal>
    </Fragment>
  );
};

const TaskTitle = ({ data, card }) => {
  return (
    <div className="mb-5">
      <h2 className="text-xl font-bold">{data.task_name}</h2>
      <small className="text-gray-600">in card '{card.card_name}'</small>
    </div>
  );
};

const Description = ({ data }) => {
  const [inEditMode, setEditMode] = useState(false);
  const [state, setState] = useState(data.task_content);
  const textareaRef = useRef(null);
  const dispatch = useDispatch();

  const startEditMode = () => {
    setEditMode(true);
  };

  const endAndSaveEditMode = () => {
    dispatch(editTaskDescription(state, data));
    setEditMode(false);
  };

  const onChange = (event) => {
    setState(event.target.value);
  };

  useEffect(() => {
    textareaRef.current && textareaRef.current.focus();
  });

  if (!inEditMode) {
    return (
      <div className="mb-5">
        <h2 className="inline-block mr-5 mb-2">Description</h2>
        <button
          onClick={startEditMode}
          className="inline-block bg-gray-100 hover:bg-gray-200 px-3 py-0.5 rounded hover:outline-none focus:outline-none"
        >
          Edit
        </button>
        <p>{state}</p>
      </div>
    );
  } else {
    return (
      <div className="mb-5">
        <h2 className="mr-5 mb-2">Description</h2>
        <textarea
          ref={textareaRef}
          value={state}
          onChange={onChange}
          // onBlur={() => setTimeout(() => setEditMode(false), 100)}
          className="block bg-white resize-none rounded w-full h-24 p-2 mb-1 focus:outline-none focus:ring-2 focus:ring-green-500"
        />
        <button
          onClick={endAndSaveEditMode}
          className="bg-green-500 hover:bg-green-600 px-3 py-0.5 rounded hover:outline-none focus:outline-none w-auto"
        >
          Save
        </button>
      </div>
    );
  }
};

export default Task;
