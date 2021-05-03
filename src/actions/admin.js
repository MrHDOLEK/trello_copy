import axios from "axios";
import { notifyError, notifySuccess } from "../functions/notify";
import { tokenConfig } from "../functions/token";
import { FETCH_ALL_USERS, FETCH_ALL_PACKAGE, DELETE_PACKAGE } from "./types";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const getUser = (id) => (dispatch, getState) => {
  axios
    .get(`${addressAPI}/api/v1/admin/manage/user`, tokenConfig(getState))
    .then((response) =>
      dispatch({ type: FETCH_ALL_USERS, payload: response.data })
    )
    .catch((err) => console.log(err));
};

export const getUserDetails = (id) => (dispatch, getState) => {};

export const getPackage = (id) => (dispatch, getState) => {
  axios
    .get(
      `${addressAPI}/api/v1/admin/manage/portal/packet`,
      tokenConfig(getState)
    )
    .then((response) =>
      dispatch({ type: FETCH_ALL_PACKAGE, payload: response.data })
    )
    .catch((err) => notifyError(err.message));
};

export const addPackage = (state) => (dispatch, getState) => {
  const newPackage = {
    ...state,
    permission_id: 1,
  };

  console.log(newPackage);

  axios
    .post(
      `${addressAPI}/api/v1/admin/manage/portal/packet/create`,
      newPackage,
      tokenConfig(getState)
    )
    .then((response) => notifySuccess(response.data))
    .catch((err) => notifyError(err.message));
};

export const deletePackage = (id) => (dispatch, getState) => {
  axios
    .delete(
      `${addressAPI}/api/v1/admin/manage/portal/packet/delete`,
      { packet_id: id },
      tokenConfig(getState)
    )
    .then((response) => {
      notifySuccess(response.data);
      dispatch({ type: DELETE_PACKAGE, payload: id });
    })
    .catch((err) => notifyError(err.message));
};
