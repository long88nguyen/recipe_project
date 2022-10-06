<template>
    <div class="breadcumb-field">
         <a-breadcrumb>
         <a-breadcrumb-item><router-link to="/categories">Home</router-link></a-breadcrumb-item>
         <a-breadcrumb-item><router-link to="/categories">Categories</router-link></a-breadcrumb-item>
         <a-breadcrumb-item>Detail</a-breadcrumb-item>
         </a-breadcrumb>
     </div>
     <div class="category-product">
        <div>
            <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="category.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
        </div>
     </div>
 </template>

 <script>

import axios from 'axios';

 export default {
    data()
    {
        return{
            category:{}
        }
    },
    created()
    {
        this.getCategoryById();
    },
    methods:{
        getCategoryById(){
            axios.get(`http://localhost:8087/api/test-api/${this.$route.params.id}`)
                .then((res) => {
                    this.category = res.data.data
                });
        },
        updateProduct(){
            axios.put(`http://localhost:8087/api/test-api/${this.$route.params.id}`,this.category)
                .then((res) => {
                    this.$router.push({name:'category-list'});
                })
        }
    }
 }
 </script>

 <style>
 .breadcumb-field
     {
         background: white;
         padding:30px;
         width: 100%;
     }
     .category-product
     {
         margin:10px ;
         background: white;
         height: 80vh;

     }
 </style>
