/* eslint-disable react-hooks/exhaustive-deps */
import React from "react";
import { useDispatch, useSelector } from "react-redux";
import { useEffect } from "react/cjs/react.development";
import { getTeamsTables } from "../../actions/team";

export const Team = ({ board }) => {
  const dispatch = useDispatch();
  let team = useSelector((state) => state.boardsReducer.singleTeam);

  useEffect(() => {
    dispatch(getTeamsTables(board.team_id));
  }, []);

  console.log(team);
  console.log(board);

  // const isTeam = (
  //   <div className="mb-3">
  //     <div>
  //       <h3>
  //         #{team.id} - {team.name}
  //       </h3>
  //     </div>
  //     <h4>Members: {team.users}</h4>
  //     <input />
  //     <button className="bg-green-500 py-1 px-3 rounded">Change team</button>
  //   </div>
  // );

  return team ? <div>isTeam</div> : null;
};

export default Team;
