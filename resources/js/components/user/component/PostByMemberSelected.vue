<template>
    <a-row>
        <template v-for="(post,index) in getYourPost" :key="index">
            <a-col :xxl="8" :xl="8" :lg="8" :md="12" :xs="24">
            <div 
                class="card_item">
                    <img :src="post.post_image[0].image" alt="" class="card_img">
                    <div class="card_heart">
                        <i class="fa-solid fa-heart"  v-if="post.favouriteable == false" @click="unsubmitFavourite(post.id)"></i>
                        <i class="fa-regular fa-heart" v-else @click="submitFavourite(post.id)"></i>

                    </div>
                        
                    <router-link
                    :to="{
                        path: `/postdetail/${post.id}`
                    }">
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
                    </router-link> 
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
                    </div>
                </div>   
                </a-col>
        </template>
            
      </a-row>
  </template>
  
  <script>
  import StarRating from 'vue-star-rating'
  import { mapGetters } from 'vuex'
  export default {
      data(){
          return{
            
          }
      },
      components:{
        StarRating
      },
      computed:{
          ...mapGetters({
            getYourPost : 'posts/getYourPost'
          }),
      },
      created(){
          this.fecthDataPost();
      },
      methods:{
        async fecthDataPost(){
            let postId = this.$route.params.id;
            console.log(postId);
            await this.$store.dispatch("posts/getYourPost",postId)
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
           
           .card_heart{
                width: 30px;
                height: 30px;
                background: #d54215;
                position: absolute;
                top:15px;
                left:10px;
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

            
            .card_category{
                font-size: 24px;
                font-weight: 600;
                margin:0px 10px 0 10px;
               
            }
            .card_category:hover{
                border-bottom:1px solid #d54215;
                transition: 0.5s;
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
                
            }
            .member_side{
                text-align: end;
                padding: 10px 15px;
                span{
                    margin-right:10px;
                }
                img{
                    width: 30px;
                    height: 30px;
                    border-radius: 15px;
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