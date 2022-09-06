<template>
    <div class="body-content" :class="{ active:isActive}">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data()
   {
       return{
          isActive:true,
       }
   },
}
</script>

<style>
.body-content {
  margin-top:60px ;
  position: absolute;
  width: calc(100% - 78px);
  left:78px;
  transition: all 0.5s ease;
  overflow: hidden;
  background-color: #f1f1f1;
  height: 100%;
}
.active
{
    width: calc(100%-240px);
    left: 240px;
}
</style>
