<template>
  <div class="col-md-12">
    <div class="card card-container">
      <h2>{{ title }}</h2>
      <Form @submit="handleEditEvent">
        <div v-if="!successful">
          <div class="form-group">
            <label for="title">Title</label>
            <Field
              name="title"
              type="text"
              v-model="data.title"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <Field
              name="description"
              type="text"
              v-model="data.description"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <label for="location">Location</label>
            <Field
              name="location"
              type="text"
              v-model="data.location"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <label for="startTime">Start Time</label>
            <Field
              name="startTime"
              type="text"
              v-model="data.startTime"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <label for="endTime">End Time</label>
            <Field
              name="endTime"
              type="text"
              v-model="data.endTime"
              class="form-control"
            />
          </div>

          <div class="form-group">
            <button class="btn btn-success btn-block" :disabled="loading">
              <span
                v-show="loading"
                class="spinner-border spinner-border-sm"
              ></span>
              Update
            </button>
          </div>
        </div>
        <Field name="id" type="hidden" v-model="data.id"/>
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
import UserService from "../services/user.service";
import { Form, Field } from "vee-validate";

export default {
  name: "EditEvent",
  components: {
    Form,
    Field,
  },
  data() {
    return {
      title: "Edit Event",
      data: [],
      loading: false,
      successful: false,
      message: "",
    };
  },
  methods: {
    handleEditEvent(event) {
      this.message = "";
      this.successful = false;
      this.loading = true;

      this.$store.dispatch("auth/updateEvent", event).then(
        (response) => {
          this.message = "Event ID: " + response.id + " updated.";
          this.successful = true;
          this.loading = false;
        },
        (error) => {
          this.message = error.response.data.error;
          this.successful = false;
          this.loading = false;
        }
      );
    },
  },
  mounted() {
    UserService.getAllEventByID(this.$route.params.id).then(
      (response) => {
        this.data = response.data;
      },
      (error) => {
        this.message = error.response.data.error;
      }
    );
  },
};
</script>