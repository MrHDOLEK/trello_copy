import React from "react";

export const Task = ({ data }) => {
  return (
    <div className="shadow bg-gray-50 hover:bg-gray-100 cursor-pointer border border-gray-300 rounded p-1">
      {data.task_name}
    </div>
  );
};

export default Task;
