import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    userCommon:{},
    listItemsPerPage: [50, 100, 200],
}

export const getters = {
    userCommon: state => state.userCommon,
    listItemsPerPage: state => state.listItemsPerPage,
}

export const mutations = {
    [types.COMMON.USER_INFO](state, userCommon) {
        state.userCommon = userCommon.data.member_info;
      },
}

export const actions = {
    async getUserCommon({ commit }) {
        const response = await axios.get(api.LIST_COMMON);
        commit(types.COMMON.USER_INFO, response.data);
      },
}