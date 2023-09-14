import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    getAllRoom : {},
    getRoomById : {}
}

export const getters = {
    getAllRoom : state => state.getAllRoom,
    getRoomById : state => state.getRoomById
}

export const mutations = {
    [types.CHAT.FETCH_ALL_ROOM](state, data)
    {
      state.getAllRoom = data;
    },

    [types.CHAT.FETCH_ROOM_SELECTED](state, data)
    {
      state.getRoomById = data;
    },
}

export const actions = {
    async listAllRoom({ commit }, roomId) {
        const response = await axios.get(
          api.ALL_ROOM 
        );
        commit(
          types.CHAT.FETCH_ALL_ROOM,
          response.data
        );
      },

      async getRoomByID({ commit }, roomId) {
        const response = await axios.get(
          api.ROOM_SELECTED + "/" + roomId
        );
        commit(
          types.CHAT.FETCH_ROOM_SELECTED,
          response.data
        );
      },

      async sendMessage({ commit }, params) {
        let url = `${api.CHAT_POST}/${params.id}`;
        await axios.post(url, params);
      },
}
