/* eslint-disable import/no-anonymous-default-export */
import {
  PRIVATE_BOARDS_FETCHED,
  PRIVATE_BOARDS_FETCHING,
  PRIVATE_BOARDS_ERROR,
  SINGLE_PRIVATE_FETCHING,
  SINGLE_PRIVATE_FETCHED,
  SINGLE_PRIVATE_ERROR,
} from "../actions/types";

const initialState = {
  isLoading: false,
  isFetched: false,
  privateTables: null,

  singleBoardLoading: false,
  singleBoardFetched: false,
  selectedBoard: null,
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

    case SINGLE_PRIVATE_FETCHING:
      return {
        ...state,
        singleBoardLoading: true,
        singleBoardFetched: false,
      };

    case SINGLE_PRIVATE_FETCHED:
      return {
        ...state,
        singleBoardFetched: true,
        singleBoardLoading: false,
        selectedBoard: action.payload,
      };

    case SINGLE_PRIVATE_ERROR:
      return {
        ...state,
        singleBoardLoading: false,
        singleBoardFetched: false,
        selectedBoard: null,
      };

    default:
      return state;
  }
}
