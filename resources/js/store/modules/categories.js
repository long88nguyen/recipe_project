import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    categoryList:{},
    pagination: {
        from: 0,
        to: 0,
        totalPage: 0,
        path: "",
        currentPage: 0,
        totalRecord: 0,
        perPage: 0
      },
}

export const getters = {
    categoryList: state => state.categoryList,
    pagination: state => state.pagination,
}

export const mutations = {
    [types.CATEGORY.FETCH_CATEGORY_LIST](state, data) {
        state.categoryList = data.listCategory;
        state.pagination.from = data.listCategory.from;
        state.pagination.to = data.listCategory.to;
        state.pagination.totalPage = data.listCategory.last_page;
        state.pagination.path = data.listCategory.path;
        state.pagination.currentPage = data.listCategory.current_page;
        state.pagination.totalRecord = data.listCategory.total;
        state.pagination.perPage = data.listCategory.per_page;
      },
}

export const actions = {
    async getCategories({ commit },payload) {
        const response = await axios.get(api.LIST_CATEGORY,{
            params: {
                per_page: payload.itemsPerPage,
                page: payload.currentPage,     
              }
        });
        commit(types.CATEGORY.FETCH_CATEGORY_LIST, response.data.data);
      },
    async createCategory({ commit }, params) {
        await axios.post(api.CATEGORY_CREATE, params);
    },
}
