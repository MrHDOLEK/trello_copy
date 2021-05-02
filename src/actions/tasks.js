import axios from "axios";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";
import { TASK_ADDED, TASK_DELETE, TASK_UPDATE } from "./types";

const addressAPI = process.env.REACT_APP_BACKEND_API;

export const editTaskContent = (state, task) => (dispatch, getState) => {
  const { id, task_name, card_id } = task;
  const updatedTask = {
    task_name,
    task_content: `{"desc":"${state}"}`,
  };

  axios
    .put(
      `${addressAPI}/api/v1/manage/tasks?id=${id}`,
      updatedTask,
      tokenConfig(getState)
    )
    .then((response) => {
      notifySuccess(response.data);
      dispatch({
        type: TASK_UPDATE,
        payload: {
          task_id: id,
          task_content: updatedTask.task_content,
          card_id: card_id,
        },
      });
    })
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

export const deleteTask = (task) => async (dispatch, getState) => {
  const { id } = task;

  await axios
    .delete(`${addressAPI}/api/v1/manage/tasks?id=${id}`, tokenConfig(getState))
    .then((response) => {
      dispatch({ type: TASK_DELETE, payload: task });
    })
    .catch((err) => notifyError(err.message));
};

export const addTask = (taskName, cardId) => async (dispatch, getState) => {
  const newTask = {
    card_id: cardId,
    task_name: taskName,
    task_content: '{"desc":"Edit your task description!"}',
  };

  await axios
    .post(
      `${addressAPI}/api/v1/manage/tasks?id=${cardId}`,
      newTask,
      tokenConfig(getState)
    )
    .then((response) => {
      const { task } = response.data;
      dispatch({ type: TASK_ADDED, payload: task });
    })
    .catch((err) => notifyError(err.message));
};
