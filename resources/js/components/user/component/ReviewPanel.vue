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
                <i class="fa-solid fa-trash" @click="DeleteRate(rate.id)"></i>
                </a-tooltip>

                <a-tooltip>
                    <template #title>
                    Edit rate
                    </template>
                <i class="fa-solid fa-pen-to-square" @click="DetailRate(rate.id)"></i>
                </a-tooltip>
            </div>
        </div>
        </template>
        <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visible" 
            title="Chỉnh sửa đánh giá" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="rating_side_detail">
                <label for="">Your Rating</label>
                <star-rating 
                    v-model:rating="rateDetail.number_rating" 
                    inactive-color="#E8E8E8"
                    active-color="#FFFF00"
                    v-bind:star-size="40"
                    :show-rating = false
                    border-color = "#444444"	
                    :round-start-rating = false
                    @update:rating ="setRating"
                    :border-width="1"
                />
            </div>
            <div class="review_side">
                <label for="">Your review</label>
                <textarea name="" :rows = "3" id=""
                class="form-control"  v-model ="rateDetail.review"          
                ></textarea>
            </div>
            
            <button class="btn btn-success text-center mt-3" @click="updateRate(rateDetail.id)">Đánh giá</button>
          </a-modal>
          <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visibleDelete" 
            title="Xác nhận xóa đánh giá" 
            @ok="handleOk"
            :footer = null
            centered
            >
            <div class="delete_confirm">
                <h5>Bạn có muốn xóa đánh giá này không ?</h5>
            </div>

            <button class="btn btn-success text-center mt-3" @click="DeleteSubmit">Đánh giá</button>

            <button class="btn btn-danger text-center mt-3 mr-2" @click="unsubmit">Hủy</button>

          </a-modal>
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
            data_rating:[
                1,2,3,4,5
            ],
            visible : false,
            number_rating: 0,
            rateId :null,
            visibleDelete:false,
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
            rateDetail:"rates/rateDetail"
        }),
        checkUserId()
        {
            return this.$store.getters['common/userCommon'].id;
        }
    },
    created(){
        this.getListRateByPost();
    },

    methods:{
        unsubmit()
        {
            this.visibleDelete = false;
        },

        DeleteSubmit()
        {
            let rateId = this.rateId;
            this.$store.dispatch("rates/deleteRate",rateId).then(() => {
                let postId = this.$route.params.id;
                this.$toast.success('Update rating successful!')
                this.$store.dispatch('rates/listRatePost',postId);
                this.$store.dispatch('posts/detailPostUser',postId);
             }
            ).catch(() => {
                this.$toast.error('error')
            })
            this.visibleDelete = false;
        },

        async getListRateByPost(){
            let postId = this.$route.params.id;
            this.$store.dispatch("rates/listRatePost",postId)
        },

        async DetailRate(value)
        {
            console.log(value);
            this.visible = true;
            let rateId = value;
            await this.$store.dispatch("rates/detailRate",rateId);
        },
        setRating(value)
        {
            this.number_rating = value;
        },  

        updateRate(value){
            // console.log( this.rateDetail.id,
            //     this.number_rating,
            //  this.rateDetail.review);

            this.$store.dispatch("rates/updateRate",{
                id : value,
                number_rating : this.number_rating,
                review : this.rateDetail.review,
        }).then(()=>{
            this.visible = false;
            let postId = this.$route.params.id;
            this.$toast.success('Update rating successful!')
            this.$store.dispatch('rates/listRatePost',postId);
            this.$store.dispatch('posts/detailPostUser',postId);
        }).catch(() =>{
            this.$toast.error('error')
        });
        },
        DeleteRate(value){
            this.visibleDelete = true;
            this.rateId = value;
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
            justify-content: flex-end;
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