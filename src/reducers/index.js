import { combineReducers } from "redux";
import auth from "./auth";
import boards from "./boards";

export default combineReducers({ authReducer: auth, boardsReducer: boards });
