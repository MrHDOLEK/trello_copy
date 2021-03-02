export const loginUser = () => (dispatch) => {
  dispatch({
    type: "USER_LOGIN_LOADING",
    payload: { loading: true, isAuthenticated: false },
  });
  setTimeout(() => {
    dispatch({
      type: "USER_LOGIN_LOADED",
      payload: { loading: false, isAuthenticated: true },
    });
  }, 500);
};
