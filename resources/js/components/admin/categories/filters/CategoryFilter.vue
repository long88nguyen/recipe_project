<template>
    <div class="category-filter">
        <input type="text" class="form-control"
        @change="search"
        v-model="name"
        v-on:keyup.enter="search"
        > 
        <button class="btn btn-success" @click.prevent = "search">Tìm kiếm </button>
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
    display: flex;
    margin-bottom: 20px;
    input{
        width:400px;
        margin-right: 20px;
    }
}
</style>