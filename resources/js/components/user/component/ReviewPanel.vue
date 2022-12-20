<template>
    <div class="review_list">
        <h1>Review (102)</h1>
        <div class="rating_infomation">
            <div class="rating_avg">

            </div>
            <div class="rating_avg_list">
                <star-rating 
                        v-model:rating= "rating"
                        inactive-color="#000"
                        active-color="#f00"
                        v-bind:star-size="20"
                        :read-only = true
                        :show-rating = false
                    /> 
                    <span>1234 Ratings</span>
                    <template v-for="(rate,index) in data_rating" :key="index" >
                    <div class="rating_avg_detail">
                       
                           
                            <star-rating 
                                :rating= "`${rate}`"
                                inactive-color="#000"
                                active-color="#f00"
                                v-bind:star-size="20"
                                :read-only = true
                                :show-rating = false
                            /> 
                            <span> {{ rate }}</span>
                        
                        

                    </div>
                </template>
            </div>
        </div>
        <template  v-for = "(rate,index) in rateListByPost" :key="index">
            <div class="member_rating_list">
            <div class="rating_account">
                <img src="../../../uploads/avatar.png" alt="">
                <span>{{ rate.member.name }}</span>
            </div>
            <div class="rating_number_side">
                <div class="rating_number_side-count">
                    <star-rating 
                        v-model:rating= "rate.number_rating"
                        inactive-color="#000"
                        active-color="#f00"
                        v-bind:star-size="20"
                        :read-only = true
                        :show-rating = false
                    /> 
                </div>
                <div class="rating_number_side-time">
                    <span>{{ rate.created_at  }}</span>
                </div>
            </div>
            <div class="review_content">
                <span>
                    {{  rate.review }}
                </span>
            </div>
            <div class="review_action" v-if="checkUserId == rate.member_id">
                <a-tooltip>
                    <template #title>
                    Like
                    </template>
                        <i class="fa-solid fa-thumbs-up"></i>
                </a-tooltip>

                <a-tooltip>
                    <template #title>
                    Delete rate
                    </template>
                <i class="fa-solid fa-trash"></i>
                </a-tooltip>

                <a-tooltip>
                    <template #title>
                    Edit rate
                    </template>
                <i class="fa-solid fa-pen-to-square"></i>
                </a-tooltip>
            </div>
        </div>
        </template>
       
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import { mapGetters } from 'vuex'

export default {
    components:{
        StarRating
    },
    data(){
        return {
            rating:3,
            data_rating:[
                1,2,3,4,5
            ],
        }
    },
    props:{
        id:{
            type:Number,
        },
    },

    computed:{
        ...mapGetters({
            rateListByPost:"rates/rateListByPost",
        }),
        checkUserId()
        {
            return this.$store.getters['common/userCommon'].id;
        }
    },

    created(){
        console.log(this.$store.getters['common/userCommon'].id);
        this.getListRateByPost();
    },

    methods:{
        async getListRateByPost(){
            let postId = this.$route.params.id;
            this.$store.dispatch("rates/listRatePost",postId)
        }
    }
}
</script>

<style lang="scss">
.review_list{
    background: white;
    padding: 20px;
    margin-top: 10px;
    h1{
        font-weight: bold;
    }
    .rating_infomation{
        .rating_avg_list{
            width: 50%;
            margin: 0 auto;
            .rating_avg_detail{
                margin-top:5px;
                display: flex;
                span{
                    margin-left: 5px;
                }
            }
        }
    }
    .member_rating_list{
        padding :20px 0;
        border-bottom: 1px solid gainsboro;
       .rating_account{
            img{
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 20px;
        }
        span{
            border-bottom:1px solid #d54215;
        }
        }
        .rating_number_side{
        margin-top:15px ;
        display: flex;
        height: 30px;
        .rating_number_side-count{
            height:30px;
        }
        .rating_number_side-time{
            height: 30px;
            padding-top: 4px;
            margin-left: 10px;
        }
        }
        .review_content{
            margin-top: 20px;
        }
        .review_like{
            margin-top: 10px;
        }

        .review_action{
            margin-top: 10px;
            font-size: 16px;
            display: flex;
            justify-content: end;
            i{
                margin-left: 15px;
                cursor: pointer;
            }
        }
    }

    .member_rating_list:last-child{
        border:none;
    }
    
}
</style>