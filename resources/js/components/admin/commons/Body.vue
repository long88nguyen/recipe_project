<template>
    <div class="body_layout" :class="{active:isActive}">
        <i class="fa-regular fa-bell notification" @click="openModal()"></i>
        <span class="count_noti">{{getReports.countReport}}</span>
        <router-view ></router-view>
        <a-modal 
               class="add-timesheet-modal"
               v-model:visible="visible" title="Danh sách bình luận báo cáo" 
               @ok="handleOk"
               :footer = null
               centered
               >
               <ListReport/>
        </a-modal>
    </div>
   
</template>

<script>
import { mapGetters } from 'vuex';
import ListReport from "../modal/ListReport.vue"
export default {
    components:{
        ListReport
    },
    props:{
        isActive:{
            type:Boolean
        }
    },
    data(){
        return {
            visible:false,
        }
    },
    methods:{
        openModal(){
            this.visible = true;
        },
        handleOk(){
            this.visible = false;
            this.getData();
        },
        async getData(){
            await this.$store.dispatch('comments/getReport')
        }
    },
    computed:{
       ...mapGetters({
        getReports : "comments/getReport"
       })
       
    },
    created(){
        this.getData();
    },
}
</script>

<style lang="scss" scoped>
.body_layout
{
    width: calc(100% - 78px);
    margin-left:78px;
    transition: all 0.5s ease;
    background: white;
    min-height: calc(100vh - 60px);
}
.body_layout.active {
    width: calc(100% - 240px);
    margin-left: 240px;
}

.notification{
    margin: 20px 0 0 80px;
    font-size: 40px;
    position: relative;
    
}
.ant-modal {
    width: 800px !important;
    // max-width: 800px;
  }
.count_noti{
    line-height: 20px;
    top: 20px;
    position: absolute;
    left: 340px;
    width: 20px;
    height: 20px;
    background: red;
    text-align: center;
    border-radius: 10px;
    font-size: 12px;
    color: white;
    font-weight: bold;
    }
    .add-timesheet-modal{
    .ant-modal-header {
    padding: 16px 24px;
    color: rgba(0, 0, 0, 0.65);
    background: #fff;
    border-bottom: 1px solid #e8e8e8;
    border-radius: 10px 10px 0 0;
    background-color: #d2d6ff;
    border-bottom-color: #3d4cdc;
    .ant-modal-title {
      color: #020519;
      font-weight: bold;
    }
  }
    .ant-modal-content {
    border-radius: 10px;
  }
  .ant-modal-close {
    outline: unset !important;
  }
  .ant-modal-close-x {
       line-height: 48px;
  }
  .popup_confirm-content{
    font-weight: bold;
  }
  .button_cofirm{
    margin-top:20px;
    display: flex;
    justify-content: flex-end;
    button{
        margin:0 5px;
    }
  }
   }
   /deep/ .ant-modal-content {
    position: relative;
    background-color: #fff;
    background-clip: padding-box;
    border: 0;
    border-radius: 10px;
    // box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
    pointer-events: auto;
   }

</style>
