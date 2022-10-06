import { createRouter,createWebHistory } from "vue-router";

import CategoryList from '../components/categories/CategoryList.vue'
import ProductList from '../components/products/ProductList.vue'
import middlewareAuth from "./middleware/auth";
import redirectCallback from './middleware/redirect-callback'
const routes =
    [
        {
            path:"/login",
            component:import('../components/auth/Login.vue'),
            name: "Login",
            meta: {
                requiresAuth: false
              },
        },
        {
            path:"/",
            component:import("../commons/AuthLayout.vue"),
            meta: {
                requiresAuth: true
              },
            children:[
                {
                    path:'/categories',
                    component: CategoryList,
                    name:'category-list',
                },
                {
                    path:'/categories/create',
                    component:import("../components/categories/CategoryCreate.vue"),
                    name:'category-create'
                },
                {
                    path:'categories/detail/:id',
                    component:import("../components/categories/CategoryDetail.vue"),
                    name:'category-detail'
                },
                {
                    path:'/products',
                    component: ProductList,
                },
                {
                    path:'/products/create',
                    component:import("../components/products/ProductCreate.vue")
                }
            ]
        }
    ]

const router = createRouter({
    history:createWebHistory(),
    routes
})

// function globalMiddleware() {
//     return [middlewareAuth, redirectCallback];
//   }

// function nextFactory(context, middleware, index) {
//     const subsequentMiddleware = middleware[index];
//     if (!subsequentMiddleware) return context.next;

//     return (...parameters) => {
//       context.next(...parameters);
//       const nextMiddleware = nextFactory(context, middleware, index + 1);
//       subsequentMiddleware({ ...context, next: nextMiddleware });
//     };
//   }

//   router.beforeEach((to, from, next) => {
//     var middleware = null;
//     var routeMiddleware = null;

//     if (to.meta.middleware) {
//       routeMiddleware = Array.isArray(to.meta.middleware)
//         ? to.meta.middleware
//         : [to.meta.middleware];
//     }
//     middleware = routeMiddleware
//       ? globalMiddleware().concat(routeMiddleware)
//       : globalMiddleware();

//     if (middleware.length > 0) {
//       const context = { to, from, next, router };
//       const nextMiddleware = nextFactory(context, middleware, 1);

//       return middleware[0]({ ...context, next: nextMiddleware });
//     }

//     return next();
//   });
export default router
