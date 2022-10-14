require('./bootstrap');

import Vue from 'vue'
import { createApp } from "vue"
import AppVue from "./AppVue.vue"
import store from "./store";

import BootstrapVue3 from 'bootstrap-vue-3'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import router from './router'

import Antd from "ant-design-vue";
import "ant-design-vue/dist/antd.css";

const app = createApp({})

app.component('app-vue',AppVue)

app.use(BootstrapVue3)

app.use(Antd)

app.use(FontAwesomeIcon)

app.use(store)

app.use(router)

app.mount('#app')
