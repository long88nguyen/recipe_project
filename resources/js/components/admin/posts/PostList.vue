<template>
    <div class="post-product">
        
       <div class="table-wrapper">
        <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/dashboard">Trang chủ</router-link></a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/posts">Quản lý bài viết</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
        <PostFilter @search="updateSearch"/>
        
        <table class="content-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th style="width:15%">Người đăng</th>
                        <th style="width:15%">Danh mục</th>   
                        <th>Tiêu đề</th>
                        <th style="width:20%">Mô tả</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width:10%">Thời gian</th>
                        <th style="width:15%">Ngày tạo</th>
                        <th style="width:5%">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post,index) in dataPost.data" :key="index">
                        <td>{{
                      (dataPost.current_page - 1) *
                      dataPost.per_page +
                        index +
                        1
                  }}</td>
                        <td>{{ post.member.name }}</td>
                        <td>{{ post.category.name }}</td>   
                        <td>{{ post.title }}</td>
                        <td>{{ post.content.substring(0,30) + "..." }}</td>
                        <td> 
                            <div class="title pending" v-if="(post.status==1)">
                                Chờ duyệt
                            </div>
                            <div class="title approved" v-if="(post.status==2)">
                                Đã duyệt
                            </div>
                            <div class="title reject" v-if="(post.status==3)">
                                Từ chối
                            </div>
                        </td>
                        <td>{{ post.time }} phút</td>
                        <td>{{ post.created_at }}</td>
                        <td>
                          <i class="fa-solid fa-pen-to-square" style="color:blue" @click="approveModal(post.id)"></i>
                        </td>
                    </tr>
                </tbody>
                
          </table>
                
        </div>
        

        <PostApproveModal
        :visible="ApproveVisible"
        :id = "idPost"
        @ok="handleEditOk"
        @cancel="handleEditCancel"
        >

        </PostApproveModal>
        <a-pagination 
        class="paginate"
        v-model:current="searchData.paginate.currentPage" 
        :total="searchData.paginate.totalRecord" 
        :page-size="Number(searchData.paginate.perPage)" 
        @change = "changePage"
        show-less-items />
    </div>
</template>

<script>

import PostApproveModal from "./modals/PostApproveModal.vue"
import PostFilter from "./filters/PostFilter.vue"
import { mapGetters } from 'vuex'

