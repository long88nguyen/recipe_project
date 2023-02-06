import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    getCommentByPost : {},
}

export const getters = {
    getCommentByPost : state => state.getCommentByPost,
}

export const mutations = {
    [types.COMMENT.FECTH_LIST_COMMENT](state, data)
    {
      state.getCommentByPost = data.getCommentbyPost;
    },

    // [types.CHAT.FETCH_ROOM_SELECTED](state, data)
    // {
    //   state.getCommentByPost = data;
    // },
}

export const actions = {
    async listPostById({ commit }, postId) {
        const response = await axios.get(
          api.COMMENT_LIST + '/' + postId
        );
        commit(
          types.COMMENT.FECTH_LIST_COMMENT,
          response.data.data
        );
      },


      async createComment({ commit }, params) {
        await axios.post(api.COMMENT_CREATE + '/' + params.id, params);
    },

    async createReply({ commit }, params) {
        await axios.post(api.COMMENT_REPLY + '/' + params.id, params);
    },

    async deleteComment({ commit }, commentId) {
        await axios.delete(api.DELETE_COMMENT + '/' + commentId);
    },
}