<template>
    <div class="sidebar" :class="{active:isActive}">
       <div class="logo_content">
           <div class="logo">
               <i class="bx bxl-c-plus-plus"></i>
               <div class="logo-name">
                   CodingLab
               </div>
           </div>
           <i class="bx bx-menu" id="btn" v-on:click="$emit('ToggleNavbar')" ></i>
       </div>
       <ul class="nav_list">
        <li>
               <router-link to="/dashboard" class="router-class"
               :class="
                  url.includes('dashboard') ? 'active-router' : ''
                "
               >
               <i class="fa-solid fa-chart-line"></i>
                   <span class="links_name">Trang chủ</span>
               </router-link>
                   
           </li>
           <li>
               <router-link to="/categories" class="router-class"
               :class="
                  url.includes('categories') ? 'active-router' : ''
                "
               >
               <i class="fa-solid fa-list"></i>
                   <span class="links_name">Quản lý danh mục</span>
               </router-link>
                  
           </li>
           <li>
               <router-link to="" class="router-class">
                <i class="fa-solid fa-signs-post"></i>
                   <span class="links_name">Quản lý bài viết</span>
               </router-link>
                  
           </li>
           <li>
               <router-link to="" class="router-class">
                <i class="fa-solid fa-image"></i>
                   <span class="links_name">Quản lý hình ảnh</span>
               </router-link>
                   
           </li>
           <li>
               <router-link to="" class="router-class">
                <i class="fa-solid fa-user"></i>
                   <span class="links_name">Quản lý người dùng</span>
               </router-link>
                  
           </li>
           <li>
               <router-link to="" class="router-class">
                <i class="fa-solid fa-star"></i>
                   <span class="links_name">Quản lý đánh giá</span>
               </router-link>
           </li>
       </ul>
       <div class="profile_content">
           <div class="profile">
               <div class="profile_details">
                   <img src="../../../uploads/avatar.png" alt="">
                   <div class="name_job">
                       <div class="name">
                           {{ memberInfo.name }}
                       </div>
                       <div class="job">
                       </div>
                   </div>
               </div>
               <i class="bx bx-log-out log_out_button" id="log_out" @click="showModal">

               </i>
               <a-modal 
               class="add-timesheet-modal"
               v-model:visible="visible" title="Xác nhận đăng xuất" 
               @ok="handleOk"
               :footer = null
               centered
               >
                    <span class="popup_confirm-content">
                        Bạn có muốn đăng xuất không ?
                    </span>
                    <div class="button_cofirm">
                     <button class="btn btn-primary"   @click.prevent="logoutHandler()">Xác nhận</button>
                     <button class="btn btn-danger" @click="cancelPopup">Hủy</button>

                    </div>
                </a-modal>
           </div>
       </div>

   </div>
</template>

<script>
import { mapGetters,mapActions } from 'vuex';
export default {
   data()
   {
       return{
        url:"",
        ModalText: 'Content of the modal',
        visible: false,
        confirmLoading: false,
       }
   },
   props:{
        isActive:{
            type:Boolean
        },
   },
   computed:{
    ...mapGetters({
        memberInfo : "common/userCommon"
    }),

    ...mapActions("auth", ["logout"]),
   },   
   methods:{
    showModal() {
      this.visible = true;
    },
    handleOk(e) {
      console.log(e);
      this.visible = false;
    }, 
    cancelPopup()
    {
        this.visible = !this.visible;
    },
    logoutHandler() {
      this.$store.dispatch("auth/logout").then(() => {
        
        this.$router.push({ name: "Login" });
      });
    },
   },
   created()
   {
    let url = this.$route.path;
    this.url=url;
   },
   watch: {
    $route(to) {
      let item = document.querySelector("a[href='" + to.path + "']");
      if (item) {
        item.classList.toggle("c-active");
        this.url = to.path;
      }
     },
    }
}
</script>

