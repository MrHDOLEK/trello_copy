import axios from "axios";
import {
  LOGIN_FAILED,
  LOGIN_SUCCESS,
  LOGOUT_SUCCESS,
  USER_LOADED,
} from "./types";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const registerUser = (state) => (dispatch) => {
  axios
    .post(`${addressAPI}/api/v1/auth/signup`, state)
    .then((res) => {
      console.log(res.data.message);
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
    .then((res) => {
      dispatch({ type: LOGIN_SUCCESS, payload: res.data });
    })
    .catch((err) => dispatch({ type: LOGIN_FAILED, payload: err.message }));
};

export const getUser = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/auth/user`, tokenConfig(getState))
    .then((res) => dispatch({ type: USER_LOADED, payload: res.data }))
    .catch((err) => console.log(err));
};

export const tokenConfig = (getState) => {
  const token = getState().authReducer.token;
  const config = {
    headers: {},
  };

  if (token) {
    config.headers["Authorization"] = `Bearer ${token}`;
  }

  return config;
};
