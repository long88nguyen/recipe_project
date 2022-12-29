<template>
 <a-modal 
    class="add-timesheet-modal"
        v-model:visible="visibleProfile" 
        :footer = null
        centered
        title="Thêm mới danh mục" 
        @ok="handleOk" @cancel="handleCancel" :destroyOnClose="true"
        >
            <UpdateProfileModalVue
                :id ="id"
                @cancel="handleFormCancel" @ok="handleFormOk"             
            ></UpdateProfileModalVue>
    </a-modal>  
</template>

<script>
import UpdateProfileModalVue from "./UpdateProfileModal.vue"
export default {
    components:{
        UpdateProfileModalVue
    },
    data(){
        return{
        }
    },
    created(){
    },  
    computed:{
       
    },
    props:{
        visibleProfile:{
            type:Boolean,
            default:false,
        },

        id:{
            type:Number,
            default:null,
        }
    },
    methods: {
        handleOk() {
            this.$emit('ok');
        },
        handleCancel(e) {
            this.$emit('cancel', e);
        },
        handleFormCancel(e) {
            this.handleCancel(e);
        },
        handleFormOk(e) {
            this.handleOk(e);
        }
    }
}
</script>

<style lang="scss" scoped>
.form_input-category{
    padding:20px;
    .form-image-cate{
        .show-image{
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .show-image-upload{
                background: silver;
                width: 100px;
                height: 30px;
                text-align: center;
                line-height: 30px;
                border-radius: 15px;
                color: black;
            }
            .show-image-upload:hover{
                background: rgb(182, 180, 180);
                transition: 0.5s;
        }
        }
    }
}
</style>

<style lang="scss" scoped>
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
  }.ant-modal {
    width: 100% !important;
    max-width: 684px;
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
</style>