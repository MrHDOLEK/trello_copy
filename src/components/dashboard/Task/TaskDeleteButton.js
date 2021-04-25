import React from "react";
import { useDispatch } from "react-redux";
import { deleteTask } from "../../../actions/tasks";

export const TaskDeleteButton = ({ task }) => {
  const dispatch = useDispatch();
  const onClickDelete = () => {
    dispatch(deleteTask(task));
  };

  return (
    <button onClick={onClickDelete} className="bg-red-700 rounded py-1 px-3">
      DEL
    </button>
  );
};

export default TaskDeleteButton;
