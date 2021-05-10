import axios from "axios";
import {
  AVATAR_LOADED,
  LOGIN_FAILED,
  LOGIN_SUCCESS,
  LOGOUT_SUCCESS,
  USER_LOADED,
} from "./types";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const registerUser = (state) => (dispatch) => {
  axios
    .post(`${addressAPI}/api/v1/auth/signup`, state)
    .then((response) => {
      notifySuccess("Welcome new user! Please sign in yourself!");
    })
    .catch((err) => notifyError(err.message));
};

export const logoutUser = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/auth/logout`, tokenConfig(getState))
    .then(() => {
      dispatch({ type: LOGOUT_SUCCESS });
      notifySuccess("See you later!");
    })
    .catch((err) => notifyError(err.message));
};

export const loginUser = (state) => (dispatch) => {
  axios
    .post(`${addressAPI}/api/v1/auth/login`, state)
    .then((response) => {
      dispatch({ type: LOGIN_SUCCESS, payload: response.data });
      notifySuccess("You have been successfully logged in!");
      dispatch(getUser());
    })
    .catch((err) => {
      const { message, errors } = err.response.data;
      console.log(err.response.data);
      dispatch({ type: LOGIN_FAILED, payload: message });
      if (errors) {
        errors.email && notifyError(errors.email[0]);
        errors.password && notifyError(errors.password[0]);
      }
      notifyError(message);
    });
};

export const getUser = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/auth/user`, tokenConfig(getState))
    .then((response) => dispatch({ type: USER_LOADED, payload: response.data }))
    .catch((err) => notifyError(err.message));
};

export const getAvatar = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/user/avatar`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: AVATAR_LOADED, payload: response.data })
    )
    .catch((err) => notifyError(err.message));
};
