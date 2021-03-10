import { LOGIN_SUCCESS, LOGIN_FAILED } from "../actions/types";
import { setCookie, deleteCookie } from "../functions/cookies";

const initialState = {
  isLoading: false,
  isAuthenticated: false,
  user: null,
  token: null,
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case LOGIN_SUCCESS:
      setCookie(
        "token",
        action.payload.access_token,
        action.payload.expires_at
      );
      return {
        ...state,
        ...action.payload,
        isLoading: false,
        isAuthenticated: true,
      };
    case LOGIN_FAILED:
      deleteCookie("token");
      return {
        ...state,
        isLoading: false,
        isAuthenticated: false,
        token: false,
        user: null,
      };
    default:
      return state;
  }
}
