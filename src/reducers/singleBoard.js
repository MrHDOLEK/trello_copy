/* eslint-disable import/no-anonymous-default-export */
import {
  SINGLE_PRIVATE_FETCHING,
  SINGLE_PRIVATE_FETCHED,
  SINGLE_PRIVATE_ERROR,
  TASK_ADDED,
  TASK_UPDATE,
  CARD_ADDED,
  CARD_DELETE,
} from "../actions/types";

const initialState = {
  singleBoardLoading: false,
  singleBoardFetched: false,
  selectedBoard: null,
};

export default function (state = initialState, action) {
  let findedCard;
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

    case TASK_ADDED:
      findedCard = state.selectedBoard.card.find(
        (card) => card.id === action.payload.card_id
      );
      findedCard.task.push(action.payload);

      return {
        ...state,
      };

    case TASK_UPDATE:
      findedCard = state.selectedBoard.card.find(
        (card) => card.id === action.payload.card_id
      );
      const task = findedCard.task.find(
        (task) => task.id === action.payload.task_id
      );
      task.task_content = action.payload.task_content;
      return { ...state };

    case CARD_ADDED:
      state.selectedBoard.card.push({ task: [], ...action.payload });
      return { ...state };

    case CARD_DELETE:
      state.selectedBoard.card.filter((card) => card.id !== action.payload);
      return {
        ...state,
        selectedBoard: {
          ...state.selectedBoard,
          card: state.selectedBoard.card.filter(
            (card) => card.id !== action.payload
          ),
        },
      };

    default:
      return state;
  }
}
