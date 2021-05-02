import {
  PRIVATE_BOARDS_FETCHING,
  PRIVATE_BOARDS_FETCHED,
  PRIVATE_BOARDS_ERROR,
  SINGLE_PRIVATE_FETCHING,
  SINGLE_PRIVATE_FETCHED,
  SINGLE_PRIVATE_ERROR,
  CARD_ADDED,
  CARD_DELETE,
} from "./types";
import axios from "axios";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const createBoard = (state) => async (dispatch, getState) => {
  await axios
    .post(`${addressAPI}/api/v1/manage/tables`, state, tokenConfig(getState))
    .then((response) => notifySuccess(response.data))
    .catch((error) => notifyError(error.message));
};

export const getPrivateBoards = () => async (dispatch, getState) => {
  dispatch({ type: PRIVATE_BOARDS_FETCHING });
  await axios
    .get(`${addressAPI}/api/v1/manage/tables/private`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: PRIVATE_BOARDS_FETCHED, payload: response.data })
    )
    .catch((err) => {
      dispatch({ type: PRIVATE_BOARDS_ERROR });
      notifyError(err.message);
    });
};

export const getPrivateSingleBoard = (id) => async (dispatch, getState) => {
  dispatch({ type: SINGLE_PRIVATE_FETCHING });
  await axios
    .get(
      `${addressAPI}/api/v1/manage/tables/private/details?id=${id}`,
      tokenConfig(getState)
    )
    .then((response) =>
      dispatch({ type: SINGLE_PRIVATE_FETCHED, payload: response.data })
    )
    .catch((err) => {
      dispatch({ type: SINGLE_PRIVATE_ERROR });
      notifyError(err.message);
    });
};

export const deleteBoard = (id) => async (dispatch, getState) => {
  await axios
    .delete(
      `${addressAPI}/api/v1/manage/tables?id=${id}`,
      tokenConfig(getState)
    )
    .then((response) => {
      notifySuccess(response.data);
      console.log(response);
    })
    .then((err) => notifyError(err));
};

export const editBoardTitle = (state, board) => (dispatch, getState) => {
  const { id } = board;

  const updatedBoard = {
    name: state,
    is_visible: 1,
  };

  console.log(updatedBoard);

  axios
    .put(
      `${addressAPI}/api/v1/manage/tables?id=${id}`,
      updatedBoard,
      tokenConfig(getState)
    )
    .then((response) => notifySuccess(response.data))
    .catch((err) => notifyError(err.message));
};

export const addCard = (state, board) => (dispatch, getState) => {
  const { id } = board;
  const newCard = {
    card_name: state,
    card_content: "cardo",
  };
  axios
    .post(
      `${addressAPI}/api/v1/manage/cards?id=${id}`,
      newCard,
      tokenConfig(getState)
    )
    .then((response) => {
      notifySuccess(response.data.message);
      dispatch({ type: CARD_ADDED, payload: response.data.card });
    })
    .catch((err) => notifyError(err.message));
};

export const deleteCard = (card) => (dispatch, getState) => {
  const { id } = card;

  axios
    .delete(`${addressAPI}/api/v1/manage/cards?id=${id}`, tokenConfig(getState))
    .then((response) => {
      notifySuccess(response.data);
      dispatch({ type: CARD_DELETE, payload: id });
    })
    .catch((err) => notifyError(err.message));
};

export const editCardTitle = (state, card) => (dispatch, getState) => {
  const { id, card_content } = card;

  const updatedCard = {
    card_name: state,
    card_content,
  };

  axios
    .put(
      `${addressAPI}/api/v1/manage/cards?id=${id}`,
      updatedCard,
      tokenConfig(getState)
    )
    .then((response) => {
      notifySuccess(response.data);
    })
    .catch((err) => notifyError(err.message));
};
