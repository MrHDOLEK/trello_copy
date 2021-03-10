import { LOGIN_SUCCESS, LOGIN_FAILED } from "../actions/types";

const initialState = {
  auth: {
    isLoading: false,
    isAuthenticated: false,
  },
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case LOGIN_SUCCESS:
      return {};
    case LOGIN_FAILED:
      return {};
    default:
      return state;
  }
}
