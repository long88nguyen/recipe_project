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
                    <video autoplay="" loop="" playsinline="" muted="" class="mntl-gif__video card__img universal-image__image"  aria-label="Allrecipes Top 10 Recipes of All Time"
                      data-src="https://www.allrecipes.com/thmb/vcm8Ff7c96TR72MKiD1SHTPjnYw=/800x533/filters:gifv(webm)/top_10-a764d3b60a8e418092a46685861edf06.gif" 
                      src="https://www.allrecipes.com/thmb/vcm8Ff7c96TR72MKiD1SHTPjnYw=/800x533/filters:gifv(webm)/top_10-a764d3b60a8e418092a46685861edf06.gif">
                      </video>
                  </div>
                </a-col>
                <a-col :xxl="12" :xl="12" :lg="12" :md="24" :xs="24">
                  <div class="slider_intro">
                      <h1>Khám phá món ăn trên khắp thế giới</h1>
                      <div class="most_favourite">
                          <div class="favourite_item">
                            <img src="../../../uploads/images/kobefoocate.png" alt="" class="rounded">
                            <div class="favourite_content">
                              <h4>contentcontentcontentcontentconten</h4>
                              <h5>descriptiondescriptiondescriptiondescriptiond</h5>
                              <h6><i class="fa-regular fa-clock"></i> 5 days ago</h6> 
                            </div>
                          </div>
                          <div class="favourite_item">
                            <img src="../../../uploads/images/eggduckcate.png" alt="" class="rounded">
                            <div class="favourite_content">
                              <h4>contentcontentcontentc</h4>
                              <h5>descriptiondescriptio</h5>
                              <h6><i class="fa-regular fa-clock"></i> a minutes ago</h6> 
                            </div>
                          </div>
                          <div class="favourite_item">
                            <img src="../../../uploads/images/meatcate.png" alt="" class="rounded">
                            <div class="favourite_content">
                              <h4>contentcontentcontent</h4>
                              <h5>descriptiondescriptiondescriptiondescriptio</h5>
                              <h6><i class="fa-regular fa-clock"></i> 1 hours ago</h6> 
                            </div>
                          </div>
                      </div>
                  
                        
                  </div>
                  
                </a-col>
              </a-row>
             
            </div>
        
    </div>
</div>   
</template>
  
<script>
 export default {
    data() {
      return {
        value: '',
        context: null,
        isFavourite:false,
      }
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
   width: 100%;
    .slider_food
    {
        width: 70%;
        margin:0 auto;
        margin-top:200px ;
        .hello{
          text-align: center;
          height: 200px;
          line-height: 160px;
          background: #364d79;
          overflow: hidden;
          border-radius:5px;
          position: relative;
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
            video{
            width: 90%;
            height: 90%;
            }
          }
          .slider_intro
          {
            position: absolute;
            .most_favourite{
              font-family: Arial, Helvetica, sans-serif;
              .favourite_item{
                padding: 5px 0;
                display: flex;
                align-items: center;
                width: 100%;
                img{
                  width: 100px;
                  height: 100px;
                  border-radius: 50px;
                }
                .favourite_content{
                  margin-left: 20px;
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