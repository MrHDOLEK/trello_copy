import { USER_LOGIN_LOADING, USER_LOGIN_LOADED } from "../actions/types";

const initialState = {
  auth: {
    loading: false,
    isAuthenticated: false,
  },
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case USER_LOGIN_LOADING:
    case USER_LOGIN_LOADED:
      return {
        ...state,
        auth: {
          loading: action.payload.loading,
          isAuthenticated: action.payload.isAuthenticated,
        },
      };
    default:
      return state;
  }
}
