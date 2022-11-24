import axios from "axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    userCommon:[],
}

export const getters = {
    userCommon: state => state.userCommon,
}

export const mutations = {
    [types.COMMON.USER_INFO](state, userCommon) {
        state.userCommon = userCommon;
      },
}

export const actions = {
    async getUserCommon({ commit }) {
        const response = await axios.get(api.LIST_COMMON);

        commit(types.COMMON.USER_INFO, response.data.name);
      },
}