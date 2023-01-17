<template>
   
    <div class="category-product">
       
        <div class="table-wrapper">
          <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/dashboard">Trang chủ</router-link></a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/categories">Quản lý danh mục</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
          <CategoryFilterVue @search = "updateSearch">

          </CategoryFilterVue>
          
        <div class="btn btn-success mb-3"  @click="openModal">

            <span> Thêm mới danh mục</span>
        </div>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th >Ảnh mô tả</th>
                        <th>Ngày tạo</th>
                        <th >Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category, index) in categoryList.data" :key="index">
                        <td>{{
                            (categoryList.current_page - 1) *
                            categoryList.per_page +
                              index +
                              1
                        }}</td>
                        <td>{{ category.name }}</td>
                        <td> <img :src="category.image" class="img-thumbnail" alt="" @click="showImage(category.image)"/></td>
                        <td>{{ dateFormat(category.created_at) }}</td>
                        <td>
                          <i class="fa-solid fa-pen-to-square" style="color:blue" @click="categoryDetail(category.id)"></i>
                          <i class="fa-solid fa-trash" style="color:red" @click="confirmClick(category.id)"></i>
                        </td>
                    </tr>
                </tbody>
                
          </table>
        </div>
        <a-pagination 
        class="paginate"
        v-model:current="searchData.paginate.currentPage" 
        :total="searchData.paginate.totalRecord" 
        :page-size="Number(searchData.paginate.perPage)" 
        @change = "changePage"
        show-less-items />
        <a-modal 
              :header = null
               v-model:visible="visible" 
               :footer = null
               :closable = false
               centered
               >
               <img :src="selectedImg" class="img-thumbnail" alt=""/>
        </a-modal>

        <a-modal 
              :header = null
               v-model:visible="visibleConfirmDetele" 
               title="Xác nhận xóa danh mục? "
               :footer = null
               centered
               >
               <button class="btn btn-success" @click="categoryDelete()">Xóa danh mục</button>
               <button class="btn btn-danger" style="margin-left:20px" @click="cancalDelete()">Hủy xóa</button>
        </a-modal>


        <CategoryCreateModalVue
        :visible="visibleModal"
        @closeModal="(visibleModal = !visibleModal)"
        @fetchData="fetchCategoryList"
        @ok = "closeModal"
        >

        </CategoryCreateModalVue>

        <CategoryUpdateModal
          :visible="visibleModalEdit"
          :id = "idCategory"
          @ok="handleEditOk"
          @cancel="handleEditCancel"
        />
        
    </div>

</template>

<script>

import moment from "moment"
import { mapActions, mapGetters } from 'vuex';
import CategoryFilterVue from "./filters/CategoryFilter.vue";
import CategoryCreateModalVue from "./modals/CategoryCreateModal.vue";
import CategoryUpdateModal from "./modals/CategoryUpdateModal.vue";

export default {
    components:{
      CategoryFilterVue,
      CategoryCreateModalVue,
      CategoryUpdateModal
    },
    data()
    {
        return {
            categories:[],
            visible: false,
            visibleModal:false,
            visibleConfirmDetele:false,
            selectedImg: "",
            visibleModalEdit : false,
            idCategory : null,
            searchData: {
              name:"",
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

    async created()
    {
      // if (Object.keys(this.$route.query).length !== 0)
      // {
      //   let params = this.$route.query;
      //   params.perPage =
      //   this.listItemsPerPage.includes(parseInt(params.perPage)) &&
      //   !isNaN(params.perPage)
      //     ? params.perPage
      //     : '5';
      //   this.searchData = {
      //     name: params.name == undefined
      //       ? this.searchData.name.toLowerCase()
      //       : params.name.toLowerCase(),
      //     itemsPerPage: params.perPage,
      //     paginate: {
      //       from: params.from,
      //       to: params.to,
      //       totalPage: parseInt(params.totalPage),
      //       path: this.searchData.paginate.path,
      //       currentPage: parseInt(params.currentPage),
      //       totalRecord: parseInt(params.totalRecord),
      //       perPage: parseInt(params.perPage),
      //     },
      //   }

      // }
      
      this.fetchCategoryList()
    },
    computed:{
    ...mapGetters({
      categoryList : "categories/categoryList",
      listItemsPerPage: "common/listItemsPerPage",
      pagination: "categories/pagination",
    }),
   
   }, 
   
   methods: {
    ...mapActions("categories", ["deleteCategory"]),
    openModal() {
        this.visibleModal = !this.visibleModal
    },
    dateFormat(value) {
        if (value) {
            return moment(String(value)).format("HH:mm:ss DD/MM/YYYY ");
        }
    },
    async fetchCategoryList() {
        await this.$store.dispatch(
            "categories/getCategories", {
                name: this.searchData.name,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            }
        );
        this.searchData.paginate = this.pagination;
    },
    checkDataParam(data) {
        return data === 0 || data === "" ? undefined : data;
    },
    passParamUrl() {
        this.$router.push({
            name: "category-list",
            // query: {
            //     name: this.checkDataParam(this.searchData.name),
            //     currentPage: this.checkDataParam(
            //         this.searchData.paginate.currentPage
            //     ),
            //     perPage: this.checkDataParam(this.searchData.itemsPerPage),
            // },
        }).catch(() => {});
    },
    changePage(page) {
        this.passParamUrl();
        this.fetchCategoryList(this.searchData.itemsPerPage, page);
    },
    closeModal(){
      this.visibleModal = false;
      this.fetchCategoryList();
    },
    showImage(imageLink) {
        if (imageLink) {
            this.selectedImg = imageLink;
            this.visible = true
        } else {
            this.$toast.error('eo co anh');
        }

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
        if (this.$route.fullPath !== "/categories") {
            this.clearParamUrl();

        }
        this.fetchCategoryList();
    },
    clearParamUrl() {
        return;
    },
    categoryDetail(params) {
        this.visibleModalEdit = !this.visibleModalEdit;
        this.idCategory = params;
    },
    async handleEditOk() {
        this.visibleModalEdit = false;
        this.idCategory = null;
        this.fetchCategoryList();
        this.$emit("change");
    },
    handleEditCancel() {
        this.visibleModalEdit = false;
        this.idCategory = null;
    },
    confirmClick(category_id) {
        this.idCategory = category_id;
        this.visibleConfirmDetele = true;
    },
    async categoryDelete() {
        await this.deleteCategory(this.idCategory).then(() => {
                this.visibleConfirmDetele = false,
                this.fetchCategoryList();
            this.$toast.success("Xóa dữ liệu thành công!");
        }).catch(() => {
            this.$toast.error("Đã xảy ra lỗi!")
        })
    },

    cancalDelete(){
      this.visibleConfirmDetele =  false;
    }
  },   
}
</script>

<style lang="scss" scoped>
.category-product{
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
        td{
            padding:12px 15px;
            text-align: center;
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

