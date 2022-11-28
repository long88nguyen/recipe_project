<template>
   <div class="breadcumb-field">
        <a-breadcrumb>
        <a-breadcrumb-item><router-link to="/categories">Home</router-link></a-breadcrumb-item>
        <a-breadcrumb-item><router-link to="/categories">Categories</router-link></a-breadcrumb-item>
        </a-breadcrumb>
    </div>
    <div class="category-product">
        <router-link to="/categories/create">
        <div class="btn btn-primary">

            <span> Thêm mới danh mục</span>
        </div>
        </router-link>
        <div class="table-wrapper">
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
                    <tr v-for="category in categoryList" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td> <img :src="`uploads/category/${category.image}`" class="img-thumbnail" alt=""/></td>
                        <td>{{ category.created_at }}</td>
                        <td><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-trash"></i></td>
                    </tr>
                </tbody>
          </table>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';

export default {
    data()
    {
        return {
            categories:[],
    
             visible: false,
        }
    },

    created()
    {
    
      this.getCategoriesList()
    },
    computed:{
    ...mapGetters({
      categoryList : "categories/categoryList"
    })
   }, 
    methods:{
       async getCategoriesList()
       {
          await this.$store.dispatch("categories/getCategories")
       },
    }
}
</script>

<style lang="scss" >

.content-table{
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 15px;
  width: 100%; 
  border-radius: 5px 5px 0 0 ;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.15);
  thead{
    tr{
        background-color: #009879;
        color:#ffffff;
        text-align: left;
        font-weight: bold;
        th{
            padding:12px 15px
        }
    }
  } 
  tbody{
    tr{
        border-bottom : 1px solid #dddddd;
        td{
            padding:12px 15px;
            img{
              height: 60px;
              width: 60px;
            }
            i{
              font-size:20px;
              margin: 0px 10px ;
              padding:10px;
              background: gray;
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

</style>
