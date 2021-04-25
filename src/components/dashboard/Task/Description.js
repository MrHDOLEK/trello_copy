import React, { useState, useRef, useEffect } from "react";
import { useDispatch } from "react-redux";
import { editTaskDescription } from "../../../actions/tasks";

export const Description = ({ data }) => {
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

export default Description;
