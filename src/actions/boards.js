import {
  PRIVATE_BOARDS_FETCHING,
  PRIVATE_BOARDS_FETCHED,
  PRIVATE_BOARDS_ERROR,
  SINGLE_PRIVATE_FETCHING,
  SINGLE_PRIVATE_FETCHED,
  SINGLE_PRIVATE_ERROR,
} from "./types";
import axios from "axios";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const createBoard = (state) => (dispatch, getState) => {
  axios
    .post(`${addressAPI}/api/v1/manage/tables`, state, tokenConfig(getState))
    .then((response) => notifySuccess(response.data))
    .catch((error) => notifyError(error.message));
};

export const getPrivateBoards = () => (dispatch, getState) => {
  dispatch({ type: PRIVATE_BOARDS_FETCHING });
  axios
    .get(`${addressAPI}/api/v1/manage/tables/private`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: PRIVATE_BOARDS_FETCHED, payload: response.data })
    )
    .catch((err) => {
      dispatch({ type: PRIVATE_BOARDS_ERROR });
      notifyError(err.message);
    });
};

export const getPrivateSingleBoard = (id) => (dispatch, getState) => {
  dispatch({ type: SINGLE_PRIVATE_FETCHING });
  axios
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
