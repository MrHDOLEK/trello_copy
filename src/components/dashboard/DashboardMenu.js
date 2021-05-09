import React, { useState } from "react";
import DashboardSettings from "./DashboardSettings";
import CreateCard from "./CreateCard";

export const DashboardMenu = ({ selectedBoard }) => {
  const [title, setTitle] = useState(selectedBoard.name);

  const onTitleChange = (event) => {
    setTitle(event.target.value);
  };

  return (
    <div className="flex pt-12 pb-4 px-2 justify-between items-center">
      <h1 className="text-gray-200 text-3xl text-center">{title}</h1>
      <div>
        <CreateCard selectedBoard={selectedBoard} />
        <DashboardSettings
          selectedBoard={selectedBoard}
          title={title}
          onTitleChange={onTitleChange}
        />
      </div>
    </div>
  );
};

export default DashboardMenu;
