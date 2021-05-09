import { combineReducers } from "redux";
import auth from "./auth";
import boards from "./boards";
import singleBoard from "./singleBoard";
import admin from "./admin";

export default combineReducers({
  authReducer: auth,
  boardsReducer: boards,
  singleBoardReducer: singleBoard,
  adminReducer: admin,
});
