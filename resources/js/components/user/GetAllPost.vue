<template>
 <div class="get_all_post">
    <div class="get_all_post_container">
        <h5>Danh sách bài viết</h5>
        <div class="list_all_post">
            <div class="category">
                <img src="../../uploads/images/eggduckcate.png" alt="">
                <span>Hello word</span>
            </div>
            <div class="post_by_category">
                <a-row>
                    <a-col :xxl = "6" :xl = "6" :lg = "6">
                        <div class="post_item">
                            <img src="../../uploads/images/fishfood.png" alt="">
                            <div class="card_heart">
                                <i class="fa-solid fa-heart" ></i>
                                <i class="fa-regular fa-heart" ></i>
                            </div>
                            <button class="btn_post">Xem bài viết</button>
                        </div>
                    </a-col>
                </a-row>
            </div>

            
        </div>
    </div>
 </div>  
</template>

<script>
export default {

}
</script>

<style lang="scss">
.get_all_post{
    width: 100%;
    margin-top:200px;
    
    .get_all_post_container
    {
        width: 70%;
        margin:0 auto;
        background: white;
        .list_all_post{
            margin-top: 20px;
            .category{
                height: 50px;
                line-height: 50px;
                width: 200px;
                border-radius: 5px;
                background: #f5f6ea;
                padding: 0 5px;
                img{
                    width: 40px;
                    height: 40px;
                    border: 1px solid silver;
                    border-radius: 20px;
                    margin-right: 10px;
                }
                span{
                    font-size: 16px;
                }
            }
            .post_by_category{
                margin-top:20px ;
                .post_item{
                height: 200px;
                margin:5px;
                img{
                    width: 100%;
                    height: 200px;
                    border-radius: 10px;
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
            .btn_post{
                position: absolute;
                top: 100px;
                right: 100px;
                width: 120px;
                height: 30px;
                border: none;
                text-align: center;
                line-height: 30px;
            
                    }
            .btn_post:hover{
                background: #d54215;
                color: white;
                transition: 0.5s;
            }
                }
            }
            
        }
    }
}
</style>