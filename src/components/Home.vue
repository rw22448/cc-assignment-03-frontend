<template>
  <div>
  <div class="container">
    <header class="jumbotron">
      <h3>{{ title }}</h3>
    </header>
  </div>

  <div class="row" v-for="event in events" :key="event.id">
    <div class="col-md-3 text-center">
      <img src="https://picsum.photos/200" alt="" />
    </div>
    <div class="col-md-9 event-container">
      <h4>{{ event.title }}</h4>
      <p><strong>Creator : </strong> {{ event.creator }}</p>
      <p><strong>Start Time : </strong> {{ event.startTime }}</p>
      <p><strong>End Time : </strong> {{ event.endTime }}</p>
      <p><strong>Description :</strong> {{ event.description }}</p>
      <p class="p-align-right">
        <button
          @click="handleJoinEvent(event.id)"
          class="btn btn-outline-danger btn-sm"
        >
          Attend
        </button>
        <button
          @click="handleLeaveEvent(event.id)"
          class="btn btn-outline-danger btn-sm"
        >
          Leave
        </button>
      </p>
      <div :key="eventJoinMessage">
  {{ eventJoinMessage }}
  </div>
    </div>
  </div>
  
  </div>
</template>

<script>
import UserService from "../services/user.service";

export default {
  name: "Home",
  data() {
    return {
      title: "Public Listing Events",
      events: [],
      eventJoinMessage: ""
    };
  },
  mounted() {
    UserService.getAllEvent().then(
      (response) => {
        this.events = response.data.events;
      },
      (error) => {
        this.content = error.response.data.error;
      }
    );
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  methods: {
    handleJoinEvent(id) {
      const username = JSON.parse(localStorage.getItem('user')).username

      if (!this.loggedIn) {
        this.$router.push("/login");
      } else {
        this.$store.dispatch("auth/join", { 'id': id, 'username': username }).then(
        (data) => {
        this.eventJoinMessage = "Successfully joined event " + id;
          console.log(data);
        },
        (error) => {
          console.log(error);
        }
      );

      }
    },
    handleLeaveEvent(id) {
      const username = JSON.parse(localStorage.getItem('user')).username

      if (!this.loggedIn) {
        this.$router.push("/login");
      } else {
        this.$store.dispatch("auth/leave", { 'id': id, 'username': username }).then(
          (data) => {
            this.eventJoinMessage = "Successfully left event " + id;
            console.log(data);
          },
          (error) => {
            this.message = error.response.data.error;
          }
        );
      }
    },
  },
};
</script>
