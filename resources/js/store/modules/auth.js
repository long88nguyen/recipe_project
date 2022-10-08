import axios from "axios";
import Cookies from "js-cookie";
import * as types from "../mutation-types";
// import api from "@/api/api";
const api = "https://heroku5012.herokuapp.com/api"

export const state = {
  token: Cookies.get("access_token"),
  account: [],
  redirectPath: "",
  callback: null
};

// getters
export const getters = {
  token: state => state.token,
  account: state => state.account,
  callback: state => state.callback
};

// mutations
export const mutations = {
  [types.AUTH.AUTH_LOGIN](state, account) {
    state.token = account.data.access_token;
    let cookieOptions = { expires: account.data.expires_in / 86400 }
    Cookies.set("access_token", account.data.access_token, cookieOptions);
  },

  [types.AUTH.AUTH_LOGOUT](state, account) {
    if (account.status === 200) {
      Cookies.remove("access_token");
      state.token = "";
      state.account = [];
    }
  },

  [types.AUTH.AUTH_REFRESH_TOKEN](state, account) {
    state.token = account.data.token;
    Cookies.set("access_token", account.data.token, {
      expires: account.data.expires_in

    });
  },

  [types.AUTH.FETCH_AUTH](state, account) {
    state.account = account;
  },
  [types.AUTH.SET_PATH](state, path) {
    state.redirectPath = path;
  },

  [types.AUTH.SET_CALLBACK_URL](state, callback = null) {
    state.callback = callback;
  }
};

// actions
export const actions = {
  login({ commit }, accounts) {
    return new Promise((resolve, reject) => {
      axios
        .post(api+"/login", accounts)
        .then(response => {
          commit(types.AUTH.AUTH_LOGIN, response);
          resolve(response);
        })
        .catch(error => {
          reject(error);
        });
    });
  },

  logout({ commit }) {
    commit(types.AUTH.AUTH_LOGOUT, { status: 200 });
  },

//   refreshToken({ commit }) {
//     return new Promise((resolve, reject) => {
//       axios
//         .post(api.)
//         .then(response => {
//           resolve(response);
//           commit(types.AUTH.AUTH_REFRESH_TOKEN, response);
//         })
//         .catch(error => {
//           reject(error);
//         });
//     });
//   },

//   accountInfo({ commit }) {
//     if (state.account.length === 0) {
//       return new Promise((resolve, reject) => {
//         axios
//           .get(api.ACCOUNT)
//           .then(response => {
//             resolve(response);
//             commit(types.AUTH.FETCH_AUTH, response.data);
//           })
//           .catch(error => {
//             reject(error);
//           });
//       });
//     }
//   },

  // eslint-disable-next-line
//   changePassword({ commit }, payload) {
//     return new Promise((resolve, reject) => {
//       axios
//         .post(api.CHANGE_PASSWORD, {
//           password: payload.password,
//           password_new: payload.passwordNew
//         })
//         .then(response => {
//           resolve(response);
//           Cookies.remove("access_token");
//         })
//         .catch(error => {
//           reject(error);
//         });
//     });
//   },

  // eslint-disable-next-line
//   saveToken({ commit }, params) {
//     let url = api.SAVE_TOKEN;
//     // eslint-disable-next-line
//     const response = axios.post(url, params);
//   },
  // eslint-disable-next-line
//   removeToken({ commit }, params) {
//     let url = api.REMOVE_TOKEN;
//     // eslint-disable-next-line
//     const response = axios.post(url, params);
//   },

  setRedirectPath({commit}, path) {
    commit(types.AUTH.SET_PATH, path);
  },

  setCallback({ commit }, callback_url = null) {
    commit(types.AUTH.SET_CALLBACK_URL, callback_url);
  }
};
