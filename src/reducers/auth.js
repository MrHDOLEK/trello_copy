import { LOGIN_SUCCESS, LOGIN_FAILED } from "../actions/types";

const initialState = {
  isLoading: false,
  isAuthenticated: false,
  user: null,
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case LOGIN_SUCCESS:
      return {
        ...state,
        isLoading: false,
        isAuthenticated: true,
        user: action.payload,
      };
    case LOGIN_FAILED:
      return {};
    default:
      return state;
  }
}
