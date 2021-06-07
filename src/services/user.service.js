import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://avnaanvefh.execute-api.us-east-1.amazonaws.com/dev/';

class UserService {
  getAllEvent() {
    return axios.get(API_URL + 'public-events/get-all-events', { headers: authHeader() });
  }

  getAllEventByID(id) {
    return axios.get(API_URL + 'events/get-event-by-id/' + id, { headers: authHeader() });
  }

  getAllEventByCreator(username) {
    return axios.get(API_URL + 'events/get-events-by-creator/' + username, { headers: authHeader() });
  }

  // getUserBoard() {
  //   return axios.get(API_URL + 'user', { headers: authHeader() });
  // }

  // getModeratorBoard() {
  //   return axios.get(API_URL + 'mod', { headers: authHeader() });
  // }

  // getAdminBoard() {
  //   return axios.get(API_URL + 'admin', { headers: authHeader() });
  // }
}

export default new UserService();