<style lang="scss">
   *
   {
       margin: 0;
       padding:0;
       box-sizing: border-box;
       font-family: 'Poppins', sans-serif;
   }
   body{
       position:relative;
       height: 3000px;
       background: gray;
       width: 100%;
       overflow: hidden;
   }
   .sidebar
   {
       position:fixed;
       top: 0;
       left:0;
       height: 100%;
       width:78px;
       background: #014f46;
       padding:6px 14px;
       transition: all 0.5s ease;
   }

   .sidebar.active {
       width: 240px;
   }
   .sidebar .logo_content .logo{
       color:#FFF;
       display: flex;
       height: 50px;
       width: 100%;
       align-items: center;
       opacity: 0;
       pointer-events: none;
       transition: all 0.5s ease;
   }

   .sidebar.active .logo_content .logo
   {
       opacity: 1;
       pointer-events: none;
   }
   .logo_content .logo i {
       font-size: 28px;
       margin-right:5px ;
   }
   .logo_content .logo .logo_name
   {
       font-size:20px;
       font-weight:bold;
   }

   .sidebar #btn {
       position: absolute;
       color:#fff;
       left:50%;
       top:6px;
       font-size:20px;
       height:50px;
       width: 50px;
       text-align: center;
       line-height: 50px;
       transform: translateX(-50%);
   }

   .sidebar.active #btn{
       left:90%;

   }
   .sidebar ul{
       margin-top: 20px;
       padding-left: 0px !important;
   }

   .sidebar ul li {
       position: relative;
       height: 50px;
       width: 100%;
       margin:10px 5px;
       list-style: none;
       line-height: 50px;
   }

   .sidebar ul li .router-class
   {
       color: #ffff;
       display: flex;
       align-items: center;
       text-decoration: none;
       transition: all 0.4s ease;
       border-radius: 12px;
       white-space: nowrap;
   }

   .sidebar ul li .router-class:hover
   {
       color:#11101d;
       background-color: white;
   }

   .active-router
   {
       color:#11101d !important;
       background-color: white;
   }

   .sidebar ul li i
   {
       height: 50px;
       min-width:50px;
       border-radius: 12px;
       line-height: 50px;
       text-align: center;
   }

   .sidebar ul li input
   {
       position: absolute;
       height: 100%;
       width: 100%;
       left: 0;
       border-radius: 12px;
       outline: none;
       border:none;
       background-color: #1d1b31;
       padding-left: 50px;
       font-size:18px;
       color:#fff;
   }

   .sidebar ul li .bx-search{
       position: absolute;
       z-index:99;
       color:white;
       font-size: 22px;
       transition: all 0.5 ease;
   }

   .sidebar ul li .bx-search:hover{
       background-color: #fff;
       color:#1d1b31;
   }

   .sidebar .profile_content {
       position: absolute;
       color: white;
       background: #03053b;
       bottom: 0;
       left: 0;
       width: 100%;
   }

   .log_out_button:hover
   {
    cursor: pointer;
   }

   .sidebar .profile_content .profile{
       position: relative;
       padding: 10px 6px;
       height: 60px;
       transition: all 0.5 ease;
   }
   .profile_content .profile .profile_details
   {
       display: flex;
       align-items: center;
       opacity: 0;
       pointer-events: none;
       white-space: nowrap;
   }

   .profile .profile_details img{
       height: 45px;
       width: 45px;
       object-fit: cover;
       border-radius:12px;

   }

   .profile .profile_details .name_job{
       margin-left: 10px;
   }

   .profile .profile_details .name
   {
       font-size:15px;
       font-weight: 400;
   }

   .profile .profile_details .name_job{
       font-size:12px;
   }

   .profile #log_out {
       position: absolute;
       left: 50%;
       bottom: 5px;
       transform: translateX(-50%);
       min-width: 50px;
       line-height: 50px;
       font-size: 20px;
       border-radius: 12px ;
       text-align: center;
       transition: all 0.4s ease;
       left: #1d1b31;
   }

   .sidebar.active .profile #log_out
   {
       left: 88% ;
   }

   .sidebar.active .profile #log_out
   {
       left: none;
   }
   .home_content{
       position: absolute;
       height: 100%;
       width: calc(100% - 78px);
       left:78px;
       transition: all 0.5s ease;
   }
   .home_content .text {
       font-size:25px;
       font-weight: 500;
       color:#1d1b31;
       margin:12px;
   }

   .sidebar ul li .tooltip
   {
       position: absolute;
       left: 122px;
       top:50%;
       transform: translateY(-50%,-50%);
       height: 35px;
       width: 122px;
       background-color: white;
       box-shadow: 0 5px 10px rgba(0,0,0,0.2);
       border-radius:6px;
       line-height: 35px;
       text-align: center;
       transition: 0s;
       opacity: 0;
       pointer-events: none;
   }

   .sidebar.active ul li .tooltip
   {
       display: none;
   }
   .sidebar ul li:hover .tooltip{
       top:50%;
       opacity: 1;
       transition: all 0.5s ease;
   }
   .sidebar .links_name
   {
       opacity: 0;
       pointer-events: none;
   }
   .sidebar.active .links_name{
       opacity: 1;
       pointer-events: auto;
   }

   .sidebar.active .profile .profile_details
   {
       opacity: 1;
       pointer-events: auto;
   }

   .sidebar.active ~ .home_content
   {
       width: calc(100%-240px);
       left: 240px;

   }

   .sidebar.active .profile_content .profile {
       background: none;
   }
   .add-timesheet-modal{
    .ant-modal-header {
    padding: 16px 24px;
    color: rgba(0, 0, 0, 0.65);
    background: #fff;
    border-bottom: 1px solid #e8e8e8;
    border-radius: 10px 10px 0 0;
    background-color: #d2d6ff;
    border-bottom-color: #3d4cdc;
    .ant-modal-title {
      color: #020519;
      font-weight: bold;
    }
  }.ant-modal {
    width: 100% !important;
    max-width: 684px;
  }
    .ant-modal-content {
    border-radius: 10px;
  }
  .ant-modal-close {
    outline: unset !important;
  }
  .ant-modal-close-x {
       line-height: 48px;
  }
  .popup_confirm-content{
    font-weight: bold;
  }
  .button_cofirm{
    margin-top:20px;
    display: flex;
    justify-content: flex-end;
    button{
        margin:0 5px;
    }
  }
   }
   /deep/ .ant-modal-content {
    position: relative;
    background-color: #fff;
    background-clip: padding-box;
    border: 0;
    border-radius: 10px;
    // box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
    pointer-events: auto;
   }
</style>

