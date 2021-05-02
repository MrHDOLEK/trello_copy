import React, { useRef, useState } from "react";
import { useDispatch } from "react-redux";
import { createTeam, getTeam } from "../../actions/team";
import { notifyError } from "../../functions/notify";
import Button from "../common/Button";
import InputField from "../common/InputField";

const Teams = () => {
  const dispatch = useDispatch();
  const [state, setState] = useState({ team_name: "", users_mail: [] });
  const inputRef = useRef(null);

  const onChange = (event) => {
    setState({ ...state, [event.target.name]: event.target.value });
  };

  const addMember = () => {
    if (!state.users_mail.find((member) => inputRef.current.value === member)) {
      const newArray = [...state.users_mail, inputRef.current.value];
      setState({ ...state, users_mail: newArray });
      inputRef.current.value = "";
      console.log(state);
    } else {
      notifyError("Already added");
    }
  };

  const removeMember = (user) => {
    const newArray = state.users_mail.filter((member) => member !== user);
    setState({ ...state, users_mail: newArray });
  };

  const onSubmit = () => {
    dispatch(createTeam(state));
  };

  return (
    <div className="border border-gray-700 rounded text-gray-200 p-1">
      <h2 className="my-2 text-xl font-bold">Create new team</h2>
      <InputField
        placeholder="Name of your team?"
        type="text"
        variant="variantTwo"
        name="team_name"
        onChange={onChange}
        label="Team name"
      />
      <div className="flex flex-col mt-2 mb-2">
        <label htmlFor={"users_email"} className="text-xl text-gray-200 mx-1">
          Team members
        </label>
        <input
          placeholder="Who is member of your team?"
          type="text"
          className="bg-gray-100 border-2 focus:border-green-400 rounded text-gray-900 p-1"
          name="users_email"
          id="users_email"
          ref={inputRef}
          onKeyDown={(event) => event.key === "Enter" && addMember()}
        />
      </div>

      {state.users_mail.map((user) => (
        <div key={user} className="inline-block mr-2">
          <span> - {user}</span>
          <button
            onClick={() => removeMember(user)}
            className="bg-red-500 ml-1 w-6 h-6 hover:bg-red-600 rounded-full"
          >
            x
          </button>
        </div>
      ))}

      <Button
        text="Create Team"
        type="submit"
        variant="variantOne"
        width="full"
        textColor="black"
        onClick={onSubmit}
      />
      <button onClick={() => dispatch(getTeam())}>CLICK</button>
    </div>
  );
};

export default Teams;
