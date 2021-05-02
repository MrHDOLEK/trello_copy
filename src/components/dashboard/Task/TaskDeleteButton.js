import React from "react";
import { useDispatch } from "react-redux";
import { deleteTask } from "../../../actions/tasks";

export const TaskDeleteButton = ({ task, onClickDelete }) => {
  const dispatch = useDispatch();

  const handleDeleteAction = async () => {
    onClickDelete();
    await dispatch(deleteTask(task));
  };

  return (
    <button
      onClick={handleDeleteAction}
      className="bg-red-700 rounded py-1 px-3"
    >
      DEL
    </button>
  );
};

export default TaskDeleteButton;
