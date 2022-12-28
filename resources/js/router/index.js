import { createRouter,createWebHistory } from "vue-router";

import CategoryList from '../components/admin/categories/CategoryList.vue'
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
            path:"/register",
            component:import('../components/auth/Register.vue'),
            name: "Register",
            meta: {
                requiresAuth: false
              },
        },
        {
            path:"/",
            component:import("../components/admin/commons/AuthLayout.vue"),
            meta: {
                requiresAuth: true,
              },
            children:[
                {
                    path:'/dashboard',
                    component: import("../components/admin/dashboard/Dashboard.vue"),
                    name:'Dashboard',
                },
                {
                    path:'/categories',
                    component: CategoryList,
                    name:'category-list',
                },
                {
                    path:'/posts',
                    component: import("../components/admin/posts/PostList.vue"),
                    name:'post-list',
                },
                {
                    path:'/rates',
                    component: import("../components/admin/rates/RateList.vue"),
                    name:'rate-list',
                },
                {
                    path:'/favourites',
                    component: import("../components/admin/favourites/FavouriteList.vue"),
                    name:'favourite-list',
                },
                {
                    path:'/members',
                    component: import("../components/admin/members/MemberList.vue"),
                    name:'member-list',
                },
                {
                    path:'/comments',
                    component: import("../components/admin/comments/CommentList.vue"),
                    name:'comment-list',
                },
            ]
        },
        {
            path:'/',
            component:import("../components/user/Dashboard.vue"),
            meta: {
                requiresAuth: true,
              },
            children:
            [
                {
                    path:'/home-page',
                    component:import('../components/user/HomePage.vue')
                },
                {
                    path:"/post-list",
                    component:import('../components/user/PostList.vue')
                },
                {
                    path:"/post-detail/:id",
                    component:import('../components/user/PostDetail.vue')
                },
                {
                    path:"/profile",
                    component:import('../components/user/Profile.vue')
                },
                {
                    path:"/create-post",
                    component:import('../components/user/CreatePost.vue')
                },
                {
                    path:"/update-post/:id",
                    component:import('../components/user/component/posts/UpdatePost.vue')
                },
                {
                    path:"/search-result",
                    component:import('../components/user/SearchResult.vue'),
                    name : "search-post",
                }
            ]
        }
       
    ]

const router = createRouter({
    history:createWebHistory(),
    routes
})

function globalMiddleware() {
    return [middlewareAuth, redirectCallback];
  }

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
      context.next(...parameters);
      const nextMiddleware = nextFactory(context, middleware, index + 1);
      subsequentMiddleware({ ...context, next: nextMiddleware });
    };
  }

  router.beforeEach((to, from, next) => {
    var middleware = null;
    var routeMiddleware = null;

    if (to.meta.middleware) {
      routeMiddleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];
    }
    middleware = routeMiddleware
      ? globalMiddleware().concat(routeMiddleware)
      : globalMiddleware();

    if (middleware.length > 0) {
      const context = { to, from, next, router };
      const nextMiddleware = nextFactory(context, middleware, 1);

      return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
  });
export default router
