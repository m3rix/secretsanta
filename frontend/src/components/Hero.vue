<template>
  <div class="text-center hero">
    <p v-if="isAuthenticated" class="lead">
      {{ user.email }}
      This is a sample application that demonstrates an authentication flow for an SPA, using
      <a
        href="https://vuejs.org"
      >Vue.js</a>
    </p>
  </div>
</template>

<script>
import { useAuth0 } from '@auth0/auth0-vue';

export default {
  name: "HeroContent",
  setup() {
    const auth0 = useAuth0();

    return {
      isAuthenticated: auth0.isAuthenticated,
      user: auth0.user,
      login() {
        auth0.loginWithRedirect();
      },
      logout() {
        auth0.logout({
          returnTo: window.location.origin,
        });
      }
    }
  }
};

</script>
