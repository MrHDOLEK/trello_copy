import React from "react";

import { useDispatch, useSelector } from "react-redux";
import { logoutUser } from "../../actions/auth";

function Board() {
  const user = useSelector((state) => state.authReducer.user);
  const dispatch = useDispatch();

  return (
    <div>
      {JSON.stringify(user)}
      <button onClick={() => dispatch(logoutUser())}>LOGOUT</button>
    </div>
  );
}

export default Board;
