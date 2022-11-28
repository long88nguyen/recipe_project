<template>
    <div class="breadcumb-field">
         <a-breadcrumb>
         <a-breadcrumb-item><router-link to="/categories">Home</router-link></a-breadcrumb-item>
         <a-breadcrumb-item><router-link to="/categories">Categories</router-link></a-breadcrumb-item>
         <a-breadcrumb-item>Create</a-breadcrumb-item>
         </a-breadcrumb>
     </div>
     <div class="category-product">
        <div>
            <form @submit.prevent="addCategory" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="category.name">
                    </div>
                    <div class="form-group">
                        <input type="file" @change ="onChange" >
                    </div>
                    <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
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
            category:{
                name:null,
                image:null,
            },
            imagePreview: null,
            showPreview: false,
        }
    },
    methods:{
        onChange(e)
        {
           this.category.image = e.target.files[0];
           let reader  = new FileReader();

            reader.addEventListener("load", function () {
            this.showPreview = true;
            this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.category.image ){

        if ( /\.(jpe?g|png|gif)$/i.test( this.category.image.name ) ) {

            console.log("here");
            reader.readAsDataURL( this.category.image );
        }
    }
        },
        async addCategory()
        {
            let formData = new FormData();
            formData.append('name', this.category.name);
            formData.append('image', this.category.image);
            await this.$store.dispatch("categories/createCategory",formData)
            .then(() =>{
                console.log(formData);
                this.$router.push({ path: "/categories" });
            })
            .catch(() => {
                console.log("errorr");
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
