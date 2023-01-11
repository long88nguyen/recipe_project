<template>
    <div class="slider_container">
        <div class="slider_food">
          <a-carousel 
          effect="fade"
          dotsClass = "slick-dots"
          autoplay>
            <div class="hello">
              <img src="../../../uploads/images/banner1.png" alt="">
            </div>
            <div class="hello"><img src="../../../uploads/images/banner2.png" alt=""></div>
            <div class="hello"><img src="../../../uploads/images/banner3.png" alt=""></div>
            <div class="hello"><img src="../../../uploads/images/banner4.png" alt=""></div>
          </a-carousel>
         
            <div class="new-product">
              <a-row>
                <a-col :xxl="12" :xl="12" :lg="12" :md="24" :xs="24">
                  <div class="slider_video">
                    <img src="../../../uploads/images/banner.jpg" alt="">
                    <router-link to="/all-post" class="btn-explorer">
                      Khám phá
                    </router-link>
                  </div>
                </a-col>
                <a-col :xxl="12" :xl="12" :lg="12" :md="24" :xs="24">
                  <div class="slider_intro">
                      <h1>Thịnh hành</h1>
                      <div class="most_favourite">
                        <template v-for = "(post,index) in getMostFavourite" :key="index">
                          <div class="favourite_item">
                            <img :src="post.post_image[0].image" alt="" class="rounded">
                            <div class="favourite_content">
                              <router-link 
                                :to="{
                                path: `/post-detail/${post.id}`
                                }" >
                              <h4 class="favourite_title">{{ post.title }}</h4>
                              </router-link>
                              <h6 v-if = "post.duration > 86400"><i class="fa-regular fa-clock"></i> {{ Math.round(post.duration/86400) }} ngày trước</h6> 
                              <h6 v-else-if = "post.duration < 86400 && post.duration > 3600"><i class="fa-regular fa-clock"></i> {{ Math.round(post.duration/3600) }} giờ trước</h6> 
                              <h6 v-else-if = "post.duration < 3600"><i class="fa-regular fa-clock"></i> {{ Math.round(post.duration/60) }} phút trước</h6> 
                            </div>
                          </div>
                        </template> 
                      </div>
                  
                        
                  </div>
                  
                </a-col>
              </a-row>
             
            </div>
        
    </div>
</div>   
</template>
  
<script>
import { mapGetters } from 'vuex'
 export default {
    data() {
      return {
        value: '',
        context: null,
        isFavourite:false,
      }
    },
    created(){
      this.$store.dispatch('posts/getAllPost')
    },
    computed:{
       ...mapGetters({
        getMostFavourite : "posts/getMostFavourite"
       })
    },
    methods: {
      onContext(ctx) {
        this.context = ctx
      },
    }
  }
</script>

<style lang="scss" >

.slider_container{
   padding-top: 200px;
   width: 100%;
    .slider_food
    {
        width: 70%;
        margin:0 auto;
        .hello{
          text-align: center;
          height: 200px;
          line-height: 160px;
          background: #364d79;
          overflow: hidden;
          border-radius:5px;
          img{
            width: 100%;
            height: 100%;
          }
         
        }
        .ant-carousel >>> .slick-slide {
          text-align: center;
          height: 160px;
          line-height: 160px;
          background: #364d79;
          overflow: hidden;
        }

        .ant-carousel >>> .slick-slide h3 {
          color: #fff;
        }
        .new-product{
          margin-top:20px;
          .slider_video{
            width: 100%;
            height: 100%;
            img{
            width: 100%;
            height: 100%;
            position: relative;
            }
            .btn-explorer{
              position: absolute;
              top: 60%;
              right: 40%;
              width: 150px;
              height: 40px;
              line-height: 40px;
              text-align: center;
              border: none;
              border-radius: 20px;
              background: #d54215;
              color: white;
              font-weight: bold;
            }
            .btn-explorer:hover{
              color:black;
              background: white;
              transition:0.5s;
            }
          }
          .slider_intro
          {
            background: #f5f6ea;
            padding: 20px;
            width: 100%;
                height: 100%;
            .most_favourite{
              font-family: Arial, Helvetica, sans-serif;
              .favourite_item{
                padding: 5px 0;
                display: flex;
                align-items: center;
                width: 100%;
                height: 100%;
                img{
                  width: 100px;
                  height: 100px;
                  border-radius: 50px;
                }
                .favourite_content{
                  margin-left: 20px;
                  h4{
                    width: 100%;
                  }
                  .favourite_title:hover{
                    border-bottom: 1px solid #d54215;
                    transition: 0.5s;
                    cursor: pointer;
                  }
                }
              }
            }
            h1{
              font-size: 24px;
              font-family: 'Roboto', sans-serif;
              color: #d54215;
              font-weight: bold;
            }
          
            button{
              height: 40px;
              width: 150px;
              margin-top: 20px;
              outline: none;
              border:1px solid rgba($color: #000000, $alpha: 0.4);
              border-radius: 20px;
              background: white;
            }
            button:hover
            {
              background:#d54215;
              color: white;
            }
          
           
          }
       }     
    }
}

</style>