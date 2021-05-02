import React, { Fragment, useState } from "react";

import { Description } from "./Description";
import { TaskTitle } from "./TaskTitle";
import { TaskTimer } from "./TaskTimer";
import { ModalWrapper } from "./Modal";
import { TaskDeleteButton } from "./TaskDeleteButton";
import Icon from "../../common/Icon";

export const Task = ({ task, card }) => {
  const [modalIsOpen, setIsOpen] = useState(false);
  const [title, setTitle] = useState(task.task_name);
  const [isDeleted, setDeleted] = useState(false);

  const openModal = () => {
    setIsOpen(true);
  };

  const closeModal = () => {
    setIsOpen(false);
  };

  const onTitleChange = (event) => {
    setTitle(event.target.value);
  };

  const onClickDelete = () => {
    closeModal();
    setDeleted(true);
  };

  if (isDeleted) {
    return (
      <Fragment>
        <div className="shadow bg-gray-400 cursor-not-allowed border border-gray-400 rounded p-1 flex justify-between">
          <span>{title}</span>
        </div>
      </Fragment>
    );
  }

  return (
    <Fragment>
      <div
        onClick={openModal}
        className="shadow bg-gray-50 hover:bg-gray-100 cursor-pointer border border-gray-300 rounded p-1 flex justify-between mb-1"
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
        <button onClick={closeModal} className="group absolute right-6 top-6">
          <Icon
            icon="x"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            iconClassName="group-hover:text-green-500"
          />
        </button>
        <TaskDeleteButton task={task} onClickDelete={onClickDelete} />
      </ModalWrapper>
    </Fragment>
  );
};

export default Task;
