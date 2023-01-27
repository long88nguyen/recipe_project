<template>
   <div class="community_container">
        <div class="community_food">
            <h4>Cộng đồng</h4>
            <h6>Cùng xem những thành viên đóng góp tích cực nhất</h6>
            <div class="community_list">
                <a-row>
                    <template v-for="(posts,index) in memberPosts" :key="index">

                        <a-col :xxl="4" :xl="4" :lg="4" v-if="posts.count_posts > 0">

                      <router-link :to="{
                        path:`/post-by-author/${posts.id}`
                      }">
                        <div class="community_card" >
                            <h3>World Recipe</h3>
                            <img :src="posts.avatar" alt="" class="rounded">
                            <div class="community_member">
                                <span>{{posts.user_member.email }}</span>
                            </div>
                        </div>

                      </router-link>
                        
                        <div class="community_posts">
                            
                            <span>
                                {{posts.count_posts }} bài viết
                            </span>
                        </div>
                         </a-col>
                    </template>

                </a-row>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed:{
        ...mapGetters({
            memberPosts:"members/memberPosts"
        })
    },
    methods:{
        async fetchDataPosts(){
            await this.$store.dispatch('members/getMemberPosts');
        }
    },
    created(){
        this.fetchDataPosts();
    }
}
</script>

<style lang="scss" scoped>
.community_container{
   margin-top: 20px;
   width: 100%;
    .community_food
    {
        width: 70%;
        margin:0 auto;
       
        .community_list{
            max-height: 300px;

            .community_card{
            cursor: pointer;

                width: 96%;
                max-height: 300px;
                text-align: center;
                border-radius: 5px;
                img{
                    width: 120px;
                    height: 120px;
                    border-radius: 5px;
                    border: 3px solid white;
                }
                h3{
                    font-family: 'Dancing Script';
                    font-size: 22px;
                    font-weight: bold;
                    padding: 10px;
                    color: white;

                }
                .community_member{
                    padding: 10px;
                    .img_avatar{
                        width: 30px;
                        height: 30px;
                        border-radius: 15px;
                    }
                    span{
                        margin-left:10px ;
                        font-weight: bold;
                        color: white;
                    }
                }
            }
            .ant-col:nth-child(1) .community_card{
                background-image: linear-gradient(90deg,rgb(250, 163, 1),rgb(248, 177, 45));
            }

            .ant-col:nth-child(2) .community_card{
                background-image: linear-gradient(90deg,rgb(102, 3, 3),rgb(165, 26, 26));
            }
            .ant-col:nth-child(3) .community_card{
                background-image: linear-gradient(90deg,rgb(1, 48, 1),darkgreen);
            }
            .community_posts{
                display: flex;
                margin-top: 10px;
                /* text-align: center; */
                align-items: center;
                justify-content: center;

                .posts_img{
                    img{
                        width: 30px;
                        height: 30px;
                        border-radius: 15px;
                    }
                   
                }
                span
                    {
                        margin-left:10px;
                    }
            }
        }
    }
}
</style>