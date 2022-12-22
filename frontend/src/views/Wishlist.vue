<template>
  <div class="columns" v-if="isAuthenticated">
    <form class="column is-half field has-addons" @submit.prevent="addWish">
      <input class="input" type="text" placeholder="Add a wish" v-model="name">
      <button class="button">Lägg till</button>
    </form>
    <div class="column is-half">
      <table class="table">
        <tbody>
        <th>Önskelista</th>
        <tr v-for="wish in wishlist" :key="wish">
          <td>{{wish.name}}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div v-else-if="!isAuthenticated">

  </div>
</template>

<script>
import { useAuth0 } from '@auth0/auth0-vue';
import axios from 'axios';
const headers = { "Content-Type": "application/json" };

export default {
  setup() {
    const auth0 = useAuth0();
    return {
      isAuthenticated: auth0.isAuthenticated,
      isLoading: auth0.isLoading,
      user: auth0.user,
    }
  },
  data() {
    return {
      wishlist: null
    };
  },

  async created() {
    const response = await axios.get("http://localhost:8000/api/v1/wishlist", { headers });
    this.wishlist = response.data.data;
  },

  methods: {
    addWish() {
      console.log(user.name);
      //const post_data = { name: this.name };
      //const response = await axios.post("http://localhost:8000/api/v1/wishlist", { post_data }, { headers } );
      //this.wishlist = response.data.data;
    }
  }
}

</script>
