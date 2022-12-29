<template>
  <div class="container-layout" :class="{ layout_active: scrollEvent >= 100 }">
    <nav>
        <a-row>
            <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">             
                <div class="logo_food">
                <img src="../../uploads/images/logofood.png" alt="">
              </div>
            </a-col>
            <a-col  :xxl="12" :xl="12" :lg="12" :md="12" :xs="12">
              <div class="nav-menu">
              <div class="nav_menu-list">
                    <ul>
                        <li ><router-link to="/home-page" active-class="active" >Trang chủ</router-link></li>
                        <li><router-link to="/search-result" active-class="active">Tìm kiếm</router-link></li>
                        
                    </ul>
                </div>
              </div>
            </a-col>
            <a-col :xxl="3" :xl="3" :lg="3" :md="3" :xs="3">
                <div class="nav-account">
                    <img src="../../uploads/images/dd.jpg" alt="" @click="toggleProfile">
                    <span> {{ userCommon.name}} </span>
                    <div class="nav-account-menu" :class="{activce:isActiveVisible}">
                       
                        <ul>
                            <li><i class="fa-solid fa-address-card"></i><router-link to="/profile" @click="toggleProfile">My Profile</router-link></li>
                            <li><i class="fa-solid fa-gear"></i><span>Cài đặt</span></li>
                            <li @click="showModal"><i class="fa-solid fa-right-from-bracket"></i><span>Đăng xuất</span></li>
                        </ul>
                    </div>
                </div>
            </a-col >
            <a-col :xxl="3" :xl="3" :lg="3" :md="3" :xs="3">
                <div class="nav-language">
                </div>
            </a-col>
            <a-col :xxl="24" :xl="24" :lg="24" :md="24" :xs="24">
                 <div class="nav-search"   v-show="scrollEvent < 100">
                      <form action="" class="search-bar">
                          <input type="text" placeholder="Search anything ... " @input="isActive"
                          v-model="title"
                          >
                          <button @click.prevent="search">
                              <i class="fa-solid fa-magnifying-glass"></i>
                          </button>
                      </form>
                      <div class="nav_filter" @click="openModalFilter">
                        <img src="../../uploads/images/filter.png" alt=""> Filter
                      </div>
                  </div>
                  
            </a-col>
        </a-row>
    </nav>
          <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visible" 
            title="Xác nhận đăng xuất" 
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
    <router-view :items="getAllPost"/>
    <PostFilterModalVue 
    :visibleSearch="visibleSearch"
    @ok="closeModal"
    @cancel = "closeModal"
    @search = "filterSearch"
      />
    <Footer></Footer>
    
</template>

<script>
import { mapGetters,mapActions } from 'vuex'


import Footer from "./commons/Footer.vue"
import PostFilterModalVue from './component/search/PostFilterModal.vue'
export default {
    components:{
      Footer,
      PostFilterModalVue
    },
    data()
    {
        return {
          title:"",
          visible:false,
          isActiveVisible : false,
          scrollEvent :0,
          visibleSearch:false,
          searchData:{
            ingredient_name:"",
            member_name:"",
            category_name:"",
          }
        }
    },
    computed:{
      ...mapGetters({
        userCommon : "common/userCommon",
        getAllPost :"posts/getAllPost"
      })
    },  
    watch:{
      
    },  
    created(){
      
      window.addEventListener("scroll",this.onScroll)
      this.fetchAllPost()
    },  
    methods:
    {
      ...mapActions("auth", ["logout"]),
      toggleProfile()
      {

        this.isActiveVisible = !this.isActiveVisible;
      },
      fetchAllPost(){
        this.$store.dispatch('posts/getAllPost',{
          title:this.title,
          ingredient_name: this.searchData.ingredient_name,
          member_name: this.searchData.member_name,
          category_name: this.searchData.category_name,
        });
      },
      onScroll(e)
      {
        this.scrollEvent =window.top.scrollY;
      },
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
      search(){
        this.searchData.category_name = ""
        this.searchData.member_name = ""
        this.searchData.ingredient_name = ""
        this.fetchAllPost();
        this.$router.push({ name: "search-post" });
        this.title = null;
      },

      searching(){
        this.fetchAllPost();
        this.$router.push({ name: "search-post" });
        this.title = null;
      },
    

      openModalFilter(){
        this.visibleSearch = true;
      },

      closeModal(){
        this.visibleSearch = false;
      },

      filterSearch(filter){
        this.searchData = {
            ...this.searchData,
            ...filter
        };
        this.searching();
        this.visibleSearch = false;
      }      
    },
    SubmitValue()
    {
      console.log(12);
    }
}
</script>

<style lang="scss">
* {
  margin: 0;
  padding: 0px;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  text-decoration: none;
  list-style: none;
}


