import axios from "axios";

const apiBase = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    timeout: 5000,
    withCredentials: true,
    headers: {
        Accept: "application/json",
    },
});

export default apiBase;
