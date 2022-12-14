<template>
    <Slider></Slider>
    <BannerFood></BannerFood>
    <StatPost/>
</template>

<script>
import BannerFood from "./commons/BannerFood.vue"
import Slider from "./commons/Slider.vue"
import StatPost from "./commons/StatPost.vue"
export default {
    components:{
        BannerFood,
        Slider,
        StatPost,
    }
}
</script>

<style lang="scss">
body{
  width: 100% !important;
  overflow: visible !important;
  height: 100%;
  background: rgb(250, 246, 243);
}
</style>