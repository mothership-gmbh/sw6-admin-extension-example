import VueRouter from 'vue-router'
import Vue from 'vue'

Vue.use(VueRouter)

const routes = [
    {
        name: 'root',
        path: '/', component: () => import('../components/DemoApi.vue')
    },
    {
        name: 'api',
        path: '/api', component: () => import('../components/DemoApi.vue')
    },
    {
        name: 'form',
        path: '/form', component: () => import('../components/DemoForm.vue')
    }
]

const router = new VueRouter({
    routes,
})

export default router
