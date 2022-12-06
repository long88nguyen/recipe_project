import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    dataPost : {},
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
    dataPost : state => state.dataPost,
}

export const mutations = {
    [types.POST.GET_POST_LIST](state, data) {
        state.dataPost = data.postList;
        state.pagination.from = data.postList.from;
        state.pagination.to = data.postList.to;
        state.pagination.totalPage = data.postList.last_page;
        state.pagination.path = data.postList.path;
        state.pagination.currentPage = data.postList.current_page;
        state.pagination.totalRecord = data.postList.total;
        state.pagination.perPage = data.postList.per_page;
    },
    
}

export const actions = {
    async getPosts({ commit },payload) {
        const response = await axios.get(api.LIST_ALL_POST,{
            params: {
                // per_page: payload.itemsPerPage,
                // page: payload.currentPage, 
                // name: payload.name,    
              }
        });
        commit(types.POST.GET_POST_LIST, response.data.data);
      },
}
