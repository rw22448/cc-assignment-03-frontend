<template>
  <div class="container">
    <header class="jumbotron">
      <h3>
        <img
          id="profile-img"
          :src="imageUrl"
          class="profile-img-card"
        />
        <strong>{{ currentUser.username }}</strong> Profile
      </h3>
    </header>
    <p>
      <strong>Token:</strong>
      {{ currentUser.token }}
    </p>
  </div>
</template>

<script>
export default {
  name: "Profile",
  computed: {
    currentUser() {
      return this.$store.state.auth.user;
    },
    imageUrl() {
      return 'https://cc-03-user-images-bucket-dev.s3.amazonaws.com/' + this.currentUser.username
    }
  },
  mounted() {
    if (!this.currentUser) {
      this.$router.push("/login");
    }
  },
};
</script>