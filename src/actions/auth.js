import axios from "axios";
import { LOGIN_FAILED, LOGIN_SUCCESS, LOGOUT_SUCCESS } from "./types";

export const registerUser = (state) => (dispatch) => {
  axios
    .post("http://95.111.242.110:8180/api/auth/signup", state)
    .then((res) => {
      console.log(res.data.message);
    })
    .catch((err) => console.log(err));
};

export const logoutUser = () => (dispatch) => {
  axios
    .post("http://95.111.242.110:8180/api/auth/logout")
    .then(() => dispatch({ type: LOGOUT_SUCCESS }))
    .catch((err) => console.log(err));
};

export const loginUser = (state) => (dispatch) => {
  axios
    .post("http://95.111.242.110:8180/api/auth/login", state)
    .then((res) => {
      dispatch({ type: LOGIN_SUCCESS, payload: res.data });
      console.log(res.data);
    })
    .catch((err) => dispatch({ type: LOGIN_FAILED, payload: err.message }));
};
