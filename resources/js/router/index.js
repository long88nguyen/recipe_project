import { createRouter,createWebHistory } from "vue-router";

import CategoryList from '../components/admin/categories/CategoryList.vue'
import middlewareAuth from "./middleware/auth";
import redirectCallback from './middleware/redirect-callback'
import store from "../store"

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
            path:'/:pathMatch(.*)*',
            component:import('../components/PageNotFound.vue'),
            name: "Not-Found",
        },
        {
            path:"/admin",
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
                    path:'/',
                    component:import('../components/user/HomePage.vue')
                },
                {
                    path:"/post-list",
                    component:import('../components/user/PostList.vue')
                },
                {
                    path:"/postdetail/:id",
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
                },
                {
                    path:"/all-post",
                    component:import('../components/user/GetAllPost.vue'),
                    name : "all-post",
                },

                {
                    path:"/post-by-author/:id",
                    component:import('../components/user/PostByAuthor.vue'),
                    name : "post-by-author",
                },

                {
                    path:"/chat-room",
                    component:import('../components/user/component/chat/container.vue'),
                    name : "chat-room",
                }
            ]
        }
       
    ]

const router = createRouter({
    history:createWebHistory(),
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { top:0 }
      }
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
    async function call(){
        if( store.getters['auth/token'] != '')
        {
            let ok = null;
            await store.dispatch('auth/getAccountInfo');
            console.log(store.getters['auth/accountInfo']);
            // ok = store.getters['auth/accountInfo'].is_admin;
            // if(to.meta.requiresAuth)
            // {
            //     if(ok == 0 && ((window.location.pathname.includes('categories')) || 
            //     (window.location.pathname.includes('posts'))
            //     || 
            //     (window.location.pathname.includes('dashboard'))
                
            //     || 
            //     (window.location.pathname.includes('rates'))
            //     ||
                
            //     (window.location.pathname.includes('members'))
            //     || 
            //     (window.location.pathname.includes('admin'))
            //     ))
            //     {
            //         next({name:"Not-Found"})
            //     }
            //     else{
            //         next()
            // }
            // }
            // else
            // {
            //     next()
            // }
        }
        else
        {
            next();
        }

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
        }
    return call();
  });

export default router
