<template>
  <div class="footer_side">
        <h1 class="footer-title">
            <img src="../../../uploads/images/logofood.png" alt="">
                World Recipes
        </h1>
        <ul class="footer-network">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-youtube"></i>
        </ul>
        <h4>2022 &copy; by Nguyen Van Long</h4>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.footer_side{
    width: 100%;
    background: #2c3b4b;
    height: 300px;
    margin-top:30px;
    text-align: center;
    h1{
        color: white;
        font-family: 'Roboto', sans-serif;
        padding-top:30px;
        img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    }
    .footer-network
    {
        margin-top: 30px;
        i{
            color:white;
            font-size:20px;
            margin: 0px 20px;
        }
    }
    h4{
        color: white;
        font-family: 'Roboto', sans-serif;
        padding-top:30px;
    }
}
</style>