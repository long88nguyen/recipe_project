import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    
}

export const getters = {
    
}

export const mutations = {

}

export const actions = {
 async submitFavourite({ commit }, params) {
        let url = `${api.FAVOURITE_POST}/${params.id}`;
        await axios.post(url, params);
      },

    async deleteFavourite({ commit }, params) {
        let url = `${api.FAVOURITE_POST}/${params.id}`;
            await axios.delete(url);
            },
}