.container-layout
{
  background: white;
  z-index: 1;
  position: fixed;
  top:0;
  width: 100%;
  box-shadow: 0 0 5px 0 gray;
  height: 180px;
  nav {
  height: 100%;
  margin: 0px auto;
  width: 80%;
  label {
      color: darkblue;
      font-size: 35px;
      line-height: 80px;
      display: flex;
      justify-content: center;
      font-weight: bold;
    }
    .logo_food
    {
      width: 100%;
      height: 80px;
      display: flex;
      justify-content: center;
      align-items: center;
      img
        {
          height: 80px;
          
        }
    }

  .nav-menu {
    display: flex;
   
    .nav_menu-list {
      width: 100%;
      text-align: center;
      ul {
        padding-left: 0;
        li {
          display: inline-block;
          line-height: 80px;
          margin: 0 10px;
          a {
            color: darkcyan;
            font-size: 17px;
          }
        }
      }

      li
      {
        a:hover,a.active{
        border-bottom: 3px solid #D424A9;
        transition:0.2s ease-in-out;

      }
      }
    }

    .checkbtn {
      font-size: 30px;
      color: black;
      float: right;
      line-height: 80px;
      cursor: pointer;
      display: none;
    }
  }
  .nav-search {
    transition: 0.5s;
    width: 100%;
    display: flex;
    .search-bar {
      width: 60%;
      margin: 0 auto;
      max-width: 700;
      background: white;
      border: 2px solid #3027e6;
      display: flex;
      align-items: center;
      border-radius: 60px;
      padding: 5px 5px 5px 15px;
      margin-top: 13px;
      backdrop-filter: blur(4px) saturate(180%);
      input {
        background: transparent;
        width: 100%;
        flex: 1;
        border: 0;
        outline: none;
        padding: 5px;
        color: black;
        font-size: 14px;
      }
      ::placeholder {
        color: black;
      }
      button {
        border: none;
        right: 5px;
        border-radius: 50%;
        font-size: 20px;
        width: 40px;
        height: 40px;
        background: white;
        line-height: 40px;
        cursor: pointer;
      }
    }
    .nav_filter{
      cursor: pointer;
      width: 20%;
      text-align: start;
      display: flex;
      align-items: center;
      img{
        width: 20px;
        height: 20px;
        margin-right: 10px;
      }
    }
    .active{
      display: none;
    }
  }
  .nav-account
  {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    height: 80px;
    img{
        vertical-align: middle;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
    span
    {
        margin-left:5px;
    }
    .nav-account-menu{
        position:absolute;
        top:72px;
        background: #2E4053;
        width: 200px;
        box-sizing: 0 5px 25px rgba(0,0,0,0.1);
        border-radius: 15px;
        max-height: 0;
        transition: max-height 0.5s;
        overflow: hidden;
        z-index: 1;
        h3
        {
            widows: 100%;
            font-size:18px;
            text-align: center;
            padding:20px 0;
            font-weight: 500;
            color:#555;
            line-height: 1.2rem;
            span{
                font-size: 14px;
                color:#cecece;
                font-weight: 400;
            }
        }
        ul
        {
            padding-left: 10px;
            li{
                list-style: none;
                padding:10px;
                border-top:1px solid rgba(255,255,255,0.2);
                display: flex;
                align-items: center;
                i{
                  color: white;
                    margin-right: 10px;
                    display: flex;
                    width: 30px;
                    height: 30px;
                    justify-content: center;
                    background: red;
                    align-items: center;
                    border-radius: 50%;
                }
                span{
                    cursor: pointer;
                    display: inline-block;
                    text-decoration: none;
                    color:white;
                    font-weight: bold;
                    transition:0.5s;
                }
                span:hover{
                  transition: 0.4s;
                  border-bottom:3px solid white;
                }
                a{
                    cursor: pointer;
                    display: inline-block;
                    text-decoration: none;
                    color:white;
                    font-weight: bold;
                    transition:0.5s;
                }
                a:hover{
                  transition: 0.4s;
                  border-bottom:3px solid white;
                }
            }
            li:first-child{
              border-top: none;
            }

        }
    }
    .activce
    {
      max-height:300px;
      transition:0.5s;
    }

  }

  .nav-icon
  {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    height: 80px;
    i
    {
        font-size: 30px;
        display: none;
    }
  }
}
}
.layout_active{
  height: 80px;
}


@media (max-width: 1220px) {
  nav {
    .nav-menu {
      ul {
        display: none;
      }
    }
    .nav-icon{
        i
        {
            display: block;
        }

    }
  }
}

@media (max-width: 952px) {
  .logo {
    font-size: 30px;
    padding-left: 50px;
  }

  nav {
    ul {
      li {
        a {
          font-size: 16px;
        }
      }
    }
    .nav-account{
      .nav-account-menu{
        width: 170px;
        ul
        {
          li
          {
            i{

               font-size: 13px;
               display: flex;
                width: 25px;
                height: 25px;
                justify-content: center;
                background: red;
                align-items: center;
                border-radius: 50%;

            }
            a{
                font-weight: 400;
                font-size: 13px;

            }
            a:hover{
              transition: 0.4s;
              border-bottom:3px solid white;
            }
          }
        }
      }
    }
  }
}

@media (max-width: 858px) {
  nav {
    .checkbtn {
      display: block;
    }

    .nav_menu-list ul {
      display: none;
    }
  }
}

@media (max-width: 700px) {
  nav {
    .nav-menu {
      .logo {
        font-size: 22px;
      }
    }
    .nav-search {
      .search-bar {
        padding: 3px 0 3px 10px;
        margin-top: 20px;
        input{
            font-size: 13px;
        }
        button {
          border: none;
          right: 5px;
          border-radius: 50%;
          font-size: 15px;
          width: 30px;
          height: 30px;
          background: white;
          line-height: 30px;
          cursor: pointer;
        }
      }
    }
    .nav-account
    {
        span{
            display: none;
        }
        .nav-account-menu{
        width: 130px;
        border-radius: 10px;
        ul
        {
          padding-left:0;
          li
          {
            padding-top:5px;
            display: flex;
            i{
                margin-right:5px;
               font-size: 10px;
               display: flex;
                width: 20px;
                height: 20px;
                justify-content: center;
                background: red;
                align-items: center;
                border-radius: 50%;

            }
            a{
                font-weight: 300;
                transition:0.5s;
            font-size: 10px;

            }
            a:hover{
              transition: 0.4s;
              border-bottom:3px solid white;
            }
          }
        }
      }
    }
  }
}



</style>

<style lang="scss" scoped>
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
</style>