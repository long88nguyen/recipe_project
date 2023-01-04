<template>
 <a-row>
    <template v-for="(post,index) in getFavouritePost" :key="index">
        <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
            <div 
                    class="card_item">
                        <img :src="post.post_image[0].image" alt="" class="card_img">
                        <div class="card_heart">
                            <div  v-if="post.favouriteable == false">
                            <a-tooltip>
                            <template #title>
                                Dislike
                            </template>
                            <i class="fa-solid fa-heart"  @click="unsubmitFavourite(post.id)"></i>
                            </a-tooltip>
                            </div>
                            <div  v-else>
                            <a-tooltip>
                            <template #title>
                                Like
                            </template>
                            <i class="fa-regular fa-heart" @click="submitFavourite(post.id)"></i>
                            </a-tooltip>
                            </div>

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
            getFavouritePost:"posts/getFavouritePost"
        })
    },
    created(){
        this.fetchDataFavourite();
    },

    methods:{
        async fetchDataFavourite()
        {
            await this.$store.dispatch("posts/getFavouritePost")
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
                this.fetchDataFavourite();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },

        async unsubmitFavourite(value){
            this.$store.dispatch("favourites/deleteFavourite",{
                id: value,
            }).then(() => {
                this.$toast.success("delete wish list successful !");
                this.fetchDataFavourite();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },
    }

}
</script>

<style lang="scss" scoped>
.card_item{
            width: 90%;
            height: 350px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 

            img{
                width: 100%;
                height: 150px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                top:0;
                position: relative;

            }
           
           .card_heart{
                 width: 30px;
                height: 30px;
                background: #d54215;
                position: absolute;
                top:15px;
                left:10px;
                color: white;
                font-size: 14px;
                border-radius: 50%;
                i
                {
                    display: flex;
                    justify-content: center;
                    line-height: 30px;
                }
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
        }
        .card_item:hover{
            box-shadow:2px 1px gray;
            transition: 0.3s;
        }
</style>