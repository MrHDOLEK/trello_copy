import React, { useState } from "react";
import InputField from "../common/InputField";
import Button from "../common/Button";
import { useDispatch } from "react-redux";
import { useHistory } from "react-router-dom";

import { createBoard } from "../../actions/boards";

export const CreateNewBoard = () => {
  const [state, setState] = useState();
  const dispatch = useDispatch();
  const history = useHistory();

  const onChange = (event) => {
    setState({ [event.target.name]: event.target.value });
  };

  const onSubmit = async (event) => {
    event.preventDefault();
    await dispatch(createBoard(state));
    history.push("/main/boards_list");
  };

  return (
    <div className="border border-gray-700 rounded-md p-1">
      <div className="h-36 border-2 rounded border-gray-500 bg-gradient-to-r from-gray-600 to-gray-800"></div>
      <div className="text-center text-gray-200">
        <h1 className="my-2 text-xl font-bold">Organize everything</h1>
        <p className="p-1">
          Put eveything in one place and go faster with your first Trello Copy
          board!
        </p>
        <form className="p-2" onSubmit={onSubmit}>
          <InputField
            placeholder="What are you working for?"
            type="text"
            variant="variantTwo"
            name="name"
            onChange={onChange}
          />
          <Button
            text="Create board"
            type="submit"
            variant="variantOne"
            width="full"
            textColor="black"
          />
        </form>
      </div>
    </div>
  );
};

export default CreateNewBoard;
