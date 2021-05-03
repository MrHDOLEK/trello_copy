/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getTeamsTables, getUserTeams } from "../../actions/team";

const TeamsList = () => {
  const dispatch = useDispatch();
  const teams = useSelector((state) => state.boardsReducer.teams);

  useEffect(() => {
    dispatch(getUserTeams());
  }, []);

  console.log(teams);
  return (
    <div className="border border-gray-700 rounded-md p-1">
      <h2 className="text-center text-xl text-gray-200">Teams</h2>
      <ul>
        {teams.map((team) => (
          <Team team={team} />
        ))}
      </ul>
    </div>
  );
};

const Team = ({ team }) => {
  console.log(team);
  const dispatch = useDispatch();
  const onClick = () => {
    dispatch(getTeamsTables(team.id));
  };

  return (
    <li className="bg-green-500 inline-block py-1 px-3 rounded mr-2">
      <button onClick={onClick}>{team.name}</button>
    </li>
  );
};

export default TeamsList;
