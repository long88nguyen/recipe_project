<template>
 <div class="get_all_post">
    <div class="get_all_post_container">
        <h5>Danh sách bài viết</h5>
        <template v-for="(category,index) in getAllCategoryByPost" :key="index">
            <div class="list_all_post" v-if="category.posts.length > 0">
                <div class="category">
                    <img :src="category.image" alt="">
                    <span>{{category.name}}</span>
                </div>
                <div class="list_post">
                    <div class="post_by_category">
                    <a-row>
                        <template v-for="(post,index) in category.posts" :key="index">
                        <a-col :xxl = "6" :xl = "6" :lg = "8" :md="12" :xs="24">
                            <div class="post_item">
                                <img :src="post.post_image[0].image" alt="">
                                <div class="card_heart">
                                    <i class="fa-solid fa-heart" v-if="post.rateable == true" @click="unsubmitFavourite(post.id)"></i>
                                    <i class="fa-regular fa-heart" v-else @click="submitFavourite(post.id)"></i>
                                </div>
                               <router-link :to="{
                                        path: `/post-detail/${post.id}`
                                        }" class="btn_post">Xem bài viết
                                        
                            </router-link>
                            </div>
                        </a-col>
                        </template>  
                    </a-row>
                    </div>
                
                </div>
                  
         </div>
        </template>
       
    </div>
 </div>  
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    created(){
        this.getPost();
    },
    methods:{
        async getPost(){
            await this.$store.dispatch('categories/getAllCategoryByPost')
        },

        async submitFavourite(value)
        {
            console.log(1);
            const account = this.$store.getters['common/userCommon'];
            this.$store.dispatch("favourites/submitFavourite",{
                id: value,
                member_id: account.id, 
            }).then(() => {
                this.$toast.success("Add wish list successful !");
                this.getPost();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },

        async unsubmitFavourite(value){
            this.$store.dispatch("favourites/deleteFavourite",{
                id: value,
            }).then(() => {
                this.$toast.success("delete wish list successful !");
                this.getPost();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },
    },
    computed:{
        ...mapGetters({
            getAllCategoryByPost:"categories/getAllCategoryByPost"
        })
    }
}
</script>

<style lang="scss">
.get_all_post{
    width: 100%;
    margin-top:200px;
    
    .get_all_post_container
    {
        width: 70%;
        margin:0 auto;
        background: white;
        .list_all_post{
            margin-top: 20px;
            .category{
                height: 50px;
                line-height: 50px;
                width: 200px;
                border-radius: 5px;
                background: #f5f6ea;
                img{
                    width: 40px;
                    height: 40px;
                    border: 1px solid silver;
                    border-radius: 20px;
                    margin-right: 10px;
                }
                span{
                    font-size: 16px;
                }
            }
           .list_post{
            width: 100%;
            .post_by_category{
            width: 100%;

                margin-top:20px ;
                .post_item{
                width: 100%;
                padding: 10px;
                height: 200px;
                img{
                    width: 100%;
                    height: 200px;
                    border-radius: 10px;
                    position: relative;
                }
                .card_heart{
                width: 30px;
                height: 30px;
                background: #d54215;
                position: absolute;
                top:15px;
                left:20px;
                font-size: 14px;
                color:white;
                border-radius: 50%;
                i
                {
                    display: flex;
                    justify-content: center;
                    line-height: 30px;
                }
            }
            .btn_post{
                position: absolute;
                top: 45%;
                right: 30%;
                width: 120px;
                height: 30px;
                border: none;
                text-align: center;
                line-height: 30px;
                background:white;
                color:black;
            
                    }
            .btn_post:hover{
                background: #d54215;
                color: white;
                transition: 0.5s;
            }
                }
            }
           }
        
            
        }
    }
}

@media (max-width:520px)
{
    .get_all_post{ 
        .get_all_post_container
        {
            width: 90%;
            .list_all_post{
                .list_post{
                    .post_by_category{
                        .post_item{
                            height: 250px;
                            img{
                                height: 100%;
                                // height: 250px;
                                // margin:10px 0;
                            }
                        }
                    }
                }
            }
        }
        }
}
</style>