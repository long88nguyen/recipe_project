<template>
   
    <div class="rate-product">
       
        <div class="table-wrapper">
          <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/dashboard">Home</router-link></a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/rate-list">Rating</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Post title</th>
                        <th>Number Rating</th>
                        <th>Review</th>
                        <th>Created at</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(rate, index) in getAllRate.data" :key="index">
                        <td>{{
                      (getAllRate.current_page - 1) *
                      getAllRate.per_page +
                        index +
                        1
                  }}</td>
                        <td>{{ rate.member.name }}</td>
                        <td>{{ rate.post_id }}</td>
                        <td>{{ rate.number_rating }} </td>
                        <td>{{ rate.review }} </td>
                        <td>{{ dateFormat(rate.created_at) }}</td>
                        <td>
                          <i class="fa-solid fa-trash" style="color:red"></i>
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
         />

        
    </div>

</template>

<script>

import moment from "moment"
import {  mapGetters } from 'vuex';
export default {
    components:{
    },
    data()
    {
        return {           
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
      this.fetchRatingList()
    },
    computed:{
    ...mapGetters({
      pagination: "rates/pagination",
      getAllRate: "rates/getAllRate",
    }),
   
   }, 
   
   methods: {
    openModal() {
    },
    dateFormat(value) {
        if (value) {
            return moment(String(value)).format("HH:mm:ss DD/MM/YYYY ");
        }
    },
    async fetchRatingList() {
        await this.$store.dispatch(
            "rates/getAllRateAdmin",{
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
            name: "rates-list",
        }).catch(() => {});
    },
    changePage(page) {
        console.log(page);
        this.fetchRatingList(this.searchData.itemsPerPage, page);
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
        if (this.$route.fullPath !== "/rates") {
            this.clearParamUrl();

        }
        this.fetchRatingList();
    },
    clearParamUrl() {
        return;
    },
   
  },   
}
</script>

<style lang="scss" scoped>
.rate-product{
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

