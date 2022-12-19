<template>
  <div class="post_detail">
    <div class="post_detail-container">
        <a-row >
            <a-col :xxl="18" :xl="18" :lg="18">
                <div class="post_infomation">
                    <div class="post_detail-title">
                        <h1>{{ getPostDetail.title }}</h1>
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
                    <div class="image1">   
                        <template v-for = "(image,index) in getPostDetail.post_image" :key="index">
                                <a-row>
                                    <a-col :xxl = "12" :xl="12" :lg="12">
                                        <img :src="`/uploads/posts/${image.image}`" alt="">
                                    </a-col>
                                </a-row>
                        </template>         
                    </div>
                   </div>
                   <div class="post_detail-time">
                    
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
                   <div class="post-feedback">
                    
                   </div>
                </div>
            </a-col>

            <a-col :xxl="6" :xl="6" :lg="6">                 
                <div class="post_suggest">
                    <div class="post_suggest-img">

                    </div>
                </div>
            </a-col>
        </a-row>
     
    </div>
  </div>
</template>

<script>
import moment from 'moment';
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
        }
    },
    computed:{
        ...mapGetters({
            getPostDetail:"posts/getPostDetail",
            getPostDetailMember:"posts/getPostDetailMember"
        })
    },
    methods:{
      async fetchPostDetail(){
        let postId =this.$route.params.id;
        await this.$store.dispatch("posts/detailPostUser",postId)
      },

      formatDate(value){
        return moment(String(value)).format("HH:mm:ss DD/MM/YYYY")
      }
    },  
    created(){
        this.fetchPostDetail();
    }
}
</script>

<style lang="scss">
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
                .image1{
                    width: 100%;
                }
                img{
                    width: 100%;
                }
            }
            .post_detail-time{
                margin-top:20px;
                width: 100%;
                height: 100px;
                background: white;
                border-radius: 10px;
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

        }
    }
}

</style>