import { createRouter as createVueRouter, createWebHashHistory, Router } from "vue-router";
import Home from "../views/Home.vue";
import Profile from "../views/Profile.vue";
import Wishlist from "../views/Wishlist.vue";
import { createAuthGuard } from "@auth0/auth0-vue";
import { App } from 'vue';

export function createRouter(app: App): Router {
  return createVueRouter({
    routes: [
      {
        path: "/",
        name: "Secret Santa",
        component: Home
      },
      {
        path: "/wishlist",
        name: "Wishlist",
        component: Wishlist
      },
      {
        path: "/profile",
        name: "profile",
        component: Profile,
        beforeEnter: createAuthGuard(app)
      }
    ],
    history: createWebHashHistory()
  })
}
