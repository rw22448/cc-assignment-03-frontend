<template>
  <div>
  <div class="container">
    <header class="jumbotron">
      <h3>{{ title }}</h3>
    </header>
  </div>

  <div class="row">
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Creator</th>
          <th>Description</th>
          <th>Attendees</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Edit</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in events" :key="event.id">
          <td>{{ event.title }}</td>
          <td>{{ event.creator }}</td>
          <td>{{ event.description }}</td>
          <td>{{ event.attendees.length }}</td>
          <td>{{ event.startTime }}</td>
          <td>{{ event.endTime }}</td>

          <td>
            <button
              @click="handleEditEvent(event.id)"
              class="btn btn-outline-primary btn-sm"
            >
              +
            </button>
          </td>
          <td>
            <button
              @click="handleRemoveEvent(event.id)"
              class="btn btn-outline-danger btn-sm"
            >
              X
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</template>

<script>
import UserService from "../services/user.service";

export default {
  name: "EventPage",
  data() {
    return {
      title: "All Events",
      events: [],
    };
  },
  methods: {
    handleRemoveEvent(id) {
      this.$store.dispatch("auth/removeEvent", id).then(
        () => {
          let user = JSON.parse(localStorage.getItem('user'));
          UserService.getAllEventByCreator(user.username).then(
            (response) => {
              this.events = response.data.events;
            },
            (error) => {
              this.title = error.response.data.error;
            }
          );
        },
        (error) => {
          this.message = error.response.data.error;
        }
      );
    },
    handleEditEvent(id) {
      this.$router.push({ name: "editEvent", params: { id: id } });
    },
  },
  mounted() {
    let user = JSON.parse(localStorage.getItem('user'));
    UserService.getAllEventByCreator(user.username).then(
      (response) => {
        this.events = response.data.events;
      },
      (error) => {
        this.content = error.response.data.error;
      }
    );
  },
};
</script>
