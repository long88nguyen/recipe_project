<template>
  <div class="post_detail">
    <div class="post_detail-container">
        <a-row >
            <a-col :xxl="18" :xl="18" :lg="18">
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
                            /> <div>
                            {{ getPostDetail.number_rating }}
                                
                            </div>
                        </div>
                        <div class="post_list_wist">  <i class="fa-regular fa-heart"></i> {{ getPostDetail.count_favourite }}</div>
                    </div>
                   <div class="post_detail-content">
                    <h5>
                        {{ getPostDetail.content }}
                    </h5>
                    
                   </div>
                    <div class="post_account">
                        <img src="../../uploads/avatar.png" alt="">
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
                            
                            <img :src="`/uploads/posts/${image.image}`" alt="">
                                    
                        </template>         
                    </div>
                   </div>
                   <div class="post_detail-time">
                        <div class="option save_post"> <span >Save</span>  <i class="fa-regular fa-heart"></i></div>
                        <div class="option favourite_post"><span @click="showPopup">Rate</span> <i class="fa-regular fa-star"></i></div>
                        <div class="option share_post"><span>Share</span> <i class="fa-solid fa-share"></i></div>
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
                   <div class="post_direction">
                    <h3>Nutrition Facts</h3>
                       
                   </div>
                   <rating-panel :id="getPostDetail.id"/>
                </div>
            </a-col>

            <a-col :xxl="6" :xl="6" :lg="6"> 
               
                    
                              
                <div class="post_suggest">
                    <h4>Posts by the same author</h4>
                    <template v-for="(post,index) in getMyPostUser" :key="index">
                    <div class="post_suggest-list">
                        <img :src="`/uploads/posts/${post.post_image[0].image}`" alt="">
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
                <label for="">Your Rating</label>
                <star-rating 
                    v-model:rating="rating" 
                    inactive-color="#E8E8E8"
                    active-color="#FFFF00"
                    v-bind:star-size="40"
                    :show-rating = false
                    border-color = "#444444"	
                    :round-start-rating = false
                    @update:rating ="setRating"
                    :border-width="1"
                />
            </div>
           
            <div class="review_side">
                <label for="">Your review</label>
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
            review:""
        }
    },
    components:{
        StarRating,
        RatingPanel
    },
    computed:{
        ...mapGetters({
            getPostDetail:"posts/getPostDetail",
            getPostDetailMember:"posts/getPostDetailMember",
            getMyPostUser:"posts/getMyPostUser"
        })
    },
    methods:{
      async fetchPostDetail(){
        let postId =this.$route.params.id;
        await this.$store.dispatch("posts/detailPostUser",postId)
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
        this.fetchPostDetail();
      },    
      formatDate(value){
        return moment(String(value)).format("HH:mm:ss DD/MM/YYYY")
      }
    },  
    created(){
        this.fetchPostDetail();
        this.$store.dispatch("posts/getMyPost")
    }
}
</script>

<style lang="scss" >
*{
    font-family: 'Roboto', sans-serif ;
}
.post_detail{
    width: 100%;
    margin-top:200px;
    .post_detail-container
    {
        width: 70%;
        margin:0 auto;
        .post_infomation{
            width: 100%;
            .post_detail-title{
                padding: 20px 20px 10px 20px;
                background: white;
            }

            .post_list_info
            {
               background: white;
               padding: 20px;
               display: flex;
               .post_list_rate{
                display: flex;
                width: 150px;
               }
            }

            .post_detail-content{
                padding: 0px 20px 20px 20px;
                background: white;
            }
            .post_account{
                background: white;
                padding: 20px;
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
                margin-top:20px;
                width: 360px;
                height:60px;
                background: #f5f6ea;
                border-radius: 10px;
                display: flex;
                .option{
                    
                    width: 120px;
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
                    i{
                        margin-left: 5px;
                    }

                    span:hover{
                        border-bottom : 3px solid white;
                        transition: 0.5s;                        
                        cursor: pointer;
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
            .post-feedback{
                margin-top:20px;
                width: 100%;
                height: 200px;
                background: white;
                border-radius: 10px;
            }
           
        }
        .post_suggest{
            width: 100%;
            height:1000px;
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
                    height: 150px;
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
</style>