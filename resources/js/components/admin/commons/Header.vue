<template>
     <div class="header_layout" :class="{active:isActive}">
      <h1>Header</h1>
     </div>
</template>

<script>
export default {
    props:{
        isActive:{
            type: Boolean,
        }
    }
}
</script>

<style>
.header_layout
{
    width: calc(100% - 78px);
    margin-left:78px;
    height: 100px;
    background: rgb(206, 200, 200);
    transition: all 0.5s ease;
}
.header_layout.active {
    width: calc(100% - 240px);
    margin-left: 240px;
    height: 100px;
    background: rgb(216, 213, 213);
}
</style>
