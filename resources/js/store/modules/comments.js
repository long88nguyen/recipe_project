import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    getCommentByPost : {},
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
    getCommentByPost : state => state.getCommentByPost,
    pagination: state => state.pagination,
}

export const mutations = {
    [types.COMMENT.FECTH_LIST_COMMENT](state, data)
    {
      state.getCommentByPost = data.getCommentbyPost;
      state.pagination.from = data.getCommentbyPost.from;
      state.pagination.to = data.getCommentbyPost.to;
      state.pagination.totalPage = data.getCommentbyPost.last_page;
      state.pagination.path = data.getCommentbyPost.path;
      state.pagination.currentPage = data.getCommentbyPost.current_page;
      state.pagination.totalRecord = data.getCommentbyPost.total;
      state.pagination.perPage = data.getCommentbyPost.per_page;
    },

    // [types.CHAT.FETCH_ROOM_SELECTED](state, data)
    // {
    //   state.getCommentByPost = data;
    // },
}

export const actions = {
    async listPostById({ commit }, payload) {
        const response = await axios.get(
          api.COMMENT_LIST + '/' + payload.id,{
            params: {
                per_page: payload.itemsPerPage,
                page: payload.currentPage, 
              }
        }
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