import React, { Fragment, useState } from "react";
import Icon from "../common/Icon";
import DashboardTitle from "./DashboardTitle";
import { ModalWrapper } from "./Task/Modal";
import Team from "./Team";
import { deleteBoard } from "../../actions/boards";
import { useHistory } from "react-router-dom";
import { useDispatch } from "react-redux";

export const DashboardSettings = ({ selectedBoard, onTitleChange, title }) => {
  console.log(selectedBoard);
  const dispatch = useDispatch();
  const history = useHistory();
  const [isOpen, setOpen] = useState(false);

  const openModal = () => {
    setOpen(true);
  };

  const closeModal = () => {
    setOpen(false);
  };

  const handleDelete = async () => {
    await dispatch(deleteBoard(selectedBoard.id));
    history.push("/main/boards_list");
  };

  return (
    <Fragment>
      <button className="focus:outline-none mx-2" onClick={openModal}>
        <Icon
          icon="settings"
          width="24"
          heigth="24"
          viewBox="0 0 24 24"
          iconClassName="text-green-500 hover:text-green-600"
        />
      </button>
      <ModalWrapper isOpen={isOpen} onRequestClose={closeModal}>
        <button onClick={closeModal} className="group absolute right-6 top-6">
          <Icon
            icon="x"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            iconClassName="group-hover:text-green-500"
          />
        </button>
        <DashboardTitle
          title={title}
          board={selectedBoard}
          onChange={onTitleChange}
        />
        <Team board={selectedBoard} />
        <button className="bg-red-700 rounded py-1 px-3" onClick={handleDelete}>
          DELETE BOARD
        </button>
      </ModalWrapper>
    </Fragment>
  );
};

export default DashboardSettings;
