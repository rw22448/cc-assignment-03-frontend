import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://avnaanvefh.execute-api.us-east-1.amazonaws.com/dev/';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'users/login', {
        username: user.username,
        password: user.password
      })
      .then(response => {
        if (response.data.token) {
          console.log(response.data)
          localStorage.setItem('user', JSON.stringify(response.data))
        }

        return response.data
      });
  }

  logout() {
    localStorage.removeItem('user');
  }

  register(user) {
    return axios.post(API_URL + 'users/create-user', {
      username: user.username,
      password: user.password
    })
  }

  changePass(user) {
    return axios.put(API_URL + 'users/update-user-password', {
      username: user.username,
      password: user.password
    })
  }

  createEvent(event) {
    return axios.post(API_URL + 'events/create-event', {
      title: event.title,
      description: event.description,
      creator: event.creator,
      startTime: event.startTime,
      endTime: event.endTime,
      location: event.location
    }, {
      headers: authHeader()
    })
  }

  removeEvent(id) {
    return axios.delete(API_URL + 'events/delete-event-by-id/' + id, {
      headers: authHeader()
    })
  }

  updateEvent(event) {
    return axios.put(API_URL + 'events/update-event', {
      id: event.id,
      title: event.title,
      description: event.description,
      startTime: event.startTime,
      endTime: event.endTime,
      location: event.location
    }, {
      headers: authHeader()
    })
  }

  joinEvent(id) {
    let user = JSON.parse(localStorage.getItem('user'));

    return axios.put(API_URL + 'events/add-attendees', {
      eventId: id,
      username: user.username
    }, {
      headers: authHeader()
    })
  }

  createImage(imageInput) {
    let user = JSON.parse(localStorage.getItem('user'));

    return axios.post(API_URL + 'users/images/create-image', {
      username: user.username,
      image: imageInput
    }, {
      headers: authHeader()
    })
  }
}

export default new AuthService();
