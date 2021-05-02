import React from "react";
import { useDispatch } from "react-redux";

export const Team = ({ board }) => {
  const dispatch = useDispatch();
  console.log(board);

  const team = {
    team_name: "kys123",
    users_mail: ["mat@gmail.pl", "pat@gmail.pl", "test@test.pl"],
  };

  return <div>TEST</div>;
};

export default Team;
