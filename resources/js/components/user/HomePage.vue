<template>
    <Slider></Slider>
    <BannerFood></BannerFood>
    <NewPost/>
    <StatPost/>
</template>

<script>
import BannerFood from "./commons/BannerFood.vue"
import Slider from "./commons/Slider.vue"
import NewPost from "./commons/NewPost.vue"
import StatPost from "./commons/StatPost.vue"
export default {
    components:{
        BannerFood,
        Slider,
        NewPost,
        StatPost,
    }
}
</script>

<style lang="scss">
body{
  width: 100% !important;
  overflow: visible !important;
  height: 100%;
}
</style>