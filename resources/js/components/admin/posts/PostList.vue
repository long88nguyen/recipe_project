<template>
    <div class="category-product">
       
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
                        <tr v-for="(category, index) in categoryList.data" :key="index">
                            <td>{{
                        (categoryList.current_page - 1) *
                        categoryList.per_page +
                            index +
                            1
                    }}</td>
                            <td>{{ category.name }}</td>
                            <td> <img :src="`uploads/category/${category.image}`" class="img-thumbnail" alt="" @click="showImage(category.image)"/></td>
                            <td>{{ dateFormat(category.created_at) }}</td>
                            <td>
                            <i class="fa-solid fa-pen-to-square" style="color:blue"></i>
                            <i class="fa-solid fa-trash" style="color:red"></i>
                            </td>
                        </tr>
                    </tbody>
                    
            </table>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
    computed:{
        ...mapGetters({
            dataPost : "posts/dataPost"
        })
    },
    created(){
        this.fetchDataPost();
    },
    methods:{
        async fetchDataPost()
        {
            await this.$store.dispatch("posts/getPosts")
        }
    }
}
</script>

<style>

</style>