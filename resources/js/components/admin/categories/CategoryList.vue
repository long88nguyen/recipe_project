<template>
   
    <div class="category-product">
       
        <div class="table-wrapper">
          <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/categories">Home</router-link></a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/categories">Categories</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
          <router-link to="/categories/create">
        <div class="btn btn-primary mb-3">

            <span> Thêm mới danh mục</span>
        </div>
        </router-link>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width:20%">Image</th>
                        <th>Created at</th>
                        <th style="width:20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categoryList.data" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td> <img :src="`uploads/category/${category.image}`" class="img-thumbnail" alt=""/></td>
                        <td>{{ dateFormat(category.created_at) }}</td>
                        <td><i class="fa-solid fa-pen-to-square" style="color:blue"></i><i class="fa-solid fa-trash" style="color:red"></i></td>
                    </tr>
                </tbody>
          </table>
        </div>
        <a-pagination v-model="searchData.paginate.currentPage" :total="searchData.paginate.totalRecord" show-less-items />
    </div>
</template>

<script>

import moment from "moment"
import { mapGetters } from 'vuex';

export default {
    data()
    {
        return {
            categories:[],
            visible: false,
            searchData: {
              itemsPerPage:3,
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
      console.log(this.searchData);
      if (Object.keys(this.$route.query).length !== 0)
      {
        let params = this.$route.query;
        params.perPage =
        this.listItemsPerPage.includes(parseInt(params.perPage)) &&
        !isNaN(params.perPage)
          ? params.perPage
          : 3;
        this.searchData = {
          itemsPerPage: params.perPage,
          paginate: {
            from: params.from,
            to: params.to,
            totalPage: parseInt(params.totalPage),
            path: this.searchData.paginate.path,
            currentPage: parseInt(params.currentPage),
            totalRecord: parseInt(params.totalRecord),
            perPage: parseInt(params.perPage),
          },
        }

      }
      
      this.fetchAdditionalTimeSheetData()
    },
    computed:{
    ...mapGetters({
      categoryList : "categories/categoryList",
      listItemsPerPage: "common/listItemsPerPage",
      pagination: "categories/pagination",
    })
   }, 
    methods:{
       dateFormat(value)
       {
        if (value) {
        return moment(String(value)).format("HH:mm:ss DD/MM/YYYY ");
          }
       },
       async fetchAdditionalTimeSheetData() {
        await this.$store.dispatch(
            "categories/getCategories",
            {
              itemsPerPage: this.searchData.itemsPerPage,
              currentPage: this.searchData.paginate.currentPage,
            }
          );
          this.searchData.paginate = this.pagination;
        },
        checkDataParam(data) {
          return data === 0 || data === "" ? undefined : data;
        },
        passParamUrl()
        {
          this.$router.push({
            name: "category-list",
            query: {
              currentPage: this.checkDataParam(
                this.searchData.paginate.currentPage
              ),
              perPage: this.checkDataParam(this.searchData.itemsPerPage),
            },
          }).catch(() => {});
        },
        changePage(page) {
          this.passParamUrl();
          this.fetchAdditionalTimeSheetData(this.searchData.itemsPerPage, page);
      },
    }
}
</script>

<style lang="scss" scoped>
.category-product{
  width:100%;
  .table-wrapper{
  width: 90%;
  margin: 0 auto;
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



</style>
