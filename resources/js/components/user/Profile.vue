<template>
  <div class="profile_page">
    <div class="profile_container">
        <div class="profile_account">
            <img src="../../uploads/avatar.png" alt="">
            <div class="profile_account-detail">
                <h1> {{userCommon.name}} </h1>
                <h3>@longnguyen</h3>
            </div>
            
        </div>
        <button class="btn btn-outline-primary" @click="openModal">
                Chỉnh sửa thông tin cá nhân
        </button>
        <div class="profile_tab">
        <a-tabs default-active-key="1" @change="callback">
            <a-tab-pane key="1" tab="Bài viết đã đăng">
                Bài viết đã đăng
                    <PostMine/>
            </a-tab-pane>
            <a-tab-pane key="2" tab="Bài viết đã thích" force-render>
                Bài viết đã thích
                    <PostFavourite/>
            </a-tab-pane>   
        </a-tabs>
        </div>
        <UpdateProfileModalVue :visibleProfile="visible"
                                @ok="handleEditOk"
                            @cancel="handleEditCancel"
        />
    </div>
  </div>
</template>

<script>
import PostMine from "./component/profile/PostMine.vue"
import PostFavourite from "./component/profile/PostFavourite.vue"
import UpdateProfileModalVue from "./component/profile/UpdateProfileModal.vue";
import { mapGetters } from 'vuex';
export default {
    data() {
    return {
        ModalText: 'Content of the modal',
        visible: false,
        confirmLoading: false,
    };
    },
    components:{
        PostMine,
        PostFavourite,
        UpdateProfileModalVue
    },
    computed:{
        ...mapGetters({
            userCommon:"common/userCommon",
           
        })
    },
    created(){
    },
    methods: {
    openModal()
    {
        this.visible = true
    },
    handleEditOk(){
        this.visible = false
    },
    handleEditCancel(){
        this.visible = false
    }

    }
}   
</script>

<style lang="scss">
.profile_page{
    width: 100%;
    margin-top:200px;
   font-family: Arial, Helvetica, sans-serif;
    .profile_container
    {
        border-radius:10px;
        background: white;
        width: 70%;
        margin:0 auto;
        .profile_tab{
            padding:20px;
        }
        .profile_account
        {   display: flex;
            padding:20px;
            position: relative;
            img{
                width: 80px;
                height: 80px;
                border-radius:50%;
            }
            .profile_account-detail
            {
                margin-left:20px;
                h1{
                font-size:24px;
            }
                h3{
                    font-size:16px;
                    font-weight: 200;
                }
            }
           
        }
        .profile_button{
            position: absolute;
            right: 241px;
             top: 210px;
        }
    }
    
}
</style>