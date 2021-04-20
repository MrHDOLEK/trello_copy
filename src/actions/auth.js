import axios from "axios";
import {
  AVATAR_LOADED,
  LOGIN_FAILED,
  LOGIN_SUCCESS,
  LOGOUT_SUCCESS,
  USER_LOADED,
} from "./types";
import { tokenConfig } from "../functions/token";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const registerUser = (state) => (dispatch) => {
  axios
    .post(`${addressAPI}/api/v1/auth/signup`, state)
    .then((response) => {
      console.log(response.data.message);
    })
    .catch((err) => console.log(err));
};

export const logoutUser = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/auth/logout`, tokenConfig(getState))
    .then(() => dispatch({ type: LOGOUT_SUCCESS }))
    .catch((err) => console.log(err));
};

export const loginUser = (state) => (dispatch) => {
  axios
    .post(`${addressAPI}/api/v1/auth/login`, state)
    .then((response) => {
      dispatch({ type: LOGIN_SUCCESS, payload: response.data });
    })
    .catch((err) => dispatch({ type: LOGIN_FAILED, payload: err.message }));
};

export const getUser = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/auth/user`, tokenConfig(getState))
    .then((response) => dispatch({ type: USER_LOADED, payload: response.data }))
    .catch((err) => console.log(err));
};

export const getAvatar = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/user/avatar`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: AVATAR_LOADED, payload: response.data })
    )
    .catch((err) => console.log(err));
};
