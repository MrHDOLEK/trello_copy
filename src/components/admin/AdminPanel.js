import React, { useState } from "react";
import Dropdown from "react-dropdown";
import "react-dropdown/style.css";
import ArticlesList from "./Articles/ArticlesList";
import BoardsList from "./Boards/BoardsList";
import PacketsList from "./Packets/PacketsList";
import UsersList from "./Users/UsersList";

const options = ["Users", "Packages", "Articles", "Boards"];

const AdminPanel = () => {
  const [selected, setSelected] = useState(options[0]);

  const onChange = (event) => {
    setSelected(event.value);
  };

  return (
    <div className="pt-10 px-2 min-h-screen">
      <h2 className="text-center text-gray-200 text-2xl my-2">Admin panel</h2>
      <Dropdown
        options={options}
        value={selected}
        onChange={onChange}
        className="mb-2"
      />

      {selected === "Users" && <UsersList />}
      {selected === "Packages" && <PacketsList />}
      {selected === "Articles" && <ArticlesList />}
      {selected === "Boards" && <BoardsList />}

      <div></div>
    </div>
  );
};

export default AdminPanel;
