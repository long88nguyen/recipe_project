<template>
    <div class="comment_list" >
        <h4>Bình luận</h4>
        <div class="comment_input">
            <div class="img_avatar">
                <img :src="userCommon.avatar" alt="" class="avatar_img">
            </div>
            
            <input type="text" placeholder="Nhập bình luận ..." v-model="comment" @keyup.enter="StoreComment" @blur="reset()">
           
            <!-- <div class="img_send">
                <img src="../../../uploads/send.png" alt="" class="send_img" @click="StoreComment">
            </div> -->
            
        </div>
        <div class="validate">{{ 
                errMessage
            }}</div>

        <template v-for="(comment,index) in getCommentByPost.data" :key="index">
            <div class="comment_content">
            <div class="comment_content_sub">
                <img :src="comment.member.avatar" alt="">
                <div class="comment_desc">
                    <div class="desc_member">
                        {{comment.member.name}}
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
                <span  class="hide_show_text" v-if = "isShowReplies == false && comment.replies.length > 0" @click="showReplies(comment.id)">{{ comment.replies.length }} Phản hồi </span>
                <span  class="hide_show_text" v-if = "isShowReplies && IdcommentShowReplies == comment.id" @click="hideReplies((comment.id))">Ẩn phản hồi</span>
                <span class="reply_text" @click="showInputReply((comment.id))">Phản hồi</span>
                <span class="delele_text" @click="deleteComment(comment.id)" v-if="userCommon.id == comment.member.id || userCommon.user_member.is_admin == 1">Xóa</span>
                <span class="report_text" @click="reportComment(comment.id)">Báo cáo</span>
                <span class="duration_text" v-if = "comment.duration > 86400"> {{ Math.round(comment.duration/86400) }} ngày</span> 
                <span class="duration_text" v-else-if = "comment.duration < 86400 && comment.duration > 3600"> {{ Math.round(comment.duration/3600) }} giờ</span> 
                <span class="duration_text" v-else-if = "comment.duration < 3600 && comment.duration > 60"> {{ Math.round(comment.duration/60) }} phút</span> 
                <span class="duration_text" v-else-if = "comment.duration < 60"> Vừa xong</span> 
                
            </div>
            <div v-show="isShowReplies && IdcommentShowReplies == comment.id">
                <template v-for="(replie,index) in comment.replies" :key="index">
                <div class="comment_reply" >
                <img :src="replie.member.avatar" alt="">
                <div class="comment_desc">
                    <div class="desc_member">
                        {{ replie.member.name }}
                    </div>
                    <div class="desc_content">
                        {{  replie.comment}}
                    </div>
                        
                    </div>
                    
                </div>
                <div class="comment_content_icon_reply">
                    <span class="delele_text" @click="deleteComment(replie.id)" v-if="userCommon.id == replie.member.id || userCommon.user_member.is_admin == 1">Xóa</span>
                    <span class="report_text">Báo cáo</span>
                    <span class="duration_text" v-if = "replie.duration > 86400"> {{ Math.round(replie.duration/86400) }} ngày</span> 
                    <span class="duration_text" v-else-if = "replie.duration < 86400 && replie.duration > 3600"> {{ Math.round(replie.duration/3600) }} giờ</span> 
                    <span class="duration_text" v-else-if = "replie.duration < 3600 && replie.duration > 60"> {{ Math.round(replie.duration/60) }} phút</span> 
                    <span class="duration_text" v-else-if = "replie.duration < 60"> Vừa xong</span> 
                   
            </div>
            </template> 
            </div>
            
          
            <Transition name="slide-fade">
                <div class="comment_input_reply" v-show="isReplyInput  && commentId == comment.id">
                <div class="img_avatar">
                    <img :src="userCommon.avatar" alt="" class="avatar_img">
                </div>
                
                <input type="text" placeholder="Nhập câu trả lời ..." v-model="commentReply" @keyup.enter="storeReply(comment.id)" @blur="reset()">
                <!-- <div class="img_send">
                    <img src="../../../uploads/send.png" alt="" class="send_img" @click="storeReply(comment.id)">
                </div> -->
            </div>
            
            </Transition>
            <!-- <div class="validate_reply">{{ 
                errMessageReply
            }}</div> -->
        </div>
        </template>
       
        
        <a-pagination 
        class="paginate"
        v-model:current="searchData.paginate.currentPage" 
        :total="searchData.paginate.totalRecord" 
        :page-size="Number(searchData.paginate.perPage)" 
        @change = "changePage"
        show-less-items />

        <a-modal 
               class="add-timesheet-modal"
               v-model:visible="visible" title="Báo cáo bình luận" 
               @ok="handleOk"
               :footer = null
               centered
               >
             <h5>Bạn có muốn báo cáo bình luận này không ?</h5>

             <button class="btn btn-primary" @click="confirmReport">Xác nhận</button>
             <button class="btn btn-danger" @click="handleOk" style="margin-left:10px">Hủy</button>
               
        </a-modal>
        
    </div>

