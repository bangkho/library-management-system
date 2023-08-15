import axios from "axios";

export const loginUser = async (options) => {
  console.log(options);

  const response = await axios(`/api/auth/login`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    ...options
  });
  console.log(response);

  return response.data;
};