/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { getPrivateSingleBoard } from "../../actions/boards";
import Loader from "react-loader-spinner";
import { Card } from "./Card";

export const Dashboard = () => {
  const dispatch = useDispatch();
  const { id } = useParams();
  const { selectedBoard, singleBoardLoading, singleBoardFetched } = useSelector(
    (state) => state.boardsReducer
  );

  useEffect(() => {
    dispatch(getPrivateSingleBoard(id));
  }, []);

  if (singleBoardLoading)
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

  if (!singleBoardLoading && singleBoardFetched) {
    return (
      <div className="min-h-screen">
        <h1 className="text-gray-200 text-3xl text-center mb-2">
          {selectedBoard.name}
        </h1>
        {selectedBoard.card.map((card) => (
          <Card key={card.id} data={card} />
        ))}
      </div>
    );
  }

  return null;
};

export default Dashboard;
