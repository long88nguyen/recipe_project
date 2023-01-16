<template>
    <div class="filter_container">

        <div class="filter_post">
            <h5>Hôm nay ăn gì</h5>
            <div class="filter_post-option">
                <div class="filter_post-item" :class="(searchData.category_id == null) ? 'active' : ''">
                    <img src="../../../uploads/images/logofood.png" alt="">
                    <h5 class="filter_post-title"   @click = "search()">
                        Tất cả
                    </h5>
                </div>
                <template v-for="(category, index) in categoryList" :key="index">
                    <div class="filter_post-item" :class="(searchData.category_id == category.id) ? 'active' : ''" @click = "search(category.id)">
                        <img :src="category.image" alt="">
                        <h5 class="filter_post-title">
                            {{ category.name.substring(0,10) }}
                        </h5>
                    </div>
                </template>
                <router-link to="/all-post">
                    <div class="filter_post-more">
                        
                        <h5 class="filter_post-title">
                            {{ categoryList.length }}+ <span>Danh mục</span>
                        </h5>
                </div>
                </router-link>
                
            </div>
        </div>
</div>
  <div class="banner_food">
        <div class="banner_food-container">
            <a-row>
                <template v-for="(post,index) in getPostApproved.data" :key="index">
                    <a-col :xxl="6" :xl="6" :lg="8" :md="12" :xs="24">
                        
                   <div 
                    class="card_item">
                        <img :src="post.post_image[0].image" alt="" class="card_img">
                        <div class="card_heart">
                            <i class="fa-solid fa-heart"  v-if="post.favouriteable == false" @click="unsubmitFavourite(post.id)"></i>
                            <i class="fa-regular fa-heart" v-else @click="submitFavourite(post.id)"></i>

                        </div>
                           
                        <router-link
                        :to="{
                          path: `/post-detail/${post.id}`
                        }">
                        <h5 class="card_title">
                           {{ post.title.substring(0,20) + "..."}}
                        </h5>
                        <h4 class="card_category">
                            {{ post.content.substring(0,20) + "..." }}
                        </h4>
                        </router-link> 
                        <div class="card-rating">
                            <div class="rating_side">           
                                <h5> <star-rating 
                                v-model:rating="post.number_rating" 
                                inactive-color="#DCDCDC"
                                active-color="#d54215"
                                v-bind:star-size="20"
                                :read-only = true
                                :show-rating = false
                                :round-start-rating = false
                            /> </h5>
                            </div>
                            <div class="favourite_side">
                                <div class="card_wishlist">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                            
                                <h5>{{ post.count_favourite }}</h5>
                            </div>
                        </div>

                        <div class="member_side">
                            <span>
                                {{post.member.name }}
                            </span><img :src="post.member.avatar" alt="">
                        </div>
                   </div>   
                 
                </a-col>
                </template>
            </a-row>
            <a-pagination 
            class="paginate"
            v-model:current="searchData.paginate.currentPage" 
            :total="searchData.paginate.totalRecord" 
            :page-size="Number(searchData.paginate.perPage)" 
            @change = "changePage"
            show-less-items />
            <div class="container_showmore"> 
                <router-link to="/all-post"><div class="show_more"><span>Show more category</span></div></router-link>
            </div>
            
            
        </div>
        <div class="newfood-container">
            <h4>Bài viết mới</h4>
            <div>
                <a-row>
                    <template v-for="(post_order,index) in getPostOrder" :key="index">
                        <a-col :xxl="8" :xl="8" :lg="8" :md="12" :xs="24">
                           
                            <div class="newpost_cartd">
                                <a-carousel 
                                effect="fade"
                                dotsClass = "slick-dots"
                                autoplay>
                                    <template v-for="(image,index) in post_order.post_image" :key="index">
                                        <div class="hello"><img :src="image.image" alt=""></div>
                                    </template>
                                    
                                </a-carousel>
                                <div class="card_heart">
                                    <i class="fa-solid fa-heart"  v-if="post_order.favouriteable == false" @click="unsubmitFavourite(post_order.id)"></i>
                                    <i class="fa-regular fa-heart" v-else @click="submitFavourite(post_order.id)"></i>

                                </div>
                                <router-link 
                                :to="{
                                path: `/post-detail/${post_order.id}`
                                }" >
                                <span>{{post_order.title.substring(0,20) + "..."}}</span>
                            </router-link>
                            </div>
                           
                        </a-col>
                    </template>
                    
            </a-row>
            </div>
          
        </div>
    </div>
    </template>


