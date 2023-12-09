<template>
  <div class="container">
    <form v-if="user_logged_in" @submit.prevent="Login">
      <h1 class="mb-3">Välkommen till julklappsspelet</h1>
        <div class="row mb-3">
          <label class="col-3">Email Address:</label>
          <input class="col-9" type="email" v-model="email" placeholder="Email Address">
        </div>
        <div class="row mb-3">
          <label class="col-3 text-right">Password:</label>
          <input class="col-9" type="password" v-model="password" placeholder="Password">
        </div>
        <div class="text-left">
          <button type="button" class="btn btn-success" @click="Login">Logga in</button>
          <a class="btn btn-link" href="/register">Registrera dig</a>
          <p>{{ message }}</p>
        </div>
    </form>
    <div v-else>
      <form @submit.prevent="Logout">
        <button>Sign out</button>
      </form>
    </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  name: 'LoginForm',
  data() {
    return {
      email: '',
      password: '',
      message: '',
      user_logged_in: true
    }
  },

  methods: {
    Login() {
      axios.post('http://localhost:8000/api/login',
          {
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            localStorage.setItem('user_id', res.data.user.id);
            localStorage.setItem('usertoken', res.data.token);
          })
          .catch((err) => {
            this.message = 'Failed to log in'
            localStorage.removeItem('user_id')
            localStorage.removeItem('usertoken')
            console.log(err)
          })
    },
    Logout() {
      localStorage.removeItem('user_id')
      localStorage.removeItem('usertoken')
    },
    checkLogin() {
      if (localStorage.getItem('usertoken') && localStorage.getItem('user_id')) {
        this.user_logged_in = false;
      }
    }
  },
  mounted() {
    this.checkLogin();
  }
}
</script>