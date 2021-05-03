/* eslint-disable import/no-anonymous-default-export */
import {
  PRIVATE_BOARDS_FETCHED,
  PRIVATE_BOARDS_FETCHING,
  PRIVATE_BOARDS_ERROR,
  FETCH_ALL_TEAMS,
} from "../actions/types";

const initialState = {
  isLoading: false,
  isFetched: false,
  privateTables: null,
  teams: [],
};

export default function (state = initialState, action) {
  switch (action.type) {
    case PRIVATE_BOARDS_FETCHING:
      return {
        ...state,
        isLoading: true,
        isFetched: false,
      };
    case PRIVATE_BOARDS_FETCHED:
      return {
        ...state,
        isLoading: false,
        isFetched: true,
        privateTables: action.payload,
      };

    case PRIVATE_BOARDS_ERROR:
      return {
        ...state,
        isLoading: false,
        isFetched: false,
        privateTables: null,
      };

    case FETCH_ALL_TEAMS:
      return { ...state, teams: action.payload };

    default:
      return state;
  }
}
