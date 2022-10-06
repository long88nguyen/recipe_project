<template>
    <div class="body_layout" :class="{active:isActive}">
        <router-view ></router-view>
    </div>
</template>

<script>
export default {
    props:{
        isActive:{
            type:Boolean
        }
    }
}
</script>

<style>
.body_layout
{
    width: calc(100% - 78px);
    margin-left:78px;
    height: 2000px;
    transition: all 0.5s ease;
}
.body_layout.active {
    width: calc(100% - 240px);
    margin-left: 240px;
    height: 2000px;

}
</style>
