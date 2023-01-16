<template>
  <a-row>
        <template v-for="(post,index) in getMyPostUser" :key="index">
            <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
                <div 
                    class="card_item">
                        <img :src="post.post_image[0].image" alt="" class="card_img">
                        <div class="card_status confirm" v-if="post.status == 2">
                            <span>Đã duyệt</span>
                        </div>
                        <div class="card_status pending" v-if="post.status == 1">
                            <span>Đang chờ</span>
                        </div>
                        <div class="card_status reject" v-if="post.status == 3">
                            <span>Từ chối</span>
                        </div>
                        <router-link
                        :to="{
                          path: `/postdetail/${post.id}`
                        }">
                        <h5 class="card_title">
                           {{ post.title.substring(0,20) + "..."}}
                        </h5>
                        <h4 class="card_category">
                            {{ post.content.substring(0,20) + "..." }}
                        </h4>
                        </router-link> 
                        <div class="card-rating">
                            <div class="rating_side">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            
                                <h5>{{ post.number_rating }}</h5>
                            </div>
                            <div class="favourite_side">
                                <div class="card_wishlist">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                            
                                <h5>{{ post.count_favourite }}</h5>
                            </div>
                        </div>
                        {{  post.id }}
                        <div class="card_action">
                            <router-link
                                :to="{
                                path: `/update-post/${post.id}`
                                }">
                            <i class="fa-solid fa-pen-to-square blue"></i>
                            </router-link>

                            <i class="fa-solid fa-trash red" @click="openConfirm(post.id)"></i>
                        </div>
                   </div>   
        </a-col>
        </template>
        
    </a-row>
    <a-modal 
    class="add-timesheet-modal"
        v-model:visible="isConfirmModal" 
        :footer = null
        centered
        title="Xác nhận xóa bài viết" 
        @ok="handleOk" @cancel="handleCancel" :destroyOnClose="true"
        >
        <h4>Bạn có chắc chắn xóa bài viết này?</h4>
        <button class="btn btn-primary" @click="confirmDelete">Xác nhận </button>
        <button class="btn btn-danger" @click="cancelConfirm" style="margin-left:10px">Hủy </button>
    </a-modal>  
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return{
            isConfirmModal : false,
            idPost: null,
        }
    },
    computed:{
        ...mapGetters({
            getMyPostUser:"posts/getMyPostUser",
        }),
    },
    created(){
        this.fetchData()
    },
    methods:{
        async fetchData(){
            await this.$store.dispatch("posts/getMyPost");
        },
        openConfirm(value){
            this.isConfirmModal = true
            this.idPost = value;
        },
        handleCancel(){
            this.isConfirmModal = false
        },
        handleOk(){
            this.isConfirmModal = false
        },
        cancelConfirm(){
            this.isConfirmModal = false
        },

        async confirmDelete(){
            let postId = this.idPost;
            await this.$store.dispatch('posts/deletePost',postId).then(() =>{
                this.$toast.success('ok')
                this.fetchData()
            }).catch(()=>{
                this.$toast.error('ok')
            });
            this.isConfirmModal = false

        }
    }
}
</script>

<style lang="scss" scoped>
.card_item{
            width: 90%;
            max-height: 500px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            margin-top:15px;

            img{
                width: 100%;
                height: 150px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                top:0;
                position: relative;

            }
           
           .card_status{
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            width: 100px;
            height: 30px;
            position: absolute;
            top:-15px;
            right: 30px;
            color: white;
            font-size: 14px;
            border-radius: 15px;
            
            }
            .confirm{
                background: #198754;

            }
            .reject{
                background: red;

            }
            .pending{
                background: orange;
                
            }
            h4{
                font-size: 24px;
                height: 40px;
                padding:0px 10px 0 10px;
               
            }
            .card_title{
                font-size:18px;
                height:45px;
                padding:10px
            }
            .card-rating
            {
                display: flex;
                justify-content: space-between;
                .rating_side
                {
                    width: 100%;
                    height: 40px;
                    line-height: 40px;
                    display: flex;
                    .card_star
                    {
                        padding:0px 10px 0 10px;
                        i{
                            color: #d54215;
                            padding: 0px 5px 0 0;
                        }
                       
                    }
                    h5{
                            line-height: 40px;
                        }
                }
                .favourite_side
                {
                    width: 100%;
                    height: 40px;
                    line-height: 40px;
                    display: flex;
                    .card_wishlist
                    {
                        padding:0px 10px 0 10px;
                        i{
                            color: #d54215;
                            padding: 0px 5px 0 0;
                        }
                        
                    }
                    h5{
                            line-height: 40px;
                        }
                }
                
            }
            .member_side{
                text-align: end;
                padding: 10px 15px;
                img{
                    width: 30px;
                    height: 30px;
                    border-radius: 15px;
                }
            }
            .card_action{
                font-size: 20px;
                text-align: center;
                margin-top: 10px;
                .blue{
                    margin-right: 20px;
                    color:blue;
                }
                .red{
                    color: red;
                }
            }
        }
@media (max-width:520px)
{
    .card_item{
        width: 100%;
        max-height: 500px;
        img{
            height: 250px;
        }
        .card_status{
            top: -3px;
            right: 0;
        }
    }
}
</style>