import React from "react";
import { Box } from "@material-ui/core";
import "./Logo.scss";

const Logo = () => {
  return (
    <Box className="dot_container" data-testid="logo">
      <Box className="dot first_dot" data-testid="dot" />
      <Box className="dot second_dot" data-testid="dot" />
      <Box className="dot third_dot" data-testid="dot" />
    </Box>
  );
};

export default Logo;
