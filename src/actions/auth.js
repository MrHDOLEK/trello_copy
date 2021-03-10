import axios from "axios";
import { LOGIN_FAILED, LOGIN_SUCCESS } from "./types";

export const registerUser = (state) => (dispatch) => {
  const body = JSON.stringify(state);
  console.log(body);

  axios
    .post("http://95.111.242.110:8180/api/auth/signup", body)
    .then((res) => console.log(res))
    .catch((err) => console.log(err));
};

export const loginUser = (state) => (dispatch) => {
  const body = JSON.stringify(state);
  console.log(body);

  axios
    .post("http://95.111.242.110:8180/api/auth/login", body)
    .then((res) => dispatch({ type: LOGIN_SUCCESS, payload: res.data }))
    .catch((err) => dispatch({ type: LOGIN_FAILED, payload: err }));
};
