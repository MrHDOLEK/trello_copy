import {
  LOGIN_SUCCESS,
  LOGIN_FAILED,
  LOGOUT_SUCCESS,
  USER_LOADED,
} from "../actions/types";
import { setCookie, deleteCookie, getCookie } from "../functions/cookies";

const initialState = {
  isLoading: false,
  isAuthenticated: false,
  user: null,
  token: getCookie("token"),
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case USER_LOADED:
      return {
        ...state,
        user: action.payload,
        isLoading: false,
        isAuthenticated: true,
      };
    case LOGIN_SUCCESS:
      setCookie(
        "token",
        action.payload.access_token,
        action.payload.expires_at
      );
      return {
        ...state,
        isLoading: false,
        isAuthenticated: true,
        token: action.payload.access_token,
      };
    case LOGIN_FAILED:
    case LOGOUT_SUCCESS:
      deleteCookie("token");
      return {
        ...state,
        isLoading: false,
        isAuthenticated: false,
        token: null,
        user: null,
      };
    default:
      return state;
  }
}
