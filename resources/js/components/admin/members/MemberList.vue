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
        <button class="btn btn-outline-success mb-3" @click="openModalADD">
          Thêm mới tài khoản admin
        </button>
          <table class="content-table">
                <thead>
                    <tr>
                        <th>Mã người dùng</th>
                        <th>Tên người dùng</th>
                        <th>Ảnh đại diện</th>
                        <th>Ngày tham gia</th>
                        <th>Trạng thái</th>
                        <th >Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, index) in listDataMember.data" :key="index">
                        <td>{{  member.id }}</td>
                        <td>{{ member.name }}</td>
                       
                        <td><img :src="member.avatar" alt=""></td>
                        <td>{{ dateFormat(member.created_at) }} </td>
                        <td >
                        
                          <div class="title approved" v-if = " member.user_member.is_active == 1">
                                Hoạt động
                            </div>
                            <div class="title reject" v-if = " member.user_member.is_active == 0">
                                Không hoạt động
                            </div></td>
                        <td>
                          <i class="fa-solid fa-lock" style="color:red"  v-if = " member.user_member.is_active == 1" @click="lock(member.user_id)"></i>
                          <i class="fa-solid fa-lock-open" style="color:blue" v-if = " member.user_member.is_active == 0" @click="unLock(member.user_id)"></i>
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
            v-model:visible="visibleLock" 
            title="Xác nhận khóa tài khoản" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="delete_confirm">
                <h5>Bạn có muốn khóa tài khoản này không ?</h5>
            </div>

            <button class="btn btn-success text-center mt-3" @click="lockSubmit">Xác nhận</button>

            <button class="btn btn-danger text-center mt-3 mr-2" style="margin-left:10px" >Hủy</button>

          </a-modal>

          <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visibleunLock" 
            title="Xác nhận mở khóa tài khoản" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="delete_confirm">
                <h5>Bạn có muốn mở khóa tài khoản này không ?</h5>
            </div>

            <button class="btn btn-success text-center mt-3" @click="unLockSumit">Xác nhận</button>

            <button class="btn btn-danger text-center mt-3 mr-2" style="margin-left:10px" @click="unSubmit" >Hủy</button>

          </a-modal>

          <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visibleAddnew" 
            title="Thêm mới tài khoản admin" 
            @ok="handleOk"
            :footer = null
            centered
            >
          <AddNewAdmin  @ok="handleOk"/>
          </a-modal>
        
    </div>

</template>

<script>
import moment from "moment"
import AddNewAdmin from "./components/AddNewAdmin.vue"
import MemberFilterVue from "./filter/MemberFilter.vue";
import {  mapGetters } from 'vuex';
export default {
    components:{
        MemberFilterVue,
        AddNewAdmin
    },
    data()
    {
        return {  
          UserIdLock:null,
          UserIdUnLock:null,
          visibleAddnew :false,   
          visibleunLock:false,
          visibleLock:false,
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
    openModalADD(){
      this.visibleAddnew = true;
    },
    handleOk(){
      this.visibleAddnew = false;
      this.fetchDataMember();
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
    
   lock(value){
    this.UserIdLock = value;
    this.visibleLock = true;
   },

   unLock(value)
   {
    this.UserIdUnLock=value;
    this.visibleunLock= true;
   },
   async lockSubmit(){
    let userId = this.UserIdLock;
    await this.$store.dispatch('members/lockAccount',userId).then(()=>{
      this.$toast.success("Khóa tài khoản thành công")
      this.fetchDataMember();
    this.visibleLock = false;

      this.UserIdLock = null;
    }).catch(()=>{
      this.$toast.error("Đã xảy ra lỗi!")
      
    })
   },

   async unLockSumit(){
    let userId = this.UserIdUnLock;
    await this.$store.dispatch('members/unlockAccount',userId).then(()=>{
      this.$toast.success("Mở khóa tài khoản thành công")
      this.fetchDataMember();
      this.UserId = null;
    this.visibleunLock= false;

    }).catch(()=>{
      this.$toast.error("Đã xảy ra lỗi!")
      
    })
   }
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
        text-align: center;
        td{
            padding:12px 15px;
            text-align: center;
             border:2px solid white;

          .title{
                width: 120px;
                height: 30px;
                border-radius: 15px;
                text-align: center;
                line-height: 30px;
                font-size: 12px;
                font-weight: bold; 
                font-family: Arial, Helvetica, sans-serif;          
            }
            .reject{
              color:white;

                background: red;
            }
            .approved
            {
                background: #009879;
                color:white;
            }
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

