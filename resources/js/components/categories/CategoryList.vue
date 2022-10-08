<template>
   <div class="breadcumb-field">
        <a-breadcrumb>
        <a-breadcrumb-item><router-link to="/categories">Home</router-link></a-breadcrumb-item>
        <a-breadcrumb-item><router-link to="/categories">Categories</router-link></a-breadcrumb-item>
        </a-breadcrumb>
    </div>
    <div class="category-product">
        <router-link to="/categories/create">
        <div class="btn-switch-link">

            <span> Thêm đơn OT</span>
        </div>
        </router-link>
        <div class="table-wrapper">
            <table class="table-content">
                <thead class="table-header">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Deleted at</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                        <tr v-for="category in categories" :key="category.id">
                            <td>{{ category.id }}</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.created_at }}</td>
                            <td>{{ category.updated_at }}</td>
                            <td>
                                <img :src="`uploads/${category.image}`" alt=""/>
                            </td>
                            <td >
                               <router-link  :to="{name:'category-detail',params:{id: category.id}}" class="btn btn-outline-primary">edit</router-link>
                               <button class="btn btn-outline-danger" @click="deleteCategory(category.id)">delete</button>
                            </td>
                        </tr>
                </tbody>

            </table>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    data()
    {
        return {
            categories:[]
        }
    },

    created()
    {
        this.getCategoryList();
    }
    ,
    methods:{
        getCategoryList()
        {

            axios
            .get('https://heroku5012.herokuapp.com/api/test-api')
            .then(response => {
                this.categories = response.data.data
            });
        },
        deleteCategory(id)
        {
            axios.delete(`https://heroku5012.herokuapp.com/api/test-api/${id}` )
                 .then(response => {
                    let i = this.categories.map(data => data.id ).indexOf(id);
                    this.categories.splice(i, 1);
                 });
        }
    }
}
</script>

<style lang="scss" scoped>
.btn-switch-link {
    cursor: pointer;
    padding: 11px 0;
    text-align: center;
    background: #ececec;
    width: 210px;
    border-radius: 10px;
    margin-bottom:10px ;
    span {
        font-weight: 700;
        font-size: 14px;
        line-height: 17px;
        color: #3d4cdc;
    }
}
.table-content {
  min-width: 1130px;
  width: 100%;
  min-height: 170px;
  .table-header {
    tr {
      border: 2px solid #fff;
      box-shadow: 10px gray;
      th {
        border:2px solid #fff;
        padding: 15px 0px;
        min-width: 100px;
        background-color: #024457;
        border-right: 1px solid #fff;
        color: #fff;
        text-align: center;
      }
    }
  }
  .table-body {
    tr {
     height: 70px;
     box-shadow: 10px gray;
      td {
        padding: 15px 0px;
        border: 3px solid #fff;
        text-align: -webkit-center;
        img{
            width: 100px;
        }
      }
    }
    tr:nth-child(2n-1)
      {
        padding: 15px 0px;
        border: 1px solid #efefef;
        background:#D9E4E6
      }
      tr:hover{
        background: #afe3ec;
      }
  }
  .table-empty {
    position: absolute;
    left: 45%;
    bottom: 50px;
    opacity: 0.6;
  }
}

.button-group
{
    display: flex;
}
</style>
