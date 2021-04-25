/* eslint-disable import/no-anonymous-default-export */
import {
  PRIVATE_BOARDS_FETCHED,
  PRIVATE_BOARDS_FETCHING,
  PRIVATE_BOARDS_ERROR,
} from "../actions/types";

const initialState = {
  isLoading: false,
  isFetched: false,
  privateTables: null,
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
    default:
      return state;
  }
}
