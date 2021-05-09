import React, { useState, useRef, useEffect } from "react";
import { useDispatch } from "react-redux";
import { editTaskTitle } from "../../../actions/tasks";

export const TaskTitle = ({ title, task, cardName, onChange }) => {
  const [inEditMode, setEditMode] = useState(false);
  const dispatch = useDispatch();
  const inputRef = useRef(null);

  useEffect(() => {
    inputRef.current && inputRef.current.focus();
  });

  const endAndSaveEditMode = () => {
    dispatch(editTaskTitle(title, task));
    setEditMode(false);
  };

  if (!inEditMode) {
    return (
      <div className="mb-5">
        <h2 onClick={() => setEditMode(true)} className="text-xl font-bold">
          {title}
        </h2>
        <small className="text-gray-600">in card '{cardName}'</small>
      </div>
    );
  } else {
    return (
      <div className="mb-5">
        <input
          className="text-xl font-bold p-0.5 block rounded focus:outline-none"
          ref={inputRef}
          value={title}
          onChange={onChange}
          onBlur={() => endAndSaveEditMode()}
          onKeyDown={(event) => event.key === "Enter" && endAndSaveEditMode()}
        />
        <small className="text-gray-600">in card '{cardName}'</small>
      </div>
    );
  }
};

export default TaskTitle;
