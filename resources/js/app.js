require('./bootstrap');

import Vue from 'vue'
import { createApp } from "vue"
import AppVue from "./AppVue.vue"
import store from "./store";
import Toaster from '@meforma/vue-toaster';

import router from './router'

import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";

const app = createApp({})

app.component('app-vue',AppVue)

app.use(Antd)

app.use(Toaster,{
    position:"top",
    duration:2000
})

app.use(store)

app.use(router)

app.mount('#app')
