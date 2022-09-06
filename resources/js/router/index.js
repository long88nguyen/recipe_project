import { createRouter,createWebHistory } from "vue-router";

import CategoryList from '../components/categories/CategoryList.vue'
import ProductList from '../components/products/ProductList.vue'
const routes =
[
    {
        path:'/categories',
        component: CategoryList

    },
    {
        path:'/products',
        component: ProductList

    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})


export default router
