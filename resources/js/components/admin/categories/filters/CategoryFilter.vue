<template>
    <div class="category-filter">
        <input type="text" class="input-form"
        @change="search"
        v-model="name"
        v-on:keyup.enter="search"
        > 
        <button class="btn btn-info" @click.prevent = "search">Search</button>
    </div>
</template>

<script>
export default {
    data(){
        return {
            name:'',
        }
    },
    methods:{
        search(){
            this.$emit("search",{
                name:this.name
            })
        }
    }
}
</script>

<style lang="scss">
.category-filter{
    .input-form{
        height: 40px;
        width: 400px;
        margin: 0 20px 0 0;
        outline: none;
        border-radius:20px;
        background: none;
        border:1px solid silver;
        padding:0 0 0 20px;
    }
}
</style>