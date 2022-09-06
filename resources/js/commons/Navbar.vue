<template>
    <div class="sidebar" :class="{active:isActive}">
       <div class="logo_content">
           <div class="logo">
               <i class="bx bxl-c-plus-plus"></i>
               <div class="logo-name">
                   CodingLab
               </div>
           </div>
           <i class="bx bx-menu" id="btn" v-on:click="ToggleNavbar" ></i>
       </div>
       <ul class="nav_list">
           <li>
                   <i class="bx bx-search"></i>
                  <input type="text" name="" placeholder="Search..">
           </li>
           <li>
               <router-link to="/categories"  active-class="active-router" class="router-class">
                   <i class='bx bxs-user-circle'></i>
                   <span class="links_name">Categories</span>
               </router-link>
                   <span class="tooltip">Categories</span>
           </li>
           <li>
               <router-link to="/products" active-class="active-router" class="router-class">
                   <i class='bx bxs-message-dots'></i>
                   <span class="links_name">Product</span>
               </router-link>
                   <span class="tooltip">Product</span>
           </li>
       </ul>
       <div class="profile_content">
           <div class="profile">
               <div class="profile_details">
                   <img src="../uploads/images/dd.jpg" alt="">
                   <div class="name_job">
                       <div class="name">
                           Prem Shahi
                       </div>
                       <div class="job">
                           Web Designer
                       </div>
                   </div>
               </div>
               <i class="bx bx-log-out" id="log_out">

               </i>
           </div>
       </div>

   </div>
</template>

<script>
export default {
   data()
   {
       return{
          isActive:true,
          scrollPosition:null,
       }
   },
   methods:{
       ToggleNavbar()
       {
           this.isActive = !this.isActive
       },
       updateScroll()
       {
       this.scrollPosition = window.scrollY
       }
   },
   mounted() {
       window.addEventListener('scroll', this.updateScroll);
   }
   }
</script>

<style scoped>
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
       background: #11101d;
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
   }

   .sidebar ul li {
       position: relative;
       height: 50px;
       width: 100%;
       margin:0 5px;
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
       bottom: 0;
       left: 0;
       width: 100%;
   }

   .sidebar .profile_content .profile{
       position: relative;
       padding: 10px 6px;
       height: 60px;
       background: #1d1b31;
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
</style>
0