export default {
    components:{
        PostApproveModal,
        PostFilter,
    },  
    data(){
        return{
            ApproveVisible:false,
            idPost:null,
            searchData: {
              category_name:"",
              member_name:"",
              status:"",
              itemsPerPage:5,
              paginate: {
                from: 0,
                to: 0,
                totalPage: 0,
                path: "",
                currentPage: 1,
                totalRecord: 0,
                perPage: 0,
            },
          },
        }
    },
    computed:{
        ...mapGetters({
            dataPost : "posts/dataPost",
            listItemsPerPage: "common/listItemsPerPage",
            pagination: "posts/pagination"
        })
    },
    created(){
        // let params = this.$route.query;
        // params.perPage =
        // this.listItemsPerPage.includes(parseInt(params.perPage)) &&
        // !isNaN(params.perPage)
        //   ? params.perPage
        //   : '5';
        // this.searchData = {
        //   member_name: params.member_name == undefined
        //     ? this.searchData.member_name.toLowerCase()
        //     : params.member_name.toLowerCase(),

        //   category_name: params.category_name == undefined
        //     ? this.searchData.category_name.toLowerCase()
        //     : params.category_name.toLowerCase(),
        //     status:

        //   params.status == undefined
        //     ? parseInt(this.searchData.status)
        //     : parseInt(params.status),

        //   itemsPerPage: params.perPage,
        //   paginate: {
        //     from: params.from,
        //     to: params.to,
        //     totalPage: parseInt(params.totalPage),
        //     path: this.searchData.paginate.path,
        //     currentPage: parseInt(params.currentPage),
        //     totalRecord: parseInt(params.totalRecord),
        //     perPage: parseInt(params.perPage),
        //   },
        // }
        this.fetchDataPost()
    },
    methods:{
        async fetchDataPost()
        {
            await this.$store.dispatch("posts/getPosts",{
                category_name :this.searchData.category_name,
                member_name :this.searchData.member_name,
                status: this.searchData.status ? parseInt(this.searchData.status) : null,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            })
            this.searchData.paginate = this.pagination;
        },

        dateFormat(value) {
        if (value) {
            return moment(String(value)).format("HH:mm:ss DD/MM/YYYY ");
        }
        },
        checkDataParam(data) {
            return data === 0 || data === "" ? undefined : data;
        },
        passParamUrl() {
            this.$router.push({
                name: "post-list",
                // query: {
                //     category_name: this.checkDataParam(this.searchData.category_name),
                //     member_name: this.checkDataParam(this.searchData.member_name),
                //     status: this.searchData.status ? this.checkDataParam(parseInt(this.searchData.status)) : '',
                //     currentPage: this.checkDataParam(
                //     this.searchData.paginate.currentPage
                //     ),
                //     perPage: this.checkDataParam(this.searchData.itemsPerPage),
                // },
            }).catch(() => {});
        },
        changePage(page) {
            this.passParamUrl();
            this.fetchDataPost(this.searchData.itemsPerPage, page);
        },
        clearParamUrl() {
            return;
        },
        updateSearch(filter) {
        this.searchData = {
            ...this.searchData,
            ...filter
        };
        this.searchData.paginate.currentPage = 1;
        this.passParamUrl();
        this.search();
        },
        async search() {
        if (this.$route.fullPath !== "/posts") {
            this.clearParamUrl();

        }
        this.fetchDataPost();
    },
    approveModal(params)
    {
        this.idPost = params;
        this.ApproveVisible = !this.ApproveVisible;
    },
    async handleEditOk() {
        this.ApproveVisible = false;
        this.idPost = null;
        this.fetchDataPost();
        this.$emit("change");
    },
    handleEditCancel() {
        this.visibleModalEdit = false;
        this.idCategory = null;
    },
    }
}
</script>

<style lang="scss" scoped>
.post-product{
  width:100%;
  .table-wrapper{
  width: 90%;
  margin: 0 auto;
  padding-top :20px;
  .breadcumb-field{
    padding: 30px 0;
    font-family: Arial, Helvetica, sans-serif;
  }
  .content-table{
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 15px;
  width: 100%; 
  margin : 0 auto;
  border-radius:15px 15px 0 0 ;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.15);
  thead{
    tr{
        background-color: #009879;
        color:#ffffff;
        font-weight: bold;
        th{
            padding:12px 15px;
            border:2px solid white;
            text-align: center;
        }
        th:first-child{
          border-top-left-radius: 15px;
        }
        th:last-child{
          border-top-right-radius: 15px;
        }
    }
  } 
  tbody{
    tr{
        border-bottom : 1px solid #dddddd;
        text-align: center;
        td{
            padding:12px 15px;
            border:2px solid white;

            img{
              height: 60px;
              width: 60px;
            }
            i{
              font-size:15px;
              margin: 0px 10px ;
              padding:15px;
              background: rgb(239, 237, 237);
              border-radius: 50%;
              color: white;
            }
            .title{
                width: 100px;
                height: 30px;
                border-radius: 15px;
                text-align: center;
                line-height: 30px;
                font-size: 12px;
                font-weight: bold; 
                font-family: Arial, Helvetica, sans-serif;          
            }
            .pending{
                background: orange;
            }
            .approved
            {
                background: #009879;
            }
            .reject{
                background: red;
            }
        }
    }
    tr:nth-of-type(even)
    {
        background-color: #f3f3f3;
    }
    tr:last-of-type
    {
        border-bottom: 2px solid #009879;
    }
  }
}
}
}
.paginate
{
  margin-top:30px;
  text-align: center;
}




</style>

