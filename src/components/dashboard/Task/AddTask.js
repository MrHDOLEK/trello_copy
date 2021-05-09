import React, { useState } from "react";
import { useDispatch } from "react-redux";
import { addTask } from "../../../actions/tasks";

export const AddTask = ({ setEditMode, cardId }) => {
  const dispatch = useDispatch();
  const [taskName, setTaskName] = useState("");

  const onChange = (event) => {
    setTaskName(event.target.value);
  };

  const createTask = () => {
    if (taskName.length > 0) {
      setEditMode(false);
      dispatch(addTask(taskName, cardId));
    }
  };

  return (
    <div className="rounded my-1 flex">
      <input
        type="text"
        placeholder="Task name..."
        value={taskName}
        onChange={onChange}
        className="rounded-l w-max p-1 focus:outline-none focus:ring-1 focus:ring-green-500"
      />
      <button
        onClick={createTask}
        className="bg-green-500 p-1 rounded-r flex-grow focus:outline-none"
      >
        add
      </button>
    </div>
  );
};

export default AddTask;
