import axios from "axios";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";
import { TASK_DELETE } from "./types";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const editTaskDescription = (state, task) => (dispatch, getState) => {
  const { id, task_name } = task;
  const updatedTask = {
    task_name,
    task_content: state,
  };

  axios
    .put(
      `${addressAPI}/api/v1/manage/tasks?id=${id}`,
      updatedTask,
      tokenConfig(getState)
    )
    .then((response) => notifySuccess(response.data))
    .catch((err) => notifyError(err.message));
};

export const editTaskTitle = (state, task) => (dispatch, getState) => {
  const { id, task_content } = task;
  const updatedTask = {
    task_name: state,
    task_content,
  };

  axios
    .put(
      `${addressAPI}/api/v1/manage/tasks?id=${id}`,
      updatedTask,
      tokenConfig(getState)
    )
    .then((response) => notifySuccess(response.data))
    .catch((err) => notifyError(err.message));
};

export const deleteTask = (task) => (dispatch, getState) => {
  const { id } = task;

  axios
    .delete(`${addressAPI}/api/v1/manage/tasks?id=${id}`, tokenConfig(getState))
    .then((response) => {
      notifySuccess(response.message);
      dispatch({ type: TASK_DELETE, payload: id });
    })
    .catch((err) => notifyError(err.message));
};
