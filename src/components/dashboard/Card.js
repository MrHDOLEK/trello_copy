import React from "react";

export const Card = ({ data }) => {
  console.log(data);
  return <div className="bg-gray-200 rounded mb-2 p-2">{data.card_name}</div>;
};

export default Card;
