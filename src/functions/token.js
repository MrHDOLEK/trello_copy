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

export default tokenConfig;
