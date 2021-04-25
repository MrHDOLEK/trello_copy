/* eslint-disable import/no-anonymous-default-export */
import {
  SINGLE_PRIVATE_FETCHING,
  SINGLE_PRIVATE_FETCHED,
  SINGLE_PRIVATE_ERROR,
  TASK_DELETE,
} from "../actions/types";

const initialState = {
  singleBoardLoading: false,
  singleBoardFetched: false,
  selectedBoard: null,
};

export default function (state = initialState, action) {
  switch (action.type) {
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

    case TASK_DELETE:
      return {
        ...state,
      };

    default:
      return state;
  }
}
