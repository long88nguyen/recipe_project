<template>
<div class="profile_page">
    <div class="profile_container">
        <div class="profile_account">
            <img :src="yourMemberDetail.avatar" alt="">
            <div class="profile_account-detail">
                <h1> {{ yourMemberDetail.name }} </h1>
                <h3>{{ yourMemberEmail }}</h3>
            </div>
            
        </div>
    
        <div class="profile_tab">
        <a-tabs default-active-key="1" @change="callback">
            <a-tab-pane key="1" :tab="'Bài viết của ' + yourMemberDetail.name">
                danh sách bài viết

                <PostByMemberSelected/>
            </a-tab-pane>
            
        </a-tabs>
        </div>
    </div>
</div>
</template>

<script>
import PostByMemberSelected from "./component/PostByMemberSelected.vue"
import { mapGetters } from 'vuex';
export default {
    data() {
    return {

    };
    },
    components:{
        PostByMemberSelected
    },
    computed:{
        ...mapGetters({
        yourMemberDetail : 'members/yourMemberDetail'   ,          
        yourMemberEmail : 'members/yourMemberEmail'             
        })
    },
    created(){
    this.fecthDataMember();
    },
    methods: {
    async fecthDataMember(){
        let memberId = this.$route.params.id;
        await this.$store.dispatch('members/getYourMemberDetail',memberId).then().catch(()=>{
            this.$route.push({
                name:'Not-Found'
            })
        })
    }
    }
}   
</script>

<style lang="scss">
.profile_page{
    width: 100%;
    min-height:650px;
    background: #f4f9f6;
    padding-top:200px;
    font-family: Arial, Helvetica, sans-serif;
    .profile_container
    {
        border-radius:10px;
        background: #f4f9f6;

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
        .button_ac{
            .button_update_profile{
            margin-left: 20px;
        }
        }
        
        

    }
    
}

@media (max-width:520px)
{
    .profile_page{
        .profile_container{
            width: 96%;
            .button_update_profile{

            }
        }        
    }


}
</style>