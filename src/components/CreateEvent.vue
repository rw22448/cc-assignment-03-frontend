<template>
  <div class="col-md-12">
    <div class="card card-container">
      <h2>Host An Event</h2>
      <Form @submit="handleCreateEvent" ref="form">
        <div class="form-group">
          <label for="title">Title</label>
          <Field name="title" type="text" class="form-control" />
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <Field name="description" type="text" class="form-control" />
        </div>

        <div class="form-group">
          <label for="creator">Creator</label>
          <Field
            name="creator"
            type="text"
            :value="currentUser.username"
            class="form-control"
            disabled
          />
        </div>

        <div class="form-group">
          <label for="location">Location</label>
          <Field name="location" type="text" class="form-control" />
        </div>

        <div class="form-group">
          <label for="startTime">Start Time</label>
          <Field name="startTime" type="text" class="form-control" />
        </div>

        <div class="form-group">
          <label for="endTime">End Time</label>
          <Field name="endTime" type="text" class="form-control" />
        </div>

        <div class="form-group">
          <button class="btn btn-info btn-block" :disabled="loading">
            <span
              v-show="loading"
              class="spinner-border spinner-border-sm"
            ></span>
            Create Event
          </button>
        </div>
        <Field name="token" type="hidden" :value="currentUser.token" />
      </Form>

      <div
        v-if="message"
        class="alert"
        :class="successful ? 'alert-success' : 'alert-danger'"
      >
        {{ message }}
      </div>
    </div>
  </div>
</template>

<script>
import { Form, Field } from "vee-validate";

export default {
  name: "CreateEvent",
  components: {
    Form,
    Field,
  },
  data() {
    return {
      successful: false,
      loading: false,
      message: "",
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user;
    },
  },
  methods: {
    handleCreateEvent(event) {
      this.message = "";
      this.successful = false;
      this.loading = true;

      this.$store.dispatch("auth/createEvent", event).then(
        (data) => {
          this.message = "Event ID: " + data.id + " for new event.";
          this.successful = true;
          this.loading = false;
          this.$refs.form.resetForm();
        },
        (error) => {
          this.message = error.response.data.error;
          this.successful = false;
          this.loading = false;
        }
      );
    },
  },
};
</script>