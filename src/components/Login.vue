<template>
  <div class="col-md-12">
    <div class="card card-container">
      <h2>Login</h2>
      <Form @submit="handleLogin">
        <div class="form-group">
          <label for="username">Username</label>
          <Field name="username" type="text" class="form-control" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <Field name="password" type="password" class="form-control" />
        </div>

        <div class="form-group">
          <button class="btn btn-primary btn-block" :disabled="loading">
            <span
              v-show="loading"
              class="spinner-border spinner-border-sm"
            ></span>
            <span>Login</span>
          </button>
        </div>

        <div class="form-group">
          <div v-if="message" class="alert alert-danger" role="alert">
            {{ message }}
          </div>
        </div>
      </Form>

      <router-link to="/register" class="nav-link">
        <font-awesome-icon icon="user-plus" /> Don't have an account?
      </router-link>
    </div>
  </div>
</template>

<script>
import { Form, Field } from "vee-validate";

export default {
  name: "Login",
  components: {
    Form,
    Field,
  },
  data() {
    return {
      loading: false,
      message: '',
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn
    },
  },
  created() {
    if (this.loggedIn) {
      this.$router.push("/profile")
    }
  },
  methods: {
    handleLogin(user) {
      this.loading = true;

      this.$store.dispatch("auth/login", user).then(
        () => {
          this.$router.push("/profile")
        },
        (error) => {
          this.loading = false
          this.message = error.response.data.error
        }
      )
    }
  }
}
</script>