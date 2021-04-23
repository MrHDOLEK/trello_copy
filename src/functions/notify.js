import { ToastContainer, toast } from "react-toastify";

const contextClass = {
  success: "bg-green-500",
  error: "bg-red-600",
  info: "bg-gray-600",
  warning: "bg-orange-400",
  default: "bg-indigo-600",
  dark: "bg-white-600 font-gray-300",
};

export const CustomToastContainer = () => {
  return (
    <ToastContainer
      position="top-center"
      toastClassName={({ type }) =>
        contextClass[type || "default"] +
        " relative flex p-1 min-h-10 rounded-md justify-between overflow-hidden cursor-pointer mt-5"
      }
      bodyClassName={() => "text-sm font-white font-med block p-3"}
      autoClose={3000}
    />
  );
};

export const notifySuccess = (message) => {
  toast.success(message);
};

export const notifyError = (message) => {
  toast.error(message);
};
