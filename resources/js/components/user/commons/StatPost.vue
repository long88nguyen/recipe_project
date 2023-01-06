<template>
    <div class="stat_container">
        <div class="bigbanner">
      
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.stat_container{
    width: 100%;
    margin-top: 60px;
    .bigbanner{
        background-image: url('https://pistaciatheme.com/themes/wp/pistacia/wp-content/uploads/2016/05/pistaciafood_10.jpg');
        background-position: 50% -277px;
        width: 100%;
        height: 400px;
        position: relative;
    }
    .stat_list
    {
        display: flex;
        justify-content: space-between;
        position: absolute;
        top: 14%;
        left: 11%;
        .stat_item{
            width: 250px;
            height: 250px;
            background: rgba(0,0,0,0.5);
            margin:20px;
            h1{
                color: #c2baba;
                font-size: 28px;
                text-align: center;
                line-height: 250px;
            }
            
        }
    }
}
</style>