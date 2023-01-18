<template>
    <div class="side_user">
        <Slider></Slider>
        <ButtonCreatePostVue></ButtonCreatePostVue>
        <BannerFood>

        </BannerFood>
        <Community/>
        <StatPost/>

    </div>
    
</template>

<script>
import BannerFood from "./commons/BannerFood.vue"

import Slider from "./commons/Slider.vue"
import StatPost from "./commons/StatPost.vue"
import ButtonCreatePostVue from "./commons/ButtonCreatePost.vue"
import Community from "./commons/Community.vue"
import store from "../../store"
// import { mapGetters } from 'vuex'
export default {
    components:{
        BannerFood,
        Slider,
        StatPost,
        ButtonCreatePostVue,
        Community
    },
    created()
    {
        // console.log(store.getters["auth/accountInfo"]);
    },
//    computed:{
    // ...mapGetters({
    //     accountInfo : "auth/accountInfo"
    // })
//    }
}
</script>

<style lang="scss">
body{
  width: 100% !important;
  overflow: visible !important;
}

</style>