<template>
    <Slider></Slider>
    <FilterPost></FilterPost>
    <BannerFood></BannerFood>
    <NewPost/>
    <StatPost/>
</template>

<script>
import BannerFood from "./commons/BannerFood.vue"
import Slider from "./commons/Slider.vue"
import FilterPost from "./commons/FilterPost.vue"
import NewPost from "./commons/NewPost.vue"
import StatPost from "./commons/StatPost.vue"
export default {
    components:{
        BannerFood,
        Slider,
        FilterPost,
        NewPost,
        StatPost,
    }
}
</script>

<style lang="scss">

</style>