<template>
    <div class="comment_list" >
        <h3>Bình luận</h3>
        <div class="comment_input">
            <div class="img_avatar">
                <img :src="userCommon.avatar" alt="" class="avatar_img">
            </div>
            
            <input type="text" placeholder="Enter comment ..." v-model="comment" @keyup.enter="StoreComment">
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
                <!-- {{  comment.replies.length }} -->
                <span v-if = "isShowReplies == false && comment.replies.length > 0" @click="showReplies(comment.id)">{{ comment.replies.length }} Phản hồi </span>
                <span v-if = "isShowReplies && IdcommentShowReplies == comment.id" @click="hideReplies((comment.id))">Ẩn phản hồi</span>
                <i class="fa-solid fa-reply" @click="showInputReply((comment.id))"></i>
                <i class="fa-solid fa-trash" @click="deleteComment(comment.id)"></i>
            </div>

            <div v-show="isShowReplies && IdcommentShowReplies == comment.id">
                <template v-for="(replie,index) in comment.replies" :key="index">
                <div class="comment_reply" >
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
                <div class="comment_content_icon">
                    <i class="fa-solid fa-trash" @click="deleteComment(replie.id)"></i>
            </div>
            </template> 
            </div>
            
          
            <Transition name="slide-fade">
                <div class="comment_input_reply" v-show="isReplyInput  && commentId == comment.id">
                <div class="img_avatar">
                    <img :src="userCommon.avatar" alt="" class="avatar_img">
                </div>
                
                <input type="text" placeholder="Enter reply ..." v-model="commentReply" @keyup.enter="storeReply(comment.id)">
                <div class="img_send">
                    <img src="../../../uploads/send.png" alt="" class="send_img" @click="storeReply(comment.id)">
                </div>
            </div>
            </Transition>
            
        </div>
        </template>
       

       

        
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            comment:"",
            isReplyInput:false,
            commentId:null,
            commentReply:"",
            isShowReplies:false,
            IdcommentShowReplies:null,
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
                comment:this.comment,

            }).then(()=>{
                this.dataComment();
                this.comment='';
                
    
                
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi!');
            })
        },

        async storeReply(value){
            await this.$store.dispatch('comments/createReply',{
                id:value,
                comment:this.commentReply

            }).then(()=>{
                this.dataComment();
                this.commentReply='';
                this.isReplyInput = true;
                // this.isShowReplies = true;
                // this.commentId = value;
                
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi!');
            })
        },

        async deleteComment(value)
        {
            await this.$store.dispatch('comments/deleteComment',value).then(() => {
                this.$toast.success('Xóa bình luận thành công'),
                this.dataComment()
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi')
            })
        },

        showInputReply (value){
            this.commentId= value;
            this.isReplyInput = !this.isReplyInput; 
        },
        showReplies(value){
            this.commentId= value;
            this.IdcommentShowReplies = value;
            this.isShowReplies = !this.isShowReplies;
            this.isReplyInput = true;
        },
        hideReplies(){
            this.isShowReplies= false;
            this.isReplyInput = false;
        },

    }
}
</script>

<style lang="scss">
.comment_list{
    padding: 30px;
    .comment_input{
        margin-bottom:15px;
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
        margin: 5px 0;
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
            margin: 5px 0;
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
                margin:0 10px;
                font-size: 12px;
                cursor: pointer;
            }
            span{
                cursor: pointer;
            }
        }
        
    }
}

// .slide-fade-enter-active {
//   transition: all 0.3s ease-out;
// }

// .slide-fade-leave-active {
//   transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
// }

// .slide-fade-enter-from,
// .slide-fade-leave-to {
//   transform: translateX(20px);
//   opacity: 0;
// }
</style>