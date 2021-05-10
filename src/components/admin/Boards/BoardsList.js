/* eslint-disable react-hooks/exhaustive-deps */

import React, { useEffect } from "react";
import { useSelector, useDispatch } from "react-redux";
import { getTable } from "../../../actions/admin";
import Icon from "../../common/Icon";

const BoardsList = () => {
  const boards = useSelector((state) => state.adminReducer.boards);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getTable());
  }, []);

  console.log(boards);

  return (
    <div>
      <h3 className="text-center text-lg text-gray-200 my-2">PACKAGE LIST</h3>
      <table className="w-full text-left mt-3">
        <thead>
          <tr className="bg-green-500">
            <th className="p-1">ID</th>
            <th className="p-1">Name</th>
            <th className="p-1">Users</th>
            <th className="p-1">Is Private</th>
            <th className="p-1">Created At</th>
            <th className="p-1">Creator ID</th>
            <th className="p-1 text-center">Delete</th>
          </tr>
        </thead>
        <tbody>
          {boards.map((oneBoard) => (
            <SingleBoard
              key={oneBoard.id}
              oneBoard={oneBoard}
              dispatch={dispatch}
            />
          ))}
        </tbody>
      </table>
    </div>
  );
};

const SingleBoard = ({ oneBoard, dispatch }) => (
  <tr className="text-gray-200 hover:bg-green-300 hover:text-black">
    <td className="p-1">#{oneBoard.id}</td>
    <td className="p-1">{oneBoard.name}</td>
    <td className="p-1">{oneBoard.users}</td>
    <td className="p-1">{oneBoard.is_visible}</td>
    <td className="p-1">{oneBoard.created_at}</td>
    <td className="p-1">{oneBoard.creator_id}</td>
    <td className="text-center">
      <button>
        <Icon icon="x" width="22" height="22" viewBox="0 0 24 24" />
      </button>
    </td>
  </tr>
);

export default BoardsList;
