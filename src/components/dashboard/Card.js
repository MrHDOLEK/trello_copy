import React from "react";
import { Task } from "./Task/Task";

export const Card = ({ card }) => {
  return (
    <div className="bg-gray-200 rounded mb-2 p-2 w-full h-full sm:w-80 sm:mx-2 flex-2">
      <h2 className="text-xl">{card.card_name}</h2>
      {card.task.map((task) => (
        <Task key={task.id} task={task} card={card} />
      ))}
    </div>
  );
};

export default Card;
