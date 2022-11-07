<template>
     <div class="filter_container">
        <div class="filter_post">
            <div class="filter_post-option">
                <div class="filter_post-item active">
                    <img src="../../../uploads/images/eggfood.jpg" alt="">
                    <h5 class="filter_post-title">
                        Tất cả
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/eggfood1.jpg" alt="">
                    <h5 class="filter_post-title">
                        Trứng gà
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/eggfood2.jpg" alt="">
                    <h5 class="filter_post-title">
                        Trứng vịt
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/ckfood1.jpg" alt="">
                    <h5 class="filter_post-title">
                        Bò Kobe
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/ckfood2.jpg" alt="">
                    <h5 class="filter_post-title">
                        Cá thu
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/ckfood3.jpg" alt="">
                    <h5 class="filter_post-title">
                        Thịt gà
                    </h5>
                </div>
                <div class="filter_post-item">
                    <img src="../../../uploads/images/meatfood.jpg" alt="">
                    <h5 class="filter_post-title">
                        Thịt lợn
                    </h5>
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
.filter_container{
    width: 100%;
    .filter_post
    {
        width: 70%;
        margin:0 auto;
        margin-top:20px ;
        margin-bottom:30px ;
        .filter_post-option
        {
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: space-between;
            .filter_post-item{
                width: 130px;
                height: 50px;
                background:  white;
                border-radius: 25px;
               
                img{
                    width: 50px;
                    height: 50px;
                    border-radius:25px ;
                    padding:3px;
                    margin-right:10px ;
                    float: left;
                }
                h5{
                    font-size:15px;
                    line-height: 50px;
                }
            }
            .active{
                    background: #f1734c;
                    h5{
                        color:white;
                    }
                }
                .filter_post-item:hover{
                    background:#f1734c;
                    
                    transition: 0.5s;
                    h5{
                        color:white;
                    }
                }
        }
        
    }
}
 
</style>