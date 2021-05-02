import React, { useRef, useState, useEffect } from "react";
import { useDispatch } from "react-redux";
import { editBoardTitle } from "../../actions/boards";

export const DashboardTitle = ({ title, board, onChange }) => {
  const [inEditMode, setEditMode] = useState(false);
  const dispatch = useDispatch();
  const inputRef = useRef(null);

  useEffect(() => {
    inputRef.current && inputRef.current.focus();
  });

  const endAndSaveEditMode = () => {
    dispatch(editBoardTitle(title, board));
    setEditMode(false);
  };

  if (!inEditMode) {
    return (
      <div className="mb-5">
        <h2 onClick={() => setEditMode(true)} className="text-xl font-bold">
          {title}
        </h2>
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
      </div>
    );
  }
};

export default DashboardTitle;
