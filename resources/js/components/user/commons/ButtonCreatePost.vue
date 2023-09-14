<template>
    <div class="add_panel_container">
        <div class="add_panel_food">
            <router-link to="/create-post" class="btn btn-outline-secondary">Tạo mới bài viết</router-link>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.add_panel_container{
   width: 100%;
   margin: 20px 0;
    .add_panel_food
    {
        width: 70%;
        margin:0 auto;
        text-align: center;
    }
}
</style>