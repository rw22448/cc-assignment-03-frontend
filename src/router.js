import { createWebHistory, createRouter } from 'vue-router'
import Home from './components/Home.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import EventPage from './components/EventPage.vue'
import CreateEvent from './components/CreateEvent.vue'
import EditEvent from './components/EditEvent.vue'
import Profile from './components/Profile.vue'
import ChangePass from './components/ChangePass.vue'
import NotFound from './components/NotFound.vue'

const routes = [
  {
    path: "/",
    component: Home
  },
  {
    path: "/login",
    component: Login
  },
  {
    path: "/register",
    component: Register
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile
  },
  {
    path: "/changepass",
    name: "changepass",
    component: ChangePass
  },
  {
    path: '/event',
    name: 'event',
    component: EventPage
  },
  {
    path: '/createEvent',
    name: 'createEvent',
    component: CreateEvent
  },
  {
    path: '/editEvent',
    name: 'editEvent',
    component: EditEvent
  },
  // 404
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: NotFound
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register', '/'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('user');

  // trying to access a restricted page + not logged in
  // redirect to login page
  if (authRequired && !loggedIn) {
    next('/login');
  } else {
    next();
  }
});

export default router;