import axios from "axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    categoryList:[],
}

export const getters = {
    categoryList: state => state.categoryList,
}

export const mutations = {
    [types.CATEGORY.FETCH_CATEGORY_LIST](state, categoryList) {
        state.categoryList = categoryList;
      },
}

export const actions = {
    async getListCategory({ commit }) {
        const response = await axios.get("https://heroku5012.herokuapp.com/api/test-api");

        commit(types.CATEGORY.FETCH_CATEGORY_LIST, response.data);
      },
}
