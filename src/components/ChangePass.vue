<template>
  <div class="col-md-12">
    <div class="card card-container">
      <h2>Change Password</h2>
      <Form @submit="handleChangPass" ref="form">
        <div class="form-group">
          <label for="username">Username</label>
          <Field
            name="username"
            type="text"
            :value="currentUser.username"
            class="form-control"
            disabled
          />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <Field name="password" type="password" class="form-control" />
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

        <div class="form-group">
          <div
            v-if="message"
            :class="successful ? 'alert-success' : 'alert-danger'"
            class="alert"
          >
            {{ message }}
          </div>
        </div>
      </Form>
    </div>
  </div>
</template>

<script>
import { Form, Field } from "vee-validate";

export default {
  name: "ChangePass",
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
    handleChangPass(user) {
      this.loading = true;
      this.successful = false;

      this.$store.dispatch("auth/changePass", user).then(
        () => {
          this.message = "Password Update";
          this.successful = true;
          this.loading = false;
          this.$refs.form.resetForm();
        },
        (error) => {
          this.successful = false;
          this.loading = false;
          this.message = error.response.data.error;
        }
      );
    },
  },
};
</script>