</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            visible:false,
            commentId:null,
            comment:"",
            errMessage:'',
            errMessageReply:'',
            isReplyInput:false,
            commentId:null,
            commentReply:"",
            isShowReplies:false,
            IdcommentShowReplies:null,
            searchData: {
              name:"",
              itemsPerPage:5,
              paginate: {
                from: 0,
                to: 0,
                totalPage: 0,
                path: "",
                currentPage: 1,
                totalRecord: 0,
                perPage: 0,
            },
          },
        }
    },
    computed:{
        ...mapGetters({
            getCommentByPost : 'comments/getCommentByPost',
            userCommon:'common/userCommon',
            listItemsPerPage: "common/listItemsPerPage",
            pagination: "comments/pagination",
        })
    },

    created(){
        this.dataComment();
    },
   
    methods:{
        reset(){
            this.errMessageReply = '',
            this.errMessage = '';
        },
        validateReply(){
            this.errMessageReply = '';
            let isValid = true;
            if(!this.commentReply)
            {
                this.errMessageReply = "Vui lòng nhập bình luận của bạn",
                isValid = false;
            }
            if(this.commentReply.length > 255)
            {
                this.errMessageReply = "Bình luận của bạn quá dài (tối đa 255 ký tự)",
                isValid = false;
            }
            return isValid;
        },
        validate(){
            this.errMessage = '';
            let isValid = true;
            if(!this.comment)
            {
                this.errMessage = "Vui lòng nhập bình luận của bạn",
                isValid = false;
            }
            if(this.comment.length > 255)
            {
                this.errMessage = "Bình luận của bạn quá dài (tối đa 255 ký tự)",
                isValid = false;
            }
            return isValid;
        },
        async dataComment(){
            await this.$store.dispatch('comments/listPostById',{
                id:this.$route.params.id,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            })
            this.searchData.paginate = this.pagination;

        },

        async StoreComment(){
            if(this.validate())
            {
                await this.$store.dispatch('comments/createComment',{
                id:this.$route.params.id,
                comment:this.comment,

                }).then(()=>{
                    this.dataComment();
                    this.comment='';
                    
        
                    
                }).catch(()=>{
                    this.$toast.error('Đã xảy ra lỗi!');
                })
            }
          
        },

        async confirmReport(){
            await this.$store.dispatch('comments/report',this.commentId).then(()=>{
                this.dataComment();
                this.commentId=null;
                this.$toast.success('Báo cáo bình luận thành công!');
                this.visible = false;
                
    
                
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi!');
            })
        },

        reportComment(value){
            this.commentId = value;
            this.visible = true;
        },

        handleOk(){
            this.commentId = null;
            this.visible = false;
        },

        async storeReply(value){
            if(this.validateReply())
            {
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
            }
           
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
        changePage(page) {
        this.dataComment(this.searchData.itemsPerPage, page);
    },

    }
}
</script>

<style lang="scss" scoped>
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
            width: 95%;
            height: 40px;
            border-radius: 20px;
            background: #F0F2F5;
            border: none;
            // border: 1px solid silver;
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
        margin-left: 40px;
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
            width: 95%;
            height: 40px;
            border-radius: 20px;
            background: #F0F2F5;
            border: none;
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
                background: #F0F2F5;
                border-radius: 10px;
                max-width: 95%;
                word-wrap: break-word;
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
            margin-left: 35px;
            display: flex;
            
            img{
            margin-right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 15px;
            }
            .comment_desc{
                padding: 10px;
                background: #F0F2F5;
                border-radius: 10px;
                max-width: 95%;
            word-wrap: break-word;
                .desc_member{
                    color: black;
                    font-weight: bold;
                }
                .desc_content{

                }
            }
        }
        .comment_content_icon{
            margin-left:40px;
            padding: 5px 0;
            .reply_text{
                margin:0 10px;
                color:#65676B;
                font-weight: bold;
                font-size:12px;
            }
            .delele_text{
                color:#65676B;
                font-weight: bold;
                font-size:12px;
                margin-right: 10px;
            }
            .report_text{
                color:#65676B;
                font-weight: bold;
                font-size:12px;
                margin-right: 10px;
            }
            .duration_text{
                color:#65676B;
                font-size:12px;
            }
            i{
                margin:0 10px;
                font-size: 12px;
                cursor: pointer;
            }
            span{
                cursor: pointer;
            }
            span:hover{
                text-decoration: underline;
            }
            .hide_show_text{
                font-weight: bold;
                font-size:13px;
            }
        }
        .comment_content_icon_reply{
            margin-left:75px;
            padding: 0 5px;
            .reply_text{
                margin:0 10px;
                color:#65676B;
                font-weight: bold;
                font-size:12px;
            }
            .delele_text{
                color:#65676B;
                font-weight: bold;
                font-size:12px;
                margin-right: 10px;
            }
            .report_text{
                color:#65676B;
                font-weight: bold;
                font-size:12px;
                margin-right: 10px;
            }
            .duration_text{
                color:#65676B;
                font-size:12px;
            }
            i{
                margin:0 10px;
                font-size: 12px;
                cursor: pointer;
            }
            span{
                cursor: pointer;
            }
            span:hover{
                text-decoration: underline;
            }
            .hide_show_text{
                font-weight: bold;
                font-size:13px;
            }
        }
        
    }
}

.validate{
    font-size: 13px;
    margin-left: 50px;
    color:red;

}
.validate_reply{
    font-size: 13px;
    margin-left: 85px;
    color:red;

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