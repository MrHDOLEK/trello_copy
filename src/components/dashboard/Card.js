import React, { useState, useRef } from "react";
import { Task } from "./Task/Task";
import { AddTask } from "./Task/AddTask";
import Icon from "../common/Icon";
import { deleteCard, editCardTitle } from "../../actions/boards";
import { useDispatch } from "react-redux";

export const Card = ({ card }) => {
  const [editMode, setEditMode] = useState(false);
  const [cardName, setCardName] = useState(card.card_name);
  const [titleEditMode, setTitleEditMode] = useState(false);
  const inputRef = useRef(null);
  const dispatch = useDispatch();

  const startEditMode = () => {
    setEditMode(true);
  };

  const handleDelete = () => {
    dispatch(deleteCard(card));
  };

  const handleChange = (event) => {
    setCardName(event.target.value);
  };

  const endTitleChange = () => {
    dispatch(editCardTitle(cardName, card));
    setTitleEditMode(false);
  };

  return (
    <div className="bg-gray-200 rounded mb-2 p-2 w-full h-full sm:w-80 sm:mx-2 flex-2">
      <div className="flex justify-between px-1 mb-2">
        {titleEditMode ? (
          <input
            className="text-xl font-bold p-0.5 block rounded focus:outline-none"
            ref={inputRef}
            value={cardName}
            onChange={handleChange}
            onKeyDown={(event) => event.key === "Enter" && endTitleChange()}
          />
        ) : (
          <h2 className="text-xl" onClick={() => setTitleEditMode(true)}>
            {cardName}
          </h2>
        )}
        <button className="focus:outline-none" onClick={handleDelete}>
          <Icon
            icon="trash"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            iconClassName="text-gray-700 hover:text-red-500"
          />
        </button>
      </div>
      {card.task &&
        card.task.map((task) => <Task key={task.id} task={task} card={card} />)}
      {editMode && <AddTask setEditMode={setEditMode} cardId={card.id} />}
      <button
        onClick={startEditMode}
        className="hover:bg-green-500 rounded-full mt-2 w-6 h-6 focus:outline-none"
      >
        <Icon
          icon="add"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          iconClassName="text-gray-700"
        />
      </button>
    </div>
  );
};

export default Card;
