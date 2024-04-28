import { createRouter, createWebHistory } from 'vue-router';
import AboutView from "../Pages/AboutView.vue";
import AddMovieView from '../Pages/AddMovieView';
import HomeView from "../Pages/HomeView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: HomeView
        },
        {
            path: '/about',
            component: AboutView
        },
        {
            path: '/movies/create',
            name: 'add-movie',
            component: AddMovieView,
        }
    ]
})

export default router;