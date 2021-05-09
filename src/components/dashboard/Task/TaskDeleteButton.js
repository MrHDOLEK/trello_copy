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
    <div className="flex justify-end">
      <button
        onClick={handleDeleteAction}
        className="bg-red-600 text-gray-200 rounded py-1 px-3"
      >
        DELETE TASK
      </button>
    </div>
  );
};

export default TaskDeleteButton;
