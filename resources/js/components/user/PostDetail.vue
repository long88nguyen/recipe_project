<template>
  <div class="post_detail">
    <div class="post_detail-container">
        <a-row >
            <a-col :xxl="18" :xl="18" :lg="18" :xs="24">
                <div class="post_infomation">
                    <div class="post_detail-title">
                        <h1>{{ getPostDetail.title }}</h1>
                    </div>
                    <div class="post_list_info">
                        <div class="post_list_rate">
                            <star-rating 
                                v-model:rating="getPostDetail.number_rating" 
                                inactive-color="#000"
                                active-color="#f00"
                                v-bind:star-size="20"
                                :read-only = true
                                :show-rating = false
                                :round-start-rating = false
                            /> <div class="number">
                            {{ getPostDetail.number_rating }}
                                
                            </div>
                        </div>
                        <div class="post_list_wist">  <i class="fa-regular fa-heart"></i> <span>{{ getPostDetail.count_favourite }}</span></div>
                    </div>
                   <div class="post_detail-content">
                    <h5>
                        {{ getPostDetail.content }}
                    </h5>
                    
                   </div>
                    <div class="post_account">
                        <img :src="getPostDetailMember.avatar" alt="">
                        <div class="post_acount-detail">
                            <h1 class="post_account-name">
                            {{getPostDetailMember.name}}
                        </h1>
                           
                        <h4 class="post_time">
                            {{getPostDetail.created_at}}
                        </h4>
                        </div>
                    </div>
                   
                   <div class="post_detail-img">
                    <div class="image_panel">   
                        <template v-for = "(image,index) in getPostDetail.post_image" :key="index">
                            
                            <img :src="image.image" alt="">
                                    
                        </template>         
                    </div>
                   </div>
                   <div class="post_detail-time">
                        <div class="option save_post" v-if="getPostDetail.favouriteable  == true" @click="submitFavourite(getPostDetail.id)"> 
                            <span >Lưu bài viết</span>  
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <div class="option save_post" v-else @click="unsubmitFavourite(getPostDetail.id)" > 
                            <span >Bỏ lưu</span> 
                            <i class="fa-solid fa-heart"></i>
                            
                        </div>
                        
                    
                        <div class="option favourite_post" v-if="getPostDetail.rateable==false" @click="showPopup"><span >Đánh giá</span> <i class="fa-regular fa-star"></i></div>
                        <div class="option favourite_post" v-else  @click="showPopup"><span >Đã đánh giá</span> <i class="fa-solid fa-star"></i></div>
                        <!-- <ShareNetwork
                            network="facebook"
                            
                            :url="`https://localhost:8087/postdetail/4`"
                            title="Say hi to Vite! A brand new, extremely fast development setup for Vue."
                            description="This week, I’d like to introduce you to 'Vite', which means 'Fast'. It’s a brand new development setup created by Evan You."
                            quote="The hot reload is so fast it\'s near instant. - Evan You"
                            hashtags="vuejs,vite"
                        > -->
                        <div class="option share_post"><span>Chia sẻ</span> <i class="fa-solid fa-share"></i></div>
                        <!-- </ShareNetwork> -->
                   </div>
                   <div class="post_ingre">
                        <h3>Nguyên Liệu</h3>
                        <ul>
                            <template v-for="(ingredient,index) in getPostDetail.ingredients" :key="index">
                                <li><i class="fa-solid fa-circle-dot"></i> 
                                    {{ingredient.name}}
                                </li>
                            </template>
                        </ul>
                   </div>
                   <div class="post_direction">
                    <h3>Các bước thực hiện</h3>
                        <ul>
                            <template v-for="(direction,index) in getPostDetail.directions" :key="index">
                            <li> 
                                <h4>Bước {{ direction.step + 1 }}</h4>
                                {{ direction.description }}</li>
                            </template>
                        </ul>   
                   </div>
                   <div class="post_nutrition_fact" v-if="getPostDetail.nutrition_facts">
                    <h4>Thành phần dinh dưỡng</h4>
                        <span>{{ getPostDetail.nutrition_facts  }}</span>
                   </div>

                   <div class="post_note" v-if="getPostDetail.note">
                    <h4>Ghi chú</h4>
                        <p>{{ getPostDetail.note  }}</p>
                   </div>

                   <div class="post_time_make" v-if="getPostDetail.time">
                    <h4>Thời gian thực hiện</h4>
                        <p>{{ getPostDetail.time  }} phút</p>
                   </div>

                   <div class="post_feedback">
                   <rating-panel :id="getPostDetail.id"/>

                   </div>
                </div>
            </a-col>

            <a-col :xxl="6" :xl="6" :lg="6" :xs="24"> 
               
                    
                              
                <div class="post_suggest">
                    <h4>Bài viết cùng tác giả</h4>
                    <template v-for="(post,index) in getYourPost" :key="index">
                    <div class="post_suggest-list">
                        <img :src="post.post_image[0].image" alt="">
                        <div class="post_suggest-content">{{  post.title }}</div>
                    </div>
                    </template> 
                </div>
            </a-col>
        </a-row>
        <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visible" 
            title="Đánh giá bài viết" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="rating_side_detail">
                <label for="">Đánh giá</label>
                <star-rating 
                    v-model:rating="rating" 
                    inactive-color="#E8E8E8"
                    active-color="#d54215"
                    v-bind:star-size="40"
                    :show-rating = false
                    border-color = "#444444"	
                    :round-start-rating = false
                    @update:rating ="setRating"
                    :border-width="1"
                />
            </div>
           
            <div class="review_side">
                <label for="">Nhận xét</label>
                <textarea name="" :rows = "3" id="" v-model="review"
                class="form-control"            
                ></textarea>
            </div>
            
            <button class="btn btn-success text-center mt-3" @click="submitRate">Đánh giá</button>
          </a-modal>
    </div>
  </div>
