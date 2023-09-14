<template>
  <div class="banner_food">
        <div class="banner_food-container">
            <center><h3>Kết quả tìm kiếm</h3>
            </center>
            <div v-if="items.length > 0">
                <a-row>
                <template v-for="(post,index) in items" :key="index">
                    <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
                        
                        <div 
                         class="card_item">
                             <img :src="post.post_image[0].image" alt="" class="card_img">
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
                             <div class="member_side">
                                <span>{{ post.member.name }}</span> <img :src="post.member.avatar" alt="">
                             </div>
                        </div>   
                      
                     </a-col>
                </template>
            </a-row>
            </div>
            <div v-else>
                <center><h5 style="color:red">Không có kết quả tìm kiếm !</h5>
                <router-link to="/" class="back_page">Quay lại trang chủ</router-link>
                </center>
            </div>
        </div>
       
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            title:"",
        }
    },
     
    created(){
    },
    computed:{
       ...mapGetters({
        userCommom :"common/userCommon",
       }),
    },
    props:["items"],
    methods:{
    }, 
}
</script>

<style lang="scss" scoped>
.banner_food{
    background: #f4f9f6;
    padding-top: 200px;
    padding-bottom: 30px;
   width: 100%;
    .banner_food-container
    {
        width: 80%;
        margin:0 auto;
        .card_item{
            width: 90%;
            max-height: 400px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            // margin: 10px 5px; 
            margin:10px 0;

            img{
                width: 100%;
                height: 200px;
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
            // h4{
            //     font-size: 20px;
            //     height: 40px;
            //     padding:0px 10px 0 10px;
               
            // }
            .card_title{
                font-size:18px;
                height:45px;
                padding:10px
            }

            .card_category{
                font-size: 24px;
                height: 30px;
                line-height: 30px;
                margin:0px 10px 10px 10px;
               
            }
            .card_category:hover{
                border-bottom:1px solid #d54215;
                transition: 0.5s;
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
                span{
                    margin-right: 10px;
                }
            }
        }
        .card_item:hover{
            box-shadow:2px 1px gray;
            transition: 0.3s;
        }
        .container_showmore{
            .show_more{
                width: 100%;
                margin-top: 20px;
                height: 40px;
                background: #f0f0f0;
                color: #212529;
                text-align: center;
                line-height: 40px;
                border-radius: 20px;
            }
            .show_more:hover{
                cursor: pointer;
                background: rgb(212, 211, 211);
                transition: 0.5s;
            }
        }
    }
}

.back_page{
    font-size:16px;
}
.back_page:hover{
    text-decoration: underline;
}

@media (max-width:520px){
    .banner_food {
        .banner_food-container{
            width: 90%;
            .card_item{
                width: 100%;
                max-height: 500px;
                img{
                    height: 250px;
                }
            }
        }
    }
}
</style>