<template>
  <a-row>
        <template v-for="(post,index) in getMyPostUser" :key="index">
            <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
                <div 
                    class="card_item">
                        <img :src="`/uploads/posts/${post.post_image[0].image}`" alt="" class="card_img">
                        <div class="card_status">
                            <span>Đã duyệt</span>
                        </div>
                        <router-link
                        :to="{
                          path: `/post-detail/${post.id}`
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
                            <i class="fa-solid fa-pen-to-square blue"></i>
                            <i class="fa-solid fa-trash red"></i>
                        </div>
                   </div>   
        </a-col>
        </template>
        
    </a-row>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    computed:{
        ...mapGetters({
            getMyPostUser:"posts/getMyPostUser",
        }),
    },
    created(){
        this.$store.dispatch("posts/getMyPost")
    }
}
</script>

<style lang="scss">
.card_item{
            width: 90%;
            height: 350px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            margin: 10px 5px; 

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
            background: #198754;
            position: absolute;
            top: -2px;
            right: 10px;
            color: white;
            font-size: 14px;
            border-radius: 15px;
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
</style>