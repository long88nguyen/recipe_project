<template>
    <nav>
        <a-row>
            <a-col :xxl="12" :xl="12" :lg="6" :md="6" :xs="6">
                <div class="nav-menu">
                <label for="logo" class="logo">DesignX</label>
                <label for="" class="checkbtn">
                    <i class="fa-solid fa-bars"></i>
                </label>
                <div class="nav_menu-list">
                    <ul>
                        <li ><a href=""  class="active">Home</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Service</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="">Feedback</a></li>
                    </ul>
                </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="12" :md="12" :xs="12">
                <div class="nav-search">
                    <form action="" class="search-bar">
                        <input type="text" placeholder="Search anything ... " @input="isActive">
                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </a-col>

            <a-col :xxl="2" :xl="2" :lg="3" :md="3" :xs="3">
                <div class="nav-account">
                    <img src="../../uploads/avatar.png" alt="" @click="toggleProfile">
                    <span> hello </span>
                    <div class="nav-account-menu" :class="{activce:isActiveVisible}">
                       
                        <ul>
                            <li><i class="fa-solid fa-address-card"></i><a href="">My Profile</a></li>
                            <li><i class="fa-solid fa-pen-to-square"></i><a href="">Edit profile</a></li>
                            <li><i class="fa-solid fa-gear"></i><a href="">Setting</a></li>
                            <li><i class="fa-solid fa-circle-info"></i><a href="">Help</a></li>
                            <li><i class="fa-solid fa-right-from-bracket"></i><a href="">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </a-col >

            <a-col :xxl="2" :xl="2" :lg="3" :md="3" :xs="3">
                <div class="nav-language">

                </div>

            </a-col>
        </a-row>
    </nav>
    <Product></Product>
</template>

<script>

import Product from "./Product.vue"
export default {
    components:{
      Product
    },
    data()
    {
        return {
          isActiveVisible : false
        }
    },
    methods:
    {
      toggleProfile()
      {

        this.isActiveVisible = !this.isActiveVisible;
        console.log(this.isActiveVisible);
      }
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

body{
    background: #EAECEE;
}

nav {
  z-index: 1;
  position: fixed;
  top:0;
  background: white;
  box-shadow: 0 0 5px 0 gray;
  height: 80px;
  width: 100%;
  .nav-menu {
    display: flex;
    label {
      color: darkblue;
      font-size: 35px;
      line-height: 80px;
      padding: 0 30px;
      font-weight: bold;
    }
    .nav_menu-list {
      width: 100%;
      text-align: center;
      ul {
        li {
          display: inline-block;
          line-height: 80px;
          margin: 0 5px;
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
    .search-bar {
      width: 100%;
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
                a{
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
      padding:10px;
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
