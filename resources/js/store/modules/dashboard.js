import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    getStarRate :{}
}

export const getters = {
    getStarRate : state => state.getStarRate,
}

export const mutations = {
    [types.DASHBOOARD.STAR_RATE](state, data)
    {
      state.getStarRate = data.dataStar;
    },

}

export const actions = {
    async getDataRate({ commit }, payload) {
        const response = await axios.get(
          api.GET_STAR_RATE);
        commit(
          types.DASHBOOARD.STAR_RATE,
          response.data
        );
      },
}