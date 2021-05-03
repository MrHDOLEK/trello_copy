import React, { Fragment, useState } from "react";
import Icon from "../common/Icon";
import { ModalWrapper } from "./Task/Modal";
import { useDispatch } from "react-redux";
import InputField from "../common/InputField";
import Button from "../common/Button";
import { addCard } from "../../actions/boards";

export const CreateCard = ({ selectedBoard }) => {
  const dispatch = useDispatch();
  const [isOpen, setOpen] = useState(false);
  const [name, setName] = useState("");

  const openModal = () => {
    setOpen(true);
  };

  const closeModal = () => {
    setOpen(false);
  };

  const handleClick = () => {
    dispatch(addCard(name, selectedBoard));
    setOpen(false);
  };

  const onChange = (event) => {
    setName(event.target.value);
  };
  return (
    <Fragment>
      <button className="focus:outline-none" onClick={openModal}>
        <Icon
          icon="add"
          width="24"
          heigth="24"
          viewBox="0 0 24 24"
          iconClassName="text-green-500 hover:text-green-600"
        />
      </button>
      <ModalWrapper isOpen={isOpen} onRequestClose={closeModal}>
        <h3 className="text-2xl">Add new card</h3>
        <InputField variant="variantTwo" value={name} onChange={onChange} />
        <Button
          text="ADD"
          variant="variantOne"
          width="full"
          onClick={handleClick}
        />
      </ModalWrapper>
    </Fragment>
  );
};

export default CreateCard;
