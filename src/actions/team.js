import axios from "axios";
import { notifySuccess } from "../functions/notify";
import tokenConfig from "../functions/token";
import { FETCH_ALL_TEAMS, FETCH_SINGLE_TEAM_BOARD } from "./types";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const createTeam = (state) => (dispatch, getState) => {
  console.log(state);
  axios
    .post(`${addressAPI}/api/v1/manage/teams`, state, tokenConfig(getState))
    .then((response) => notifySuccess(response.data))
    .catch((err) => console.log(err));
};

export const getTeams = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/manage/teams`, tokenConfig(getState))
    .then((response) => console.log(response))
    .catch((err) => console.log(err));
};

export const getUserTeams = () => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/manage/teams/all`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: FETCH_ALL_TEAMS, payload: response.data })
    )
    .catch((err) => console.log(err.message));
};

export const getTeamsTables = (id) => (dispatch, getState) => {
  axios
    .get(
      `${addressAPI}/api/v1/manage/teams/table?id=${id}`,
      tokenConfig(getState)
    )
    .then((response) => {
      dispatch({ type: FETCH_SINGLE_TEAM_BOARD, payload: response.data });
      console.log(response.data);
    })
    .catch((err) => console.log(err.message));
};
