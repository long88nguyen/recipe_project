<template>
    <div class="profile_page">
      <div class="profile_container">
          <div class="profile_account">
              <img :src="userCommon.avatar" alt="">
              <div class="profile_account-detail">
                  <h1> {{userCommon.name}} </h1>
              </div>
              
          </div>
          <button class="btn btn-outline-primary" @click="openModal">
                  Nhắn tin
          </button>
         
      </div>
    </div>
  </template>
  
  <script>

  import { mapGetters } from 'vuex';
  export default {
      data() {
      return {
          ModalText: 'Content of the modal',
          visible: false,
          confirmLoading: false,
          memberId : null,
      };
      },
      components:{
         
      },
      computed:{
          ...mapGetters({
              userCommon:"common/userCommon",
             
          })
      },
      created(){
      },
      methods: {
      openModal()
      {
          this.visible = true
          this.memberId = this.userCommon.id
      },
      handleEditOk(){
          this.visible = false
      },
      handleEditCancel(){
          this.visible = false
      }
  
      }
  }   
  </script>
  
  <style lang="scss" scoped>
  .profile_page{
      width: 100%;
      margin-top:200px;
     font-family: Arial, Helvetica, sans-serif;
      .profile_container
      {
          border-radius:10px;
          background: white;
          width: 70%;
          margin:0 auto;
          .profile_tab{
              padding:20px;
          }
          .profile_account
          {   display: flex;
              padding:20px;
              position: relative;
              img{
                  width: 80px;
                  height: 80px;
                  border-radius:50%;
              }
              .profile_account-detail
              {
                  margin-left:20px;
                  h1{
                  font-size:24px;
              }
                  h3{
                      font-size:16px;
                      font-weight: 200;
                  }
              }
             
          }
          .profile_button{
              position: absolute;
              right: 241px;
               top: 210px;
          }
      }
      
  }
  </style>