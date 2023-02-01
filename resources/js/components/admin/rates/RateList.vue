<template>
   
    <div class="rate-product">
       
        <div class="table-wrapper">
          <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item>Trang chủ</a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/rate-list">Đánh giá</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
        <RateFilterVue @search="updateSearch"/>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Người đánh giá</th>
                        <th>Tiêu đề</th>
                        <th>Đánh giá</th>
                        <th>Nhận xét</th>
                        <th>Thời gian</th>
                        <th >Hoạt động</th>
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
                        <td>{{ rate.post.title }}</td>
                        <td>  <star-rating 
                                v-model:rating="rate.number_rating" 
                                inactive-color="#DCDCDC"
                                active-color="#009879"
                                v-bind:star-size="20"
                                :read-only = true
                                :show-rating = false
                                :round-start-rating = false
                            /> </td>
                        <td>{{ rate.review }} </td>
                        <td>{{ dateFormat(rate.created_at) }}</td>
                        <td>
                          <i class="fa-solid fa-trash" style="color:red" @click="DeleteRate(rate.id)"></i>
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
         <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visibleDelete" 
            title="Xác nhận xóa đánh giá" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="delete_confirm">
                <h5>Bạn có muốn xóa đánh giá này không ?</h5>
            </div>

            <button class="btn btn-success text-center mt-3" @click="DeleteSubmit">Xác nhận</button>

            <button class="btn btn-danger text-center mt-3 mr-2" @click="unsubmit">Hủy</button>

          </a-modal>
        
    </div>

</template>

<script>
import StarRating from 'vue-star-rating'
import RateFilterVue from './filter/RateFilter.vue';
import moment from "moment"
import {  mapGetters } from 'vuex';
export default {
    components:{
      StarRating,
      RateFilterVue
    },
    data()
    {
        return {     
            visibleDelete:false,
            rateId :null,
            searchData: {
              post_title:"",
              member_name:"",
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
                post_title : this.searchData.post_title,
                member_name : this.searchData.member_name,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            }
        );
        this.searchData.paginate = this.pagination;
    },

    changePage(page) {
        this.fetchRatingList(this.searchData.itemsPerPage, page);
    },

   

    updateSearch(filter) {
        this.searchData = {
            ...this.searchData,
            ...filter
        };
        this.searchData.paginate.currentPage = 1;
        this.search();
    },
    async search() {
        this.fetchRatingList();
    },
    
    DeleteRate(value){
            this.visibleDelete = true;
            this.rateId = value;
    },
    DeleteSubmit()
        {
            let rateId = this.rateId;
            this.$store.dispatch("rates/deleteRate",rateId).then(() => {
                this.$toast.success('Xóa đánh giá thành công!')
                this.fetchRatingList()
             }
            ).catch(() => {
                this.$toast.error('Đã xảy ra lỗi')
            })
            this.visibleDelete = false;
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

