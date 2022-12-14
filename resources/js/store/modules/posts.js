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
    showApprove: {},
    memberPost : {},
    getPostApproved : {},
    getAllPost : {},

}

export const getters = {
    dataPost : state => state.dataPost,
    pagination: state => state.pagination,
    showApprove: state => state.showApprove,
    memberPost: state => state.memberPost,
    getPostApproved: state => state.getPostApproved,
    getAllPost: state => state.getAllPost,

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
    [types.POST.GET_POST_APPROVED](state, data) {
      state.getPostApproved = data.dataPost;
      state.pagination.from = data.dataPost.from;
      state.pagination.to = data.dataPost.to;
      state.pagination.totalPage = data.dataPost.last_page;
      state.pagination.path = data.dataPost.path;
      state.pagination.currentPage = data.dataPost.current_page;
      state.pagination.totalRecord = data.dataPost.total;
      state.pagination.perPage = data.dataPost.per_page;
    },
    [types.POST.GET_ALL_POST](state, data) {
      state.getAllPost = data.searchPost;
    },
    [types.POST.GET_POST_DETAIL](state, dataApprove)
    {
      state.showApprove = dataApprove;
      state.memberPost = dataApprove.member
    }
  
}

export const actions = {
    async getPosts({ commit },payload) {
        const response = await axios.get(api.LIST_ALL_POST,{
            params:{
                category_name: payload.category_name,
                member_name: payload.member_name,
                status:payload.status,
                per_page: payload.itemsPerPage,
                page: payload.currentPage, 
            }
        });
        commit(types.POST.GET_POST_LIST, response.data.data);
      },

      async getPostsApproved({ commit },payload) {
        const response = await axios.get(api.LIST_POST_APPROVED,{
          params:{
              category_id: payload.category_id,
              per_page: payload.itemsPerPage,
              page: payload.currentPage, 
          }
      });
        commit(types.POST.GET_POST_APPROVED, response.data.data);
      },

      async getAllPost({ commit },payload) {
        const response = await axios.get(api.SEARCH_POST_APPROVED,{
          params:{
              title: payload.title,
          }
      });
        commit(types.POST.GET_ALL_POST, response.data.data);
      },

      async getApprovePost({ commit }, params) {
        let url = `${api.SHOW_APPROVE}/${params}`;
        const response = await axios
          .get(url)
          .then(res => res)
          .catch(error => {
            return error.response;
          });
        if (response.status == 200) {
          commit(
            types.POST.GET_POST_DETAIL,
            response.data.data
          );
        }
      },

      async updateStatusPost({ commit }, params) {
        let url = `${api.APPROVE_POST}/${params.id}`;
        await axios.post(url, params);
      },
}
