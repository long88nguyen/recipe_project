<template>
  <div class="post_detail">
    <div class="post_detail-container">
        <a-row >
            <a-col :xxl="18" :xl="18" :lg="18">
                <div class="post_infomation">
                    <div class="post_account">
                        <img src="" alt="">
                        <div class="post_acount-detail">
                            <h1 class="post_account-name">
                            Long Nguyễn
                        </h1>
                        <h4 class="post_time">
                            19:00:00 20/10/2022
                        </h4>
                        </div>
                    </div>
                   <div class="post_detail-title"></div>
                   <div class="post_detail-content"></div>
                   <div class="post_detail-img">
                    <div class="image1">            
                       <div class="image1_1"><img src="" alt=""></div>
                       <div class="image1_2"><img src="" alt=""></div>
                    </div>
                    <div class="image2">            
                       <div class="image2_1"><img src="" alt=""></div>
                       <div class="image2_2"><img src="" alt=""></div>
                    </div>
                   </div>
                   <div class="post_detail-time">
                    
                   </div>
                   <div class="post_ingre">
                        <h1>Nguyên Liệu</h1>
                        <ul>
                            <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>400 gr</span>
                                 thịt heo nạc</li>
                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>500 gr</span>
                                đậu trắng coco de paimpol</li>

                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>1 củ</span>
                                hành tây</li>
                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>400 gr</span>
                                 thịt heo nạc</li>
                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>1 củ </span>
                                hành tím khô</li>
                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>2-3</span>
                                lá nguyệt quế (bay leaf)</li>
                                 <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>1-2 nhánh</span>
                                xạ hương (thyme)</li>
                                <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>1 nhánh</span>
                                hương thảo (rosemary)</li>
                                <li><i class="fa-solid fa-circle-dot"></i> 
                                <span>1 viên</span>
                                súp gà</li>
                        </ul>
                   </div>
                   <div class="post_direction">
                    <h1>Các bước thực hiện</h1>
                        <ul>
                            <li> 
                                <h4>Bước 1</h4>
                                Cook Italian sausage and red pepper flakes in a Dutch oven over medium-high 
                                heat until crumbly, browned, and no longer pink, 10 to 15 minutes. Drain and set aside.</li>
                                 <li> 
                                <h4>Bước 2</h4>
                                Cook bacon in the same Dutch oven over medium heat until crisp, about 10 minutes. 
                                Drain, leaving a few tablespoons of drippings with the bacon in the bottom of 
                                the Dutch oven. Stir in onions and garlic; cook until onions are soft and translucent,
                                 about 5 minutes.</li>

                                 <li> 
                                <h4>Bước 3</h4>
                                Stir in chicken broth and bring to a boil over high heat.
                                 Add potatoes and simmer until fork tender, about 20 minutes.
                                 Reduce heat to medium; stir in cream, cooked sausage, and spinach.
                                  Cook and stir until spinach has wilted and sausage is warmed through; serve.</li>
                        </ul>
                        <div class="img_result">
                            <img src="" alt="">
                        </div>
                        
                   </div>
                   <div class="post-feedback">
                    <button > 
                        fassds
                    </button>
                    <a-rate :default-value="2" disabled />
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
export default {
    data(){
        return {
        }
    },
    methods:{
      
    },  
    created(){
    }
}
</script>

<style lang="scss">
.post_detail{
    width: 100%;
    margin-top:200px;
    .post_detail-container
    {
        width: 70%;
        margin:0 auto;
        .post_infomation{
            width: 100%;
            .post_account{
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
                display: flex;
                img{
                    width: 100%;
                    height: 100%;
                }
                .image1{
                    width: 50%;
                    .image1_1{
                        height: 200px;
                        margin:3px;
                    }
                    .image1_2{
                        height: 300px;
                        margin:3px;

                    }
                }
                .image2{
                    width: 50%;
                    .image2_1{
                        height: 300px;
                        margin:3px;

                    }
                    .image2_2{
                        height: 200px;
                        margin:3px;

                    }
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
                height: 600px;
                background: white;
                border-radius: 10px;
                h1{
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
                h1{
                    padding:20px;
                }
                ul{
                    padding:0 20px 20px 20px;
                    li{
                        margin: 20px 0;
                        font-size: 14px;
                        span{
                            font-weight: bold;
                        }
                    }
                }
                .img_result{
                    width: 80%;
                    margin:0px auto;
                    padding-bottom: 10px;
                    img{
                        width: 100%;
                        height: 100%;
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
            margin-top:50px;

        }
    }
}

</style>