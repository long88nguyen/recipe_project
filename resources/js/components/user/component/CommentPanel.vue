<template>
    <div class="comment_list">
        <h3>Comment List (12)</h3>
        <div class="comment_input">
            <div class="img_avatar">
                <img :src="userCommon.avatar" alt="" class="avatar_img">
            </div>
            
            <input type="text" placeholder="Enter comment ..." v-model="comment">
            <div class="img_send">
                <img src="../../../uploads/send.png" alt="" class="send_img" @click="StoreComment">
            </div>
            
        </div>

        <template v-for="(comment,index) in getCommentByPost" :key="index">
            <div class="comment_content">
            <div class="comment_content_sub">
                <img :src="comment.member.avatar" alt="">
                <div class="comment_desc">
                    <div class="desc_member">
                        Hello work
                    </div>
                    <div class="desc_content">
                        {{
                            comment.comment
                        }} 
                    </div>
                    
                </div>
            </div>
            <div class="comment_content_icon">
                <i class="fa-solid fa-reply"></i>
                <i class="fa-solid fa-pen-to-square"></i>
                <i class="fa-solid fa-trash"></i>
            </div>
            <template v-for="(replie,index) in comment.replies" :key="index">
                <div class="comment_reply">
                <img :src="replie.member.avatar" alt="">
                <div class="comment_desc">
                    <div class="desc_member">
                        Chicken
                    </div>
                    <div class="desc_content">
                        {{  replie.comment}}
                    </div>
                        
                    </div>
                    
                </div>
            </template>
          
            <!-- <div class="comment_input_reply">
                <div class="img_avatar">
                    <img :src="userCommon.avatar" alt="" class="avatar_img">
                </div>
                
                <input type="text">
                <div class="img_send">
                    <img src="../../../uploads/send.png" alt="" class="send_img">
                </div>
            </div> -->
        </div>
        </template>
       

       

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            comment:""
        }
    },
    computed:{
        ...mapGetters({
            getCommentByPost : 'comments/getCommentByPost',
            userCommon:'common/userCommon'
        })
    },

    created(){
        this.dataComment();
    },
    methods:{
        async dataComment(){
            await this.$store.dispatch('comments/listPostById',this.$route.params.id)
        },

        async StoreComment(){
            await this.$store.dispatch('comments/createComment',{
                id:this.$route.params.id,
                comment:this.comment

            }).then(()=>{
                this.$toast.success('Ok');
                this.dataComment();
                this.comment='';
    
                
            }).catch(()=>{
                this.$toast.error('error');
            })
        }
    }
}
</script>

<style lang="scss">
.comment_list{
    padding: 30px;
    .comment_input{
        display: flex;
        .img_avatar{
            width: 5%;
            .avatar_img{
            width: 30px;
            height: 30px;
            border-radius: 15px;
        }
        }
        input{
            width: 85%;
            height: 30px;
    border-radius: 15px;
    border: 1px solid;
    padding-left: 15px;
    outline: none;
        }
        .img_send{
            text-align: center;
            width: 10%;
            .send_img{
            width: 30px;
            height: auto;
            text-align: center;
        }
        }
       
    }
    .comment_input_reply{
        margin-top: 10px;
        margin-left: 100px;
        display: flex;
        .img_avatar{
            width: 5%;
            .avatar_img{
            width: 30px;
            height: 30px;
            border-radius: 15px;
        }
        }
        input{
            width: 85%;
            height: 30px;
            border-radius: 15px;
            border: 1px solid;
            padding-left: 15px;
            outline: none;
        }
        .img_send{
            text-align: center;
            width: 10%;
            .send_img{
            width: 30px;
            height: auto;
            text-align: center;
        }
        }
       
    }
    .comment_content{
        margin: 20px 0;
        .comment_content_sub{
            display: flex;
            img{
            margin-right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 15px;
            }
            .comment_desc{
                padding: 10px;
                background: #F4F1FA;
                border-radius: 10px;
                .desc_member{
                    color: black;
                    font-weight: bold;
                }
                .desc_content{

                }
            }
        }
        .comment_reply{
            margin: 10px 0;
            margin-left: 100px;
            display: flex;
            img{
            margin-right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 15px;
            }
            .comment_desc{
                padding: 10px;
                background: #F4F1FA;
                border-radius: 10px;
                .desc_member{
                    color: black;
                    font-weight: bold;
                }
                .desc_content{

                }
            }
        }
        .comment_content_icon{
            text-align: end;
            i{
                margin:10px 10px;
                font-size: 16px;
            }
        }
        
    }
}

</style>