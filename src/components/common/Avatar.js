/* eslint-disable react-hooks/exhaustive-deps */
import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getAvatar } from "../../actions/auth";
import { blobToFile } from "../../functions/helpers";

export const Avatar = () => {
  const dispatch = useDispatch();
  const userAvatar = useSelector((state) => state.authReducer.userAvatar);
  useEffect(() => {
    dispatch(getAvatar());
  }, []);
  const avatar = blobToFile(userAvatar, "avatar.png");
  console.log(avatar);
  return (
    <div>
      <img src={avatar} alt="avatar" />
    </div>
  );
};

export default Avatar;
