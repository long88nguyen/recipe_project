<template>
    <div>
        {{CategoryDetail}}
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    async created(){
        await this.$store.dispatch("categories/getCategoryDetail",this.$props.id)
    },
    props:["id"],
    computed:{
        ...mapGetters({
            CategoryDetail:"categories/categoryDetail",
        })
    }
}
</script>

<style>

</style>