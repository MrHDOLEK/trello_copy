import React from "react";
import InputField from "../common/InputField";
import Button from "../common/Button";

export const CreateNewBoard = () => {
  return (
    <div className="bg-gray-700 border border-gray-700 rounded shadow-inner">
      <div className="h-36 border-2 border-red-500">image</div>
      <div className="text-center text-gray-200">
        <h1 className="my-2 text-xl font-bold">Organize everything</h1>
        <p className="p-1">
          Put eveything in one place and go faster with your first Trello Copy
          board!
        </p>
        <form className="p-2">
          <InputField
            placeholder="What are you working for?"
            type="text"
            variant="variantTwo"
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
