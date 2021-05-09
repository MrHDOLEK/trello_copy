/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { getPrivateSingleBoard } from "../../actions/boards";
import Loader from "react-loader-spinner";
import { Card } from "./Card";
import { DashboardMenu } from "./DashboardMenu";

export const Dashboard = () => {
  const dispatch = useDispatch();
  const { id } = useParams();
  const { selectedBoard, singleBoardLoading, singleBoardFetched } = useSelector(
    (state) => state.singleBoardReducer
  );

  useEffect(() => {
    dispatch(getPrivateSingleBoard(id));
  }, []);

  if (singleBoardLoading)
    return (
      <div className="flex pt-24">
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
      <div className="">
        <DashboardMenu selectedBoard={selectedBoard} />
        <div className="sm:flex flex-row flex-nowrap overflow-x-auto">
          {selectedBoard.card.map((card) => (
            <Card key={card.id} card={card} />
          ))}
        </div>
      </div>
    );
  }

  return null;
};

export default Dashboard;
