<template>
  <div class="col-md-12">
    <div class="card card-container">
      <h2>Register</h2>
      <Form @submit="handleRegister">
        <div v-if="!successful">
          <div class="form-group">
            <label for="username">Username</label>
            <Field name="username" type="text" class="form-control" />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <Field name="password" type="password" class="form-control" />
          </div>
          <div class="form-group">
            <label for="image">Profile Picture (.jpg) (less than 2MB)</label>
            <Field name="image" type="file" class="form-control" accept="image/jpeg" />
          </div>

          <div class="form-group">
            <button class="btn btn-success btn-block" :disabled="loading">
              <span
                v-show="loading"
                class="spinner-border spinner-border-sm"
              ></span>
              Sign Up
            </button>
          </div>
        </div>
      </Form>

      <router-link to="/login" class="nav-link">
        <font-awesome-icon icon="sign-in-alt" /> Already register?
      </router-link>

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
  name: "Register",
  components: {
    Form,
    Field,
  },
  data() {
    return {
      successful: false,
      loading: false,
      message: "",
      image: '',
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  mounted() {
    if (this.loggedIn) {
      this.$router.push("/profile");
    }
  },
  methods: {
    handleRegister(user) {
      this.message = "";
      this.successful = false;
      this.loading = true;
      this.image = user.image;

      this.$store.dispatch("auth/register", user).then(
        (data) => {
          this.message =
            "Congratulation " + data.username + ", success register.";
          this.successful = true;
          this.loading = false;
          this.$store.dispatch("auth/createImage", this.createB64Image(data.image)).then(
            () => {
              //
            }
          )
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