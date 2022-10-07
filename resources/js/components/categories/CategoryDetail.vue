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

                    <div class="form-group">
                        <input type="file" @change ="onChange" >
                    </div>
                    <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview" v-if="showPreview"/>
                    <img :src="`/uploads/${ category.image }`" alt="" v-else>


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
                image:null
            },
            imagePreview: null,
            showPreview: false,
        }
    },
    created()
    {
        this.getCategoryById();
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
        getCategoryById(){
            axios.get(`http://localhost:8087/api/test-api/${this.$route.params.id}`)
                .then((res) => {
                    this.category = res.data.data
                });
        },
        updateProduct(){
            let formData = new FormData();

            formData.append('name', this.category.name);
            formData.append('image', this.category.image);
            axios.post(`http://localhost:8087/api/test-api/${this.$route.params.id}`,formData)
                .then((res) => {
                    this.$router.push({name:'category-list'});
                })
        }
    }
 }
 </script>

 <style lang="scss">
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
         img{
            width:100px;
         }

     }
 </style>