<script>
import { mapGetters } from 'vuex'
import StarRating from 'vue-star-rating'
export default {
    components:{
        StarRating
    },
    data(){
        return {
            searchData:{
                category_id:null,
                itemsPerPage:5,
                paginate: {
                from: 0,
                to: 0,
                totalPage: 0,
                path: "",
                currentPage: 1,
                totalRecord: 0,
                perPage: 0,
              },
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
        console.log(this.$store.getters['common/userCommon'].id);
        this.$store.dispatch("categories/getAllCategories")
        this.fecthDataPost();
    },
    computed:{
       ...mapGetters({
        categoryList:"categories/getAllcategory",
        getPostApproved:"posts/getPostApproved",
        getPostOrder:"posts/getPostOrder",
        userCommom :"common/userCommon",
        listItemsPerPage: "common/listItemsPerPage",
        pagination: "posts/pagination"
       }),
    },
    methods:{
        fecthDataPost()
        {
            this.$store.dispatch("posts/getPostsApproved",{
                category_id: this.searchData.category_id ? parseInt(this.searchData.category_id) : null,
                itemsPerPage: this.searchData.itemsPerPage,
                currentPage: this.searchData.paginate.currentPage,
            })
            this.searchData.paginate = this.pagination;
        },
        search(value){
            this.searchData.category_id = value ? value : null,
            console.log(this.searchData.category_id);
            this.searchData.paginate.currentPage = 1;
            this.fecthDataPost();
        },
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
        },
        scrollToTop() {
            window.scrollTo(0,0);
        }
    }
}
</script>

<style lang="scss" scoped>
.banner_food{
   width: 100%;
    .banner_food-container
    {
        width: 70%;
        margin:0 auto;
        .card_item{
            width: 90%;
            max-height: 500px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            // margin: 10px 5px; 
            margin:10px 0;

            img{
                width: 100%;
                height: 200px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                top:0;
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

            
            .card_category{
                font-size: 24px;
                height: 30px;
                line-height: 30px;
                margin:0px 10px 10px 10px;
               
            }
            .card_category:hover{
                border-bottom:1px solid #d54215;
                transition: 0.5s;
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
                    padding: 0 15px;
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
                    margin-top: 4px;
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
                span{
                    margin-right:10px;
                }
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
        .container_showmore{
            .show_more{
                width: 100%;
                margin-top: 20px;
                height: 40px;
                background: #f0f0f0;
                color: #212529;
                text-align: center;
                line-height: 40px;
                border-radius: 20px;
            }
            .show_more:hover{
                cursor: pointer;
                background: rgb(212, 211, 211);
                transition: 0.5s;
            }
        }
    }
    .newfood-container{
        width: 70%;
        margin: 0 auto;
        margin-top: 20px;
        .newpost_cartd
        {
            cursor: pointer;
            height: 250px;
            width: 100%;
            background: none;;
            position: relative;
            img{
                border-radius: 10px;
            }
            span{
                position: absolute;
                bottom: 30px;
                left: 30px;
                color: white;
                font-size: 20px;
                
                }
            .card_heart{
                width: 30px;
                height: 30px;
                background: #d54215;
                position: absolute;
                top:20px;
                left:20px;
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
        }
        .newpost_cartd:hover{
            img{
                opacity: 0.6;
                filter: alpha(opacity=40);
                transition: 0.5s;
            }
          
            span{
            color:black;
            top:50%;
            left: 20%;
            transition: 0.5s;
            font-size: 24px;
            font-weight: bold;

            }
        }
        .hello{
            width: 100%;
            height: 250px;
            padding: 10px 10px;

            img{
                width: 100%;
                height: 100%;
        }
        
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
        h5{
            margin-bottom:20px;
        }
        .filter_post-option
        {
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: space-between;
            .filter_post-item{
                width: 130px;
                height: 40px;
                background:  rgb(241, 232, 232);
                border-radius: 20px;
               
                img{
                    width: 40px;
                    height: 40px;
                    border-radius:20px ;
                    padding:3px;
                    margin-right:5px ;
                    float: left;
                }
                h5{
                    font-size:11px;
                    line-height: 40px;
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
                    cursor: pointer;
                    
                    transition: 0.5s;
                    h5{
                        color:white;
                    }
                }

                .filter_post-more{
                cursor: pointer;
                text-align: center;
                width: 130px;
                height: 40px;
                background:  rgba(0, 0, 0,0.2);
                border-radius: 20px;
                h5{
                    font-size:13px;
                    font-weight: bold;
                    line-height: 40px;
                }
            }
        }
        
    }
}


@media (max-width: 520px) {
    .filter_container{
        .filter_post{
            width: 96%;
            .filter_post-option{

                .filter_post-item{
                    width: 40px;
                    height: 40px;
                    border-radius: 20px;
                    .filter_post-title{
                    display: none;
                }
                img{
                    margin: 0;
                    padding: 6px;
                }
                }
                .filter_post-more{
                    width: 40px;
                    height: 40px;
                    border-radius: 20px;
                    .filter_post-title{
                        span{
                            display: none;
                        }
                }
                }
               
            }
        }

    }
    .banner_food{
        .banner_food-container{
            width: 90%;
            .card_item{
                width: 100%;
                img{
                    height: 250px;
                }
            }
        }

        .newfood-container{
        width: 90%;
    }
    }
    
}
 
</style>