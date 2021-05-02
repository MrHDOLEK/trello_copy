import axios from "axios";
import { notifySuccess } from "../functions/notify";
import tokenConfig from "../functions/token";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const createTeam = (state) => (dispatch, getState) => {
  console.log(state);
  axios
    .post(`${addressAPI}/api/v1/manage/teams`, state, tokenConfig(getState))
    .then((response) => notifySuccess(response.data))
    .catch((err) => console.log(err));
};

export const getTeam = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/manage/teams`, tokenConfig(getState))
    .then((response) => console.log(response))
    .catch((err) => console.log(err));
};
