import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    rateListByPost : {},
    rateDetail : {},
}

export const getters = {
    rateListByPost : state => state.rateListByPost,
    rateDetail : state => state.rateDetail,
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
