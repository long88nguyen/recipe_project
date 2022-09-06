require('./bootstrap');

import { createApp } from "vue"
import AppVue from "./AppVue.vue"

import BootstrapVue3 from 'bootstrap-vue-3'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import router from './router'

import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";

const app = createApp({})

app.component('app-vue',AppVue)

app.use(BootstrapVue3)

app.use(Antd)

app.use(router)

app.mount('#app')
