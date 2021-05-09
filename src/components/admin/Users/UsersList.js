/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getUser } from "../../../actions/admin";
import Icon from "../../common/Icon";

const UsersList = () => {
  const users = useSelector((state) => state.adminReducer.users);
  const dispatch = useDispatch();
  useEffect(() => {
    dispatch(getUser());
  }, []);

  return (
    <div>
      <h3 className="text-center text-lg text-gray-200">USERS LIST</h3>
      <table className="w-full text-left">
        <thead>
          <tr className="bg-green-500">
            <th className="p-1">ID</th>
            <th className="p-1">Name</th>
            <th className="p-1">Email</th>
            <th className="p-1">Created At</th>
            <th className="p-1 text-center">Delete</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <SingleUser key={user.id} user={user} />
          ))}
        </tbody>
      </table>
    </div>
  );
};

const SingleUser = ({ user }) => (
  <tr className="text-gray-200 hover:bg-green-300 hover:text-black">
    <td className="p-1">#{user.id}</td>
    <td className="p-1">{user.name}</td>
    <td className="p-1">{user.email}</td>
    <td className="p-1">{user.created_at}</td>
    <td className="text-center">
      <button>
        <Icon icon="x" width="22" height="22" viewBox="0 0 24 24" />
      </button>
    </td>
  </tr>
);

export default UsersList;
