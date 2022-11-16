<template>
  <div class="new_post-container">
    <div class="new_post">
        <h1>New Post</h1>
        <a-row>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Món gà chiên</h2>
                        <p>Món ăn làm từ gà</p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Gà KFC</h2>
                        <p>Món gà ăn nhanh KFC</p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Món gà sốt</h2>
                        <p>Gà sốt vang thơm ngon</p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Trứng chiên</h2>
                        <p>Món trứng chiên thơm ngon</p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Món trứng ốp la</h2>
                        <p>Món trứng ốp la </p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
            <a-col :xxl="8" :xl="8" :lg="8">
                <div class="hero-image">
                    <img src="" alt="">
                    <div class="hero-text">
                        <h2 >Thịt bò sốt</h2>
                        <p>Món thịt bò sốt vang</p>
                        <button>Xem ngay</button>
                    </div>
                    <div class="image-heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                </div>
            </a-col>
        </a-row>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.new_post-container{
   width: 100%;
    .new_post
    {
        width: 70%;
        margin:0 auto;
        margin-top:40px ;
        h1{
            text-align: center;
            font-size:24px ;
            border-bottom: 2px solid #d54215;
        }
        .hero-image{
            width: 100%;
            height: 300px;
            padding:10px;
            img{
                
                opacity: 1.0;
                filter: alpha(opacity=100);
                width: 100%;
                height: 100%;
                position: relative;
                border-radius: 5px;
            }
            .hero-text {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            color: white;
            transform: translate(-50%, -50%);
            h2{
                color: white;
            }
            
            }
            .hero-text button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 10px 25px;
            color: black;
            background-color: #ddd;
            text-align: center;
            cursor: pointer;
            }
            .hero-text button:hover {
                background-color:  #d54215;
                color: white;
            }
            .image-heart
            {
                position: absolute;
                width: 40px;
                height: 40px;
                top:15px;
                left: 15px;
                background: #d54215;

                border-radius: 50%;

                i{
                    display: flex;
                    justify-content: center;
                    font-size: 30px;
                    line-height: 40px;

                }
            }
        }
        .hero-image:hover{
          
            img{
                opacity: 0.3;
                filter: alpha(opacity=40);
                transition: 0.5s;
            }
            .hero-text{
                z-index: 10;
                color: black;
                h2{
                color: black;
            }
            }
        }
    }
}
</style>