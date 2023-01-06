<template>
    <div class="side_user">
        <Slider></Slider>
        <ButtonCreatePostVue></ButtonCreatePostVue>
        <BannerFood></BannerFood>
        <StatPost/>
    </div>
    
</template>

<script>
import BannerFood from "./commons/BannerFood.vue"

import Slider from "./commons/Slider.vue"
import StatPost from "./commons/StatPost.vue"
import ButtonCreatePostVue from "./commons/ButtonCreatePost.vue"
export default {
    components:{
        BannerFood,
        Slider,
        StatPost,
        ButtonCreatePostVue
    }
}
</script>

<style lang="scss">
body{
  width: 100% !important;
  overflow: visible !important;
}
.side_user{
    background:#f4f9f6;
}
</style>