<template>
  <a-row>
        <template v-for="(post,index) in getMyPostUser" :key="index">
            <a-col :xxl="8" :xl="8" :lg="8" :md="12" :xs="24">
                        
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
                        
                                
                             
                             <h5 class="card_title">
                                <span v-if="post.title.length > 30">
                                 {{ post.title.substring(0,30) + "..."}}
                                </span>
                                <span v-else>
                                 {{ post.title}}
                                </span>
                             </h5>
                             <h4 class="card_category">
                                 {{ post.content.substring(0,30) + "..." }}
                             </h4>
                             
                             <div class="card-rating">
                                 <div class="rating_side">           
                                     <h5> <star-rating 
                                     v-model:rating="post.number_rating" 
                                     inactive-color="#DCDCDC"
                                     active-color="#d54215"
                                     v-bind:star-size="20"
                                     :read-only = true
                                     :show-rating = false
                                     :round-start-rating = false
                                 /> </h5>
                                 </div>
                                 <div class="favourite_side">
                                     <div class="card_wishlist">
                                         <i class="fa-regular fa-heart"></i>
                                     </div>
                                 
                                     <h5>{{ post.count_favourite }}</h5>
                                 </div>
                                 <div class="view_count">
                                <i class="fa-regular fa-eye"></i> {{ post.view_count }}
                            </div>
                             </div>
                             <div class="card_action">
                            <router-link v-if="post.status == 1"
                                :to="{
                                path: `/update-post/${post.id}`
                                }">
                            <i class="fa-solid fa-pen-to-square blue"></i>
                            </router-link >

                            <i class="fa-solid fa-trash red" @click="openConfirm(post.id)"></i>

                            <a-tooltip>
                            <template #title>
                            {{post.reason}}
                            </template>
                            <i class="fa-solid fa-circle-info green" v-if="post.reason"></i>
                            </a-tooltip>
                        </div>
                        </div>   
                      
                     </a-col>
            <!-- <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
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
                        <div class="card_action">
                            <router-link v-if="post.status == 1"
                                :to="{
                                path: `/update-post/${post.id}`
                                }">
                            <i class="fa-solid fa-pen-to-square blue"></i>
                            </router-link >

                            <i class="fa-solid fa-trash red" @click="openConfirm(post.id)"></i>
                        </div>
                   </div>   
        </a-col> -->
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
        <h5>Bạn có chắc chắn xóa bài viết này?</h5>
        <button class="btn btn-primary" @click="confirmDelete">Xác nhận </button>
        <button class="btn btn-danger" @click="cancelConfirm" style="margin-left:10px">Hủy </button>
    </a-modal>  
</template>

<script>
import StarRating from 'vue-star-rating'
import { mapGetters } from 'vuex'
export default {
    components:{
        StarRating
    },
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
                this.$toast.success('Xóa bài viết thành công!')
                this.fetchData()
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi!')
            });
            this.isConfirmModal = false

        }
    }
}
</script>

<style lang="scss" scoped>
.card_item{
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
            width: 90%;
            max-height: 500px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            // margin: 10px 5px; 
            margin:10px 0;

            img{
                width: 100%;
                height: 250px;
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
            top:0;
            right: 27px;
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
            .card_category{
                font-size: 24px;
                font-weight: 600;
                margin:0px 10px 0 10px;
               
            }
           
            .card_title{
                font-size:18px;
                color: rgba(0,0,0,.65);
                padding:20px 0 10px 10px;
                font-weight: bold;
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
                    padding: 0 15px;
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
                    margin-top: 4px;
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
                .view_count{
                    width: 50px;
                    margin-right: 20px;
                    margin-top: 4px;
                    height: 40px;
                    line-height: 40px;
                    display: flex;
                    i{
                        line-height: 40px;
                        margin-right: 5px;
                        
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
                text-align: end;
                padding: 10px 10px 10px 0;
                .blue{
                    margin-right: 10px;
                    color:blue;
                }
                .red{
                    color: red;
                    margin-right: 10px;

                }

                .green{
                    color: darkgreen;
                }
            }
        }
        .card_item:hover{
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.2), 0 1px 2px 0 rgba(0, 0, 0,0.1);
            transition: 0.3s;
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