import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    rateListByPost : {},
}

export const getters = {
    rateListByPost : state => state.rateListByPost,
}

export const mutations = {
    [types.RATE.RATE_POST_LIST](state, data)
    {
      state.rateListByPost = data.getRateByPost;
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
}
