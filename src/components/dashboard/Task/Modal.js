import React from "react";
import Modal from "react-modal";

const customStyles = {
  overlay: {
    position: "fixed",
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: "rgba(0, 0, 0, 0.5)",
  },
  content: {
    position: "absolute",
    top: "80px",
    left: "100px",
    right: "100px",
    bottom: "80px",
    border: "1px solid #ccc",
    background: "#E5E7EB",
    overflow: "auto",
    WebkitOverflowScrolling: "touch",
    borderRadius: "4px",
    outline: "none",
    padding: "1.5rem",
  },
};

export const ModalWrapper = ({ isOpen, onRequestClose, ...props }) => {
  return (
    <Modal
      isOpen={isOpen}
      onRequestClose={onRequestClose}
      contentLabel="Example Modal"
      style={customStyles}
    >
      {props.children}
    </Modal>
  );
};

export default ModalWrapper;
