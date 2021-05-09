/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getPackage, deletePackage } from "../../../actions/admin";
import NewPackage from "./NewPackage";
import Icon from "../../common/Icon";

const PacketsList = () => {
  const packages = useSelector((state) => state.adminReducer.packages);
  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPackage());
  }, []);
  return (
    <div>
      <h3 className="text-center text-lg text-gray-200 my-2">PACKAGE LIST</h3>
      <NewPackage />
      <table className="w-full text-left mt-3">
        <thead>
          <tr className="bg-green-500">
            <th className="p-1">ID</th>
            <th className="p-1">Name</th>
            <th className="p-1">Price</th>
            <th className="p-1">Description</th>

            <th className="p-1">Created At</th>
            <th className="p-1 text-center">Delete</th>
          </tr>
        </thead>
        <tbody>
          {packages.map((onePackage) => (
            <SinglePackage
              key={onePackage.id}
              onePackage={onePackage}
              dispatch={dispatch}
            />
          ))}
        </tbody>
      </table>
    </div>
  );
};

const SinglePackage = ({ onePackage, dispatch }) => (
  <tr className="text-gray-200 hover:bg-green-300 hover:text-black">
    <td className="p-1">#{onePackage.id}</td>
    <td className="p-1">{onePackage.name}</td>
    <td className="p-1">{onePackage.price}</td>
    <td className="p-1">{onePackage.description}</td>
    <td className="p-1">{onePackage.created_at}</td>
    <td className="text-center">
      <button onClick={() => dispatch(deletePackage(onePackage.id))}>
        <Icon icon="x" width="22" height="22" viewBox="0 0 24 24" />
      </button>
    </td>
  </tr>
);

export default PacketsList;
