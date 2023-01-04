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
        <th></th>
        <tr v-for="wish in wishlist" :key="wish">
          <td>{{wish.name}}</td>
          <td>
            <button class="delete is-medium"></button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div v-else-if="!isAuthenticated">

  </div>
</template>
<style>
.is-medium.delete:hover {
  background-color: hsl(348, 100%, 61%)!important;
}
</style>
<script>
import { useAuth0 } from '@auth0/auth0-vue';
import axios from 'axios';
import { ref } from 'vue';
const errors = ref({});
axios.defaults.baseURL = "http://localhost:8000/api/v1/"

export default {
  name: "wishList",
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
      wishlist: null,
    };
  },
  created: function() {
    this.created();
  },

  methods: {
    addWish() {
      try {
        const post_data = { name: this.name, user_id:1 };
        axios.post("wishlist",  post_data)
            .then((response) => {
              this.created()
              this.name = "";
            })

      } catch(error) {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      }
    },
    deleteWish() {
      try {
        const post_data = { name: this.name, user_id:1 };
        axios.delete("wishlist/",  post_data)
            .then((response) => {
              this.created()
              this.name = "";
            })

      } catch(error) {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      }
    },
    async created() {
      const response = await axios.get("wishlist");
      this.wishlist = response.data.data;
    },
  }
}

</script>
