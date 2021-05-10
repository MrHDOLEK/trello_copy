import {
  DELETE_PACKAGE,
  FETCH_ALL_PACKAGE,
  FETCH_ALL_USERS,
  LOGOUT_SUCCESS,
  FETCH_ALL_BOARDS,
} from "../actions/types";

/* eslint-disable import/no-anonymous-default-export */
const initialState = {
  users: [],
  packages: [],
  boards: [],
};

export default function (state = initialState, action) {
  switch (action.type) {
    case FETCH_ALL_USERS:
      return {
        ...state,
        users: action.payload,
      };

    case FETCH_ALL_PACKAGE:
      return { ...state, packages: action.payload };

    case FETCH_ALL_BOARDS:
      return {
        ...state,
        boards: action.payload,
      };

    case DELETE_PACKAGE:
      return {
        ...state,
        packages: state.packages.filter(
          (singlePackage) => singlePackage.id !== action.payload
        ),
      };

    case LOGOUT_SUCCESS:
      return {
        users: [],
        packages: [],
      };

    default:
      return state;
  }
}
