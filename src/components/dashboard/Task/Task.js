import React, { Fragment, useState } from "react";

import { Description } from "./Description";
import { TaskTitle } from "./TaskTitle";
import { TaskTimer } from "./TaskTimer";
import { ModalWrapper } from "./Modal";
import { TaskDeleteButton } from "./TaskDeleteButton";

export const Task = ({ task, card }) => {
  const [modalIsOpen, setIsOpen] = useState(false);
  const [title, setTitle] = useState(task.task_name);
  console.log(task);

  const openModal = () => {
    setIsOpen(true);
  };

  const closeModal = () => {
    setIsOpen(false);
  };

  const onTitleChange = (event) => {
    setTitle(event.target.value);
  };

  return (
    <Fragment>
      <div
        onClick={openModal}
        className="shadow bg-gray-50 hover:bg-gray-100 cursor-pointer border border-gray-300 rounded p-1 flex justify-between"
      >
        <span>{title}</span>
      </div>
      <ModalWrapper isOpen={modalIsOpen} onRequestClose={closeModal}>
        <TaskTitle
          title={title}
          task={task}
          cardName={card.card_name}
          onChange={onTitleChange}
        />
        <Description data={task} card={card} />
        <TaskTimer />
        <button
          onClick={closeModal}
          className="absolute right-3 top-3 hover:bg-gray-200 w-10 h-10 p-1 rounded-full outline-none hover:outline-none focus:outline-none"
        >
          X
        </button>
        <TaskDeleteButton task={task} />
      </ModalWrapper>
    </Fragment>
  );
};

export default Task;
