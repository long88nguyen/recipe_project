<template>
   
    <div class="rate-product">
       
        <div class="table-wrapper">
          <div class="breadcumb-field">
            <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/dashboard">Trang chủ</router-link></a-breadcrumb-item>
            <a-breadcrumb-item><router-link to="/members">Quản lý người dùng</router-link></a-breadcrumb-item>
            </a-breadcrumb>
        </div>
        <MemberFilterVue @search="updateSearch"/>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>Mã người dùng</th>
                        <th>Tên người dùng</th>
                        <th>Ảnh đại diện</th>
                        <th>Ngày tham gia</th>
                        <th >Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, index) in listDataMember.data" :key="index">
                        <td>{{  member.id }}</td>
                        <td>{{ member.name }}</td>
                        <td><img :src="member.avatar" alt=""></td>
                        <td>{{ dateFormat(member.created_at) }} </td>
                        <td>
                          <i class="fa-solid fa-trash" style="color:red" @click="DeleteRate(member.id)"></i>
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
import moment from "moment"
import MemberFilterVue from "./filter/MemberFilter.vue";
import {  mapGetters } from 'vuex';
export default {
    components:{
        MemberFilterVue
    },
    data()
    {
        return {     
            visibleDelete:false,
            member_id :null,
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
      this.fetchDataMember()
    },
    computed:{
    ...mapGetters({
      pagination: "members/pagination",
      listDataMember: "members/listDataMember",
    }),
   
   }, 
   
   methods: {
    openModal() {
    },
    dateFormat(value) {
        if (value) {
            return moment(String(value)).format("DD/MM/YYYY ");
        }
    },
    async fetchDataMember() {
        await this.$store.dispatch(
            "members/getAllMemberAdmin",{
                name : this.searchData.name,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            }
        );
        this.searchData.paginate = this.pagination;
    },

    changePage(page) {
        this.fetchDataMember(this.searchData.itemsPerPage, page);
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
        this.fetchDataMember();
    },
    
    DeleteRate(value){
            this.visibleDelete = true;
            this.member_id = value;
    },
    DeleteSubmit()
        {
            let member_id = this.member_id;
            this.$store.dispatch("rates/deleteRate",rateId).then(() => {
                this.$toast.success('Rating deleted!')
                this.fetchRatingList()
             }
            ).catch(() => {
                this.$toast.error('error')
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
              height: 70px;
              width: 70px;
              border-radius: 35px;
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

