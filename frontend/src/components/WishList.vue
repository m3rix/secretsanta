<template>
  <loginForm></loginForm>
  <div v-if="user_logged_in === true">
    <h1 class="title is-1">My wishlist</h1>
    <div class="columns">
      <div class="column is-half">
        <!--Edit mode -->
        <form v-if="edit_mode===true" @submit.prevent="editWish(edit_post)">
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">Önskan</label>
            </div>
            <div class="field-body">
              <div class="field">
                <p class="control">
                  <input class="input" type="text" v-model="name">
                </p>
              </div>
            </div>
          </div>
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">Länk</label>
            </div>
            <div class="field-body">
              <div class="field">
                <p class="control">
                  <input class="input" type="text" v-model="url" placeholder="Skriv in länk">
                </p>
              </div>
            </div>
          </div>
          <button class="button">Update</button>
        </form>
        <!--Add mode -->
        <form v-else @submit.prevent="AddWish">
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">Önskan</label>
            </div>
            <div class="field-body">
              <div class="field">
                <p class="control">
                  <input class="input" type="text" v-model="name" placeholder="Vad önskar du dig?">
                </p>
              </div>
            </div>
          </div>
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">Länk</label>
            </div>
            <div class="field-body">
              <div class="field">
                <p class="control">
                  <input class="input" type="text" v-model="url" placeholder="Vart kan man hitta det du önskar dig?">
                </p>
              </div>
            </div>
          </div>
          <button class="button">Add</button>
        </form>
        {{ message }}
      </div>
      <div class="column is-half">
        <table class="table">
          <tbody>
          <tr v-for="wish in wishlist" :key="wish">
            <td>{{ wish.name }}</td>
            <td>
              <form @submit.prevent="startEditWish(wish.id)">
                <button class="button is-success">Edit</button>
              </form>
            </td>
            <td>
              <form @submit.prevent="deleteWish(wish.id)">
                <button class="button is-danger">Delete</button>
              </form>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>

<script>
import axios from 'axios';
import loginForm from "@/components/LoginForm";

export default {
  name: 'WishList',
  components: {
    loginForm
  },
  data() {
    return {
      name: null,
      url: null,
      wishlist: null,
      response: null,
      edit_post: '',
      user_id: 1,
      edit_mode: false,
      message: null,
      user_logged_in: false
    }
  },

  methods: {
    ListWishlist() {
      axios.get("http://localhost:8000/api/v1/wishlist",{
        headers: {
          'Authorization': `Bearer ` + localStorage.usertoken
        }
      })
          .then(response => this.wishlist = response.data.data)
          .catch((err) => {
            console.error(err)
            this.message = 'Could not list diary posts'
          });
    },
    AddWish() {
      axios.post("http://localhost:8000/api/v1/wishlist", {
          name: this.name,
          url: this.url,
          user_id: localStorage.getItem('user_id')
        },
          {
            headers: {
              'Authorization': `Bearer ` + localStorage.usertoken
            }
          }
      )
          .then(() =>
                  this.ListWishlist(),
                  this.message = null,
                  this.name = null,
                  this.name = null
          )
          .catch((err) => {
            console.error(err)
            this.message = 'Could not list diary posts'
          });
    },
    deleteWish(id) {
      axios.delete('http://localhost:8000/api/v1/wishlist/'+ id, {
        headers: {
          'Authorization': `Bearer ` + localStorage.usertoken
        }
      })
          .then(() => this.ListWishlist())
          .catch((err) => {
            console.error(err)
            this.message = 'Could not delete diary post'
          })
    },
    editWish(id) {
      this.edit_mode = false;
      this.message=""
      axios.put('http://localhost:8000/api/v1/wishlist/' + id, {
        name: this.name,
        url: this.url,
      }, {
        headers: {
          'Authorization': `Bearer ` + localStorage.usertoken
        }
      } )
          .then(
              () =>
                  this.ListWishlist(),
                  this.message = "",
                  this.name = ""
          )
          .catch((err) => {
            console.error(err)
            this.message = 'Could not edit diary post'
          })
    },
    startEditWish(id) {
      this.edit_mode = true;
      this.edit_post = id;
      this.message= "";
      axios.get('http://localhost:8000/api/v1/wishlist/' + id, {
        headers: {
          'Authorization': `Bearer ` + localStorage.usertoken
        }
      })
          .then(response => [
                this.name = response.data.data.name,])
          .catch((err) => {
            console.error(err)
            this.message = 'Could not start editing post'
          })
    },
    checkLogin() {
      if (localStorage.getItem('usertoken') && localStorage.getItem('user_id')) {
        this.user_logged_in = true;
      }
    }
  },
  mounted () {
    this.checkLogin();
    this.ListWishlist();
  }
}
</script>