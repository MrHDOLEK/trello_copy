import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { getPrivateSingleBoard } from "../../actions/boards";
import Loader from "react-loader-spinner";

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

  return <div>HEY</div>;
};

export default Dashboard;