</template>

<script>

import StarRating from 'vue-star-rating'
import moment from 'moment'
import { mapGetters } from 'vuex'
import RatingPanel from "./component/ReviewPanel.vue"
export default {
    data(){
        return {
            visible:false,
            rating:1,
            review:"",
        }
    },
    components:{
        StarRating,
        RatingPanel
    },
    async created(){    
        this.fetchPostDetail();
        this.getPostYour();
    },
    computed:{
        ...mapGetters({
            getPostDetail:"posts/getPostDetail",
            getPostDetailMember:"posts/getPostDetailMember",
            getYourPost:"posts/getYourPost",
            idMember:"posts/idCreatePost"
        }),
       
    },
    methods:{
      async fetchPostDetail(){
        let postId =this.$route.params.id;
        await this.$store.dispatch("posts/detailPostUser",postId);
      },
      showPopup(){
        if(this.getPostDetail.rateable == false)
        {
            return this.visible = true;
        }
        else
        {
            return this.$toast.error("This post has been rated by you!")
        }
        
      },  
      async submitFavourite(value)
        {
            const account = this.$store.getters['common/userCommon'];
            this.$store.dispatch("favourites/submitFavourite",{
                id: value,
                member_id: account.id, 
            }).then(() => {
                this.$toast.success("Add wish list successful !");
                this.fetchPostDetail();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },

        async unsubmitFavourite(value){
            this.$store.dispatch("favourites/deleteFavourite",{
                id: value,
            }).then(() => {
                this.$toast.success("delete wish list successful !");
                this.fetchPostDetail();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },  
      handleOk(){
        this.visible = false;
      },

      setRating(rating)
      {
        this.rating = rating;
      },

      async submitRate()
      {
        await this.$store.dispatch("rates/saveRate",{
            post_id : this.getPostDetail.id,
            number_rating : this.rating,
            review : this.review
        }).then(() =>{
            this.$toast.success("Rating successful!");
        }).catch(() =>{
            this.$toast.error("error");
        })
        this.rating = 1;
        this.review = "",
        this.visible = false;
        let postId = this.$route.params.id;
        this.$store.dispatch('rates/listRatePost',postId);
        this.fetchPostDetail();
      },    
      formatDate(value){
        return moment(String(value)).format("HH:mm:ss DD/MM/YYYY")
      },

      async getPostYour(){
        await this.fetchPostDetail();
        let postId = this.getPostDetailMember.id;
        await this.$store.dispatch("posts/getYourPost",postId)
      }
    },  
   
}
</script>

<style lang="scss" >
*{
    font-family: 'Roboto', sans-serif ;
}
.post_detail{
    width: 100%;
    padding-top:200px;
    background: #f8f6f2;
    .post_detail-container
    {
        width: 70%;
        margin:0 auto;
        .post_infomation{
            width: 100%;
            .post_detail-title{
                padding: 20px 20px 10px 20px;
                background: white;
                margin-bottom: 10px;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
            }

            .post_list_info
            {
            
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                margin-bottom: 10px;
               background: white;
               padding: 20px;
               display: flex;
               .post_list_rate{
                display: flex;
                width: 150px;
                .number{
                    margin: 7px 0 0 7px;
                }
               }
               .post_list_wist{
                margin-top:6px;
               }
            }

            .post_detail-content{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                padding: 20px 20px 20px 20px;
                background: white;
            }
            .post_account{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                background: white;
                padding: 20px;
                margin-bottom: 10px;
                display: flex;
                img{
                    width: 40px;
                    height: 40px;
                    border-radius:20px;
                }
                .post_acount-detail
                { 
                    margin-left: 10px;
                    h1{
                    font-size:18px;
                }
                
                .post_time{
                    font-size:10px;
                    font-weight: 200;
                    }
                } 
            }
            .post_detail-img{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                width: 100%;
                background: white;
                .image_panel{
                    width: 100%;
                    display: flex;
                }
                img{
                    padding: 5px;
                    width: 50%;
                    height: 300px;
                }
            }
            .post_detail-time{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                margin-top:20px;
                width: 480px;
                height:60px;
                background: #f5f6ea;
                border-radius: 10px;
                display: flex;
                .option{
                    
                    width: 160px;
                    height:60px;
                    border-right: 1px solid rgb(234, 234, 234);
                }
                .option:last-child{
                    border-right: none;
                }

                .save_post{
                    text-align: center;
                    line-height: 60px;
                    font-size: 16px;
                    background: #d54215;
                    color: white;
                    font-weight: 500;
                    cursor: pointer;
                    i{
                        margin-left: 5px;
                    }

                    span:hover{
                        border-bottom : 3px solid white;
                        transition: 0.5s;                        
                        
                    }
                }
                

                .favourite_post{
                    text-align: center;
                    line-height: 60px;
                    font-size: 16px;
                    color: black;
                    font-weight: 500;
                    i{
                        color:#d54215;
                        margin-left: 5px;
                    }

                    span:hover{
                        border-bottom : 3px solid black;
                        transition: 0.5s;
                        cursor: pointer;
                    }
                }

                

                .share_post{
                    text-align: center;
                    line-height: 60px;
                    font-size: 16px;
                    color: black;
                    font-weight: 500;
                    i{
                        color:#d54215;
                        margin-left: 5px;
                    }

                    span:hover{
                        border-bottom : 3px solid black;
                        transition: 0.5s;
                        cursor: pointer;
                        
                    }
                }
            }

            .post_ingre{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                margin-top:20px;
                width: 100%;
                background: white;
                border-radius: 10px;
                h3{
                    padding:20px;
                }
                ul{
                    padding:0 20px 20px 20px;
                    li{
                        margin: 20px 0;
                        font-size: 18px;
                        i{
                            font-size:10px;
                            color:red;
                            margin-right:20px;
                        }
                        span{
                            font-weight: bold;
                        }
                    }
                }
            }
            .post_direction{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                margin-top:20px;
                width: 100%;
                background: white;
                border-radius: 10px;
                
                h3{
                    padding: 20px;
                }
                ul{
                    padding:0 20px 20px 20px;
                    li{
                        margin: 20px 0;
                        font-size: 16px;
                        span{
                            font-weight: bold;
                        }
                    }
                }
              
               
            }
            .post_nutrition_fact{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                h4{
                    padding: 20px;
                }
                span{
                    padding: 20px;
                    font-size:16px;
                }
            }
            .post_note{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                h4{
                    padding: 20px;
                }
                p{
                    padding-left:20px;
                    font-size:16px;
                }
            }

            .post_time_make{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                background: #f5f6ea;
                width: 300px;
                margin-top:10px;
                h4{
                    padding: 20px;
                }
                p{
                    padding-left:20px;
                    padding-bottom: 10px;
                    font-size:16px;
                    i{
                        font-size: 20px;
                    }
                }
            }

            .post_feedback{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
                margin-top:20px;
                width: 100%;
                background: white;
                border-radius: 10px;
                margin-bottom: 20px;
            }
           
        }
        .post_suggest{
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0,0.1), 0 1px 2px 0 rgba(0, 0, 0,0.06);
                border-radius: 5px;
            width: 100%;
            background: white;
            margin-left:10px;
            padding: 20px;
            h4{
                color: #d54215;
            }
            .post_suggest-list{
                margin: 20px 0;

                img{
                    width: 100%;
                    height: 200px;
                    border: 4px solid rgb(234, 231, 231);
                    border-radius: 10px;
                }
                .post_suggest-content{
                    text-align: center;
                    width: 100%;
                    margin-top: 10px;
                    font-size: 18px;
                    font-weight: bold;
                }

                .post_suggest-content:hover{
                    border-bottom:1px solid #d54215;
                    transition: 0.5s;
                    cursor: pointer;
                }
            }

        }
    }
}

.rating_side_detail{
    padding:10px 0;
    label{
        margin-bottom: 10px;
        font-weight: bold;
    }
}

.review_side
{
    label{
        margin-bottom: 10px;
        font-weight: bold;
        
    }
}

@media (max-width: 520px)
{
    .post_detail{
        .post_detail-container{
            width: 95%;
            .post_infomation{
                .post_detail-img{
                .image_panel{
                    display: inline-block;
                    img{
                        width: 100%;

                    }
                }
                }
                .post_detail-time{
                    width: 200px;
                    .save_post
                    {
                        span{
                            display: none;
                        }
                    }
                    .favourite_post{
                        span{
                            display: none;
                        }
                    }

                    .share_post{
                        span{
                            display: none;
                        }
                    }

                }
            }
           .post_suggest{
            height: auto;
            margin-left: 0;
            padding: 0;
            .post_suggest-list{
                img{
                    height: 300px;
                }
            }
           } 

        }   
    }

}
</style>