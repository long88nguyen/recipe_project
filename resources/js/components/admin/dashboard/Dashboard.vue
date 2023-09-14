<template>
  <div class="dashboard_stat">
    <a-row>
     
        <a-col :xxl="12" :xl="12" :lg="24" :md = "24" :xs ="24" class="ok">
          <div class="dashboard_layout">
            <PostAMonth/>
            </div>
        </a-col>

        <a-col :xxl="12" :xl="12" :lg="24" :md = "24" :xs ="24" class="ok">
          <div class="dashboard_layout">
            <StatRatePost/>
            </div>
        </a-col>
<!-- 
        <a-col :xxl="12" :xl="12" :lg="24" :md = "24" :xs ="24" class="ok">
          <div class="dashboard_layout">
            <PostAMonth/>
            </div>
        </a-col>

        <a-col :xxl="12" :xl="12" :lg="24" :md = "24" :xs ="24" class="ok">
          <div class="dashboard_layout">
            <MemberJoinAMonth/>
            </div>
        </a-col>
      -->
   
     
      
    </a-row>
  </div>
</template>

<script>
import StatRatePost from "./components/StatRatePost.vue"
import MemberJoinAMonth from "./components/MemberJoinAMonth.vue"
import PostAMonth from "./components/PostAMonth.vue"
export default {
  components:{
    StatRatePost,
    MemberJoinAMonth,
    PostAMonth
  }
}
</script>

<style lang="scss">
.dashboard_stat{
  background: rgb(233, 232, 232);
  .ok{
    padding: 10px;
    height: 600px;
    .dashboard_layout{
    background: white;
      height: 100%;
    width: 100%;
  }
}
}
</style>