import React from "react";
import { Task } from "./Task";

export const Card = ({ data }) => {
  console.log(data);
  return (
    <div className="bg-gray-200 rounded mb-2 p-2 w-full sm:w-80 sm:mx-2 inline-block">
      <h2 className="text-xl">{data.card_name}</h2>
      {data.task.map((task) => (
        <Task key={task.id} data={task} card={data} />
      ))}
    </div>
  );
};

export default Card;
