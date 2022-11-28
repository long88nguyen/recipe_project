import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    categoryList:{},
}

export const getters = {
    categoryList: state => state.categoryList,
}

export const mutations = {
    [types.CATEGORY.FETCH_CATEGORY_LIST](state, data) {
        state.categoryList = data.listCategory;
      },
}

export const actions = {
    async getCategories({ commit }) {
        const response = await axios.get(api.LIST_CATEGORY);
        commit(types.CATEGORY.FETCH_CATEGORY_LIST, response.data.data);
      },
    async createCategory({ commit }, params) {
        await axios.post(api.CATEGORY_CREATE, params);
    },
}
