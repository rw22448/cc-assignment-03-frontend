export default function authHeader() {
  let user = JSON.parse(localStorage.getItem('user'));
  
  if (user && user.token) {
    return {
      'cc-authentication-token': user.token,
      'cc-authentication-user': user.username
    };
  } else {
    return {};
  }
}
