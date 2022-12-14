<template>
  <div class="banner_food">
        <div class="banner_food-container">
            <center><h1>Kết quả tìm kiếm</h1>
            </center>
            <div v-if="items.length >0">
                <a-row>
                <template v-for="(post,index) in items" :key="index">
                    <a-col :xxl="6" :xl="6" :lg="6" :md="12" :xs="24">
                   <div class="card_item">
                        <img src="../../uploads/images/kobefoocate.png" alt="" class="card_img">
                        <div class="card_heart">
                            <i class="fa-solid fa-heart"  v-if="post.favouriteable == false" @click="unsubmitFavourite(post.id)"></i>
                            <i class="fa-regular fa-heart" v-else @click="submitFavourite(post.id)"></i>
                        </div>
                        <h5 class="card_title">
                           {{ post.title}}
                        </h5>
                        <h4 class="card_category">
                            {{ post.content}}
                        </h4>
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
                            <img src="../../uploads/avatar.png" alt="">
                        </div>
                   </div>    
                </a-col>
                </template>
            </a-row>
            </div>
            <div v-else>
                <center><h5 style="color:red">Không có kết quả tìm kiếm !</h5></center>
            </div>
        </div>
       
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
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
        async submitFavourite(value)
        {
            console.log(1);
            const account = this.$store.getters['common/userCommon'];
            this.$store.dispatch("favourites/submitFavourite",{
                id: value,
                member_id: account.id, 
            }).then(() => {
                this.$toast.success("Add wish list successful !");
                this.fecthDataPost();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },

        async unsubmitFavourite(value){
            this.$store.dispatch("favourites/deleteFavourite",{
                id: value,
            }).then(() => {
                this.$toast.success("delete wish list successful !");
                this.fecthDataPost();
            }).catch(() =>{
                this.$toast.error("Erorr!");    
            })
        },

        changePage(page) {
            this.fecthDataPost(this.searchData.itemsPerPage, page);
        },

        countData(){
             this.categoryList.length();
        }
    }, 
}
</script>

<style lang="scss" scoped>
.banner_food{
    margin-top: 200px;
   width: 100%;
    .banner_food-container
    {
        width: 70%;
        margin:0 auto;
        .card_item{
            width: 90%;
            height: 350px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            margin: 10px 5px; 

            img{
                width: 100%;
                height: 150px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                top:0;
                position: relative;

            }
           
           .card_heart{
                width: 30px;
                height: 30px;
                background: orange;
                position: absolute;
                top:15px;
                left:10px;
                font-size: 20px;
                border-radius: 50%;
                i
                {
                    display: flex;
                    justify-content: center;
                    line-height: 30px;
                }
            }
            h4{
                font-size: 24px;
                height: 40px;
                padding:0px 10px 0 10px;
               
            }
            .card_title{
                font-size:18px;
                height:45px;
                padding:10px
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
            }
        }
        .card_item:hover{
            box-shadow:2px 1px gray;
            transition: 0.3s;
        }
    }
}

</style>