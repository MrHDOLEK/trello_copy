import axios from "axios";
import { tokenConfig } from "../functions/token";
import { notifyError, notifySuccess } from "../functions/notify";

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
