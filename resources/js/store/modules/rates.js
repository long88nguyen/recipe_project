import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    rateListByPost : {},
    rateDetail : {},
    getAllRate : {},
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
    rateListByPost : state => state.rateListByPost,
    rateDetail : state => state.rateDetail,
    getAllRate : state => state.getAllRate,
    pagination: state => state.pagination,

}

export const mutations = {
    [types.RATE.RATE_POST_LIST](state, data)
    {
      state.rateListByPost = data.getRateByPost;
    },

    [types.RATE.RATE_DETAIL](state, data)
    {
      state.rateDetail = data.getRateDetail;
    },

    [types.RATE.LIST_ALL_RATE](state, data)
    {
      state.getAllRate = data.getAll;
      state.pagination.from = data.getAll.from;
      state.pagination.to = data.getAll.to;
      state.pagination.totalPage = data.getAll.last_page;
      state.pagination.path = data.getAll.path;
      state.pagination.currentPage = data.getAll.current_page;
      state.pagination.totalRecord = data.getAll.total;
      state.pagination.perPage = data.getAll.per_page;
    },
}

export const actions = {
    async saveRate({ commit }, params) {
        let url = `${api.POST_RATE}/${params.post_id}`;
        await axios.post(url, params);
    },

    async listRatePost({ commit }, postId) {
        const response = await axios.get(
          api.POST_RATE_LIST + "/" + postId
        );
        commit(
          types.RATE.RATE_POST_LIST,
          response.data.data
        );
      },

      async getAllRateAdmin({ commit }, payload) {
        const response = await axios.get(
          api.GET_ALL_RATE,{
            params:{
              per_page: payload.itemsPerPage,
              page: payload.currentPage, 
            }
          } 
        );
        commit(
          types.RATE.LIST_ALL_RATE,
          response.data.data
        );
      },

    async detailRate({ commit }, rateId) {
      const response = await axios.get(
        api.RATE_DETAIL + "/" + rateId
      );
      commit(
        types.RATE.RATE_DETAIL,
        response.data.data
      );
    },

    async updateRate({ commit }, params) {
      let url = `${api.UPDATE_RATE}/${params.id}`;
      await axios.post(url, params);
    },

    async deleteRate({ commit }, rateId) {
      let url = api.DELETE_RATE + "/" + rateId;
      await axios.delete(url);
    },
}
