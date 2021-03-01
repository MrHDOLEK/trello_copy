const initialState = {
  auth: [],
};

// eslint-disable-next-line import/no-anonymous-default-export
export default function (state = initialState, action) {
  switch (action.type) {
    case "GET_ONE":
      return {
        ...state,
        auth: action.payload,
      };
    default:
      return state;
  }
}
