<template>
    <div class="filter_container">
        <div class="filter_post">
            <div class="filter_post-option">
                <div class="filter_post-item" :class="(searchData.category_id == null) ? 'active' : ''">
                    <img src="../../../uploads/images/logofood.png" alt="">
                    <h5 class="filter_post-title"   @click = "search()">
                        Tất cả
                    </h5>
                </div>
                <template v-for="(category, index) in categoryList" :key="index">
                    <div class="filter_post-item" :class="(searchData.category_id == category.id) ? 'active' : ''" @click = "search(category.id)">
                        <img src="../../../uploads/images/eggcate.png" alt="">
                        <h5 class="filter_post-title">
                            {{ category.name.substring(0,10) + "..." }}
                        </h5>
                    </div>
                </template>
                
            </div>
        </div>
</div>
  <div class="banner_food">
        <div class="banner_food-container">
            <a-row>
                <h1>{{ searchData.category_id }}</h1>
                <template v-for="(post,index) in getPostApproved" :key="index">
                    <a-col :xxl="6" :xl="6" :lg="6" :md="12" :xs="24">
                   <div class="card_item">
                        <img src="" alt="" class="card_img">
                        <div class="card_heart">
                            <i class="fa-regular fa-heart" v-if="post.favouriteable"></i>
                            <i class="fa-solid fa-heart" v-else></i>
                        </div>
                       
                        <h5 class="card_title">
                           {{ post.title}}
                        </h5>
                        <h4 class="card_category">
                            {{ post.content}}
                        </h4>
                        <div class="card-rating">
                            <div class="card_star">
                                <i class="fa-solid fa-star"></i>
                            </div>
                           
                            <h5>{{ post.number_rating }}</h5>
                        </div>
                   </div>    
                </a-col>
                </template>
                
            </a-row>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            searchData:{
                category_id:null,
            },
            products:[
                {
                    12:"hello"
                },{
                    13:"hello"
                },{
                    14:"hello"
                }

            ]
        }
    },
     
    created(){
        this.$store.dispatch("categories/getAllCategories")
        this.fecthDataPost();
    },
    computed:{
       ...mapGetters({
        categoryList:"categories/getAllcategory",
        getPostApproved:"posts/getPostApproved"
       }),
    },
    methods:{
        fecthDataPost()
        {
            this.$store.dispatch("posts/getPostsApproved",{
                category_id: this.searchData.category_id ? parseInt(this.searchData.category_id) : null,
            })
        },
        search(value){
            this.searchData.category_id = value ? value : null,
            console.log(this.searchData.category_id);
            this.fecthDataPost();
        }
    }, 
}
</script>

<style lang="scss">
.banner_food{
   width: 100%;
    .banner_food-container
    {
        width: 70%;
        margin:0 auto;
        .card_item{
            width: 90%;
            height: 300px;
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
                padding:0px 10px 0 10px;
               
            }
            h5{
                font-size:18px;
                padding:10px
            }
            .card-rating
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
                
            }
        }
        .card_item:hover{
            box-shadow:2px 1px gray;
            transition: 0.3s;
        }
    }
}
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
                    font-size:11px;
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