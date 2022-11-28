import axios from "axios";
import store from "./store/index";
// import Vue from "vue";
// import Cookie from "js-cookie";
// import i18n from "@/i18n";
// import router from "./router/index";

// Request interceptor
axios.interceptors.request.use(
  request => {
    let token = store.getters["auth/token"];
    if (token) {
      request.headers.common["Accept"] = "application/json";
      request.headers.common["Authorization"] = `Bearer ${token}`;
    }
    return request;
  },
  error => {
    return Promise.reject(error);
  }
);

// axios.interceptors.response.use(
//     response => {
//       // Any status code that lie within the range of 2xx cause this function to trigger
//       // Do something with response data
//       return response.data;
//     },
//     error => {
//       const vm = new Vue({});
//       if (error.response.status === 401) {
//         Cookie.remove("access_token");
//         router.push({name: "Login"});
//         return Promise.reject(error);
//       }

//       if (error.response.status === 403 || error.response.status === 404) {
//         if (error.response.data.error.code === 4042) {
//           return Promise.reject(error);
//         }
//         Promise.resolve(error).then(error => Promise.reject(error));
//         router.push({name: error.response.status.toString()});
//       }

//       let msg = i18n.t(`error.default`);
//       if (
//         error.response.status === 422 &&
//         error.response.data.error.code === 4220
//       ) {
//         let messages = error.response.data.error.message;
//         let firstKey = Object.keys(messages)[0];
//         let firstValue = messages[firstKey][0];
//         let part = firstValue.slice(
//           firstValue.indexOf(".") + 1,
//           firstValue.length
//         );
//         msg = i18n.t(`error.validation.${firstKey}.${part}`);
//       } else {
//         if (error.response.data.error.code) {
//           msg = i18n.t(`error.${error.response.data.error.code}`);
//         }
//       }
//       vm.$bvToast.toast(msg + "!", {
//         title: i18n.t(`error.error`),
//         noCloseButton: false,
//         autoHideDelay: 10000,
//         appendToast: true,
//         toaster: "b-toaster-top-center",
//         variant: "danger",
//         solid: true
//       });
//       return Promise.reject(error);
//     }
//   );

  export default axios;
