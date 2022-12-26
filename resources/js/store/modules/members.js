import axios from "../../axios";
import * as types from "../mutation-types";
import api from "../../api/api";

export const state = {
    listDataMember : {},
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
    listDataMember : state => state.listDataMember,
    pagination: state => state.pagination,

}

export const mutations = {
    [types.MEMBER.GET_ALL_MEMBER](state, data)
    {
      state.listDataMember = data.listMember;
      state.pagination.from = data.listMember.from;
      state.pagination.to = data.listMember.to;
      state.pagination.totalPage = data.listMember.last_page;
      state.pagination.path = data.listMember.path;
      state.pagination.currentPage = data.listMember.current_page;
      state.pagination.totalRecord = data.listMember.total;
      state.pagination.perPage = data.listMember.per_page;
    },
}

export const actions = {
    async getAllMemberAdmin({ commit }, payload) {
        const response = await axios.get(
          api.MEMBER_LIST,{
            params:{
              name: payload.name, 
              per_page: payload.itemsPerPage,
              page: payload.currentPage, 
               
            }
          } );
        commit(
          types.MEMBER.GET_ALL_MEMBER,
          response.data.data
        );
      },
}
