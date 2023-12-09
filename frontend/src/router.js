import { createRouter, createWebHistory } from 'vue-router'
import index from "./components/LoginForm.vue";
import myWishlist from "./components/WishList.vue";
import loginForm from "./components/LoginForm.vue";
import registerForm from "./components/LoginForm.vue";


export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: index,
        },
        {
            path: '/wishlist',
            component: myWishlist,
        },
        {
            path: '/login',
            component: loginForm,
        },
        {
            path: '/register',
            component: registerForm,
        },
    ],
})
