import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    bannerList:{},
    pagination: {
        from: 0,
        to: 0,
        totalPage: 0,
        path: "",
        currentPage: 0,
        totalRecord: 0,
        perPage: 0
      },
    categoryDetail: {},
    getBannerUser:{},
}

export const getters = {
    bannerList: state => state.bannerList,
    pagination: state => state.pagination,
    categoryDetail: state => state.categoryDetail,
    getBannerUser: state => state.getBannerUser,
}

export const mutations = {
    [types.BANNER.GET_BANNER_LIST](state, data) {
        state.bannerList = data.dataBanner;
        state.pagination.from = data.dataBanner.from;
        state.pagination.to = data.dataBanner.to;
        state.pagination.totalPage = data.dataBanner.last_page;
        state.pagination.path = data.dataBanner.path;
        state.pagination.currentPage = data.dataBanner.current_page;
        state.pagination.totalRecord = data.dataBanner.total;
        state.pagination.perPage = data.dataBanner.per_page;
      },
   
      [types.CATEGORY.GET_CATEGOTY_DETAIL](state, data)
      {
        state.categoryDetail = data.data.getCabannerUsertegoryById
        return state.categoryDetail
      },


      [types.BANNER.GET_BANNER_USER](state, data)
      {
        state.getBannerUser = data.bannerUserList
      },

}

export const actions = {
    async getBanners({ commit },payload) {
        const response = await axios.get(api.GET_ALL_BANNER,{
            params: {
                per_page: payload.itemsPerPage,
                page: payload.currentPage, 
              }
        });
        commit(types.BANNER.GET_BANNER_LIST, response.data.data);
      },

      async getBannersUser({ commit }) {
        const response = await axios.get(api.GET_BANNER_USER);
        commit(types.BANNER.GET_BANNER_USER, response.data.data);
      },
     
    async creataBanner({ commit }, params) {
        await axios.post(api.CREATE_BANNER, params);
    },

    async getCategoryDetail({ commit }, params) {
        let url = `${api.CATEGORY_DETAIL}/${params}`;
        const response = await axios
          .get(url)
          .then(res => res)
          .catch(error => {
            return error.response;
          });
        if (response.status == 200) {
          commit(
            types.CATEGORY.GET_CATEGOTY_DETAIL,
            response.data
          );
        }
      },

      async updateCategory({ commit }, params) {
        let url = `${api.CATEGORY_UPDATE}/${params.get("id")}`;
        await axios.post(url, params);
      },

      async deleteBanner({ commit }, bannerId) {
        await axios.delete(
          api.DELETE_BANNER + "/" + bannerId
        );
      },
}
