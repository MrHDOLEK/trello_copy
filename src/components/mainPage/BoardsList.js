/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Link } from "react-router-dom";
import { getPrivateBoards } from "../../actions/boards";
import Loader from "react-loader-spinner";
import Avatar from "../common/Avatar";

function BoardsList() {
  const dispatch = useDispatch();
  const { isLoading, isFetched, privateTables } = useSelector(
    (state) => state.boardsReducer
  );

  useEffect(() => {
    dispatch(getPrivateBoards());
  }, []);

  if (isLoading)
    return (
      <div className="flex">
        <Loader
          className="mx-auto"
          type="ThreeDots"
          color="#10B981"
          height={70}
          width={70}
        />
      </div>
    );

  if (!isLoading && isFetched) {
    return (
      <div className="p-1">
        <h1 className="text-center sm:text-left text-xl font-bold text-gray-200">
          Private Boards
        </h1>
        <div className="flex flex-wrap">
          {privateTables.map((board) => (
            <Link
              to={`/dashboard/${board.id}`}
              key={board.id}
              className="bg-gray-200 rounded w-full flex-grow md:max-w-sm h-36 my-2 md:mr-4 hover:bg-gray-400 cursor-pointer"
            >
              <div>{board.name}</div>
            </Link>
          ))}
        </div>
        <Avatar />
      </div>
    );
  }

  return null;
}

export default BoardsList;
