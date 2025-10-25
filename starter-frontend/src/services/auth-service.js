import axios from "axios";
import config from "../config"; // Make sure this file contains: export default { apiUrl: "http://127.0.0.1:8000" }

function getApiClientHeader() {
  return {
    Accept: "application/json",
    "Content-Type": "application/json",
  };
}

// Create axios instance for API calls
const authService = axios.create({
  baseURL: `${config.apiUrl}/api`,
  timeout: 1000 * 60 * 10, // 10 minutes
  headers: getApiClientHeader(),
});

// Optional: Automatically log errors for debugging
authService.interceptors.response.use(
  (response) => response,
  (error) => {
    console.error("API Error:", error.response?.data || error.message);
    return Promise.reject(error);
  }
);

export default {
  /**
   * Register a new member
   * @param {Object} payload - { name, email, phone, id_number, password }
   */
  async register(payload) {
    try {
      const response = await authService.post("/register", payload);
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: "Registration failed" };
    }
  },

  /**
   * Login existing user
   * @param {Object} payload - { email, password }
   */
  async login(payload) {
    try {
      const response = await authService.post("/login", payload);
      return response.data;
    } catch (error) {
      throw error.response?.data || { message: "Login failed" };
    }
  },
};
