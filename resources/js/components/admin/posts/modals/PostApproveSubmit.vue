<template>
    <div class="post_detail_approve">
        <div class="post_description">
            <div class="post_layout post_by">
                <div class="member_name"> 
                    <i class="fa-regular fa-user"></i> {{ showApprove.member.name }} <br>
                </div>
                <div class="created_at">
                    <i class="fa-solid fa-clock"></i>  
                </div>
            </div>
            <div class="post_layout post_image">
              
               </div> 
            <div class="post_layout post_title">
                <label for="">Title</label>
                <input type="text" class="form-control" disabled >
            </div>
            <div class="post_layout post_content">
                <label for="">Content</label>
                <textarea name="" id="" cols="30" rows="10" class="form-control" disabled >
                   

                </textarea>
            </div>
            <div class="post_layout post_ingredient">
                <label for="">Ingredient</label>
                <textarea name="" id="" cols="30" rows="10" class="form-control">
                    
                </textarea>
            </div>
            <div class="post_layout post_direction">
                <label for="">Direction</label>
                <textarea name="" id="" cols="30" rows="10"  class="form-control"></textarea>
            </div>
            <div class="post_layout post_time">
                <label for="">Time</label>
                <input type="text" class="form-control">
            </div>
            <div class="btn_event" v-if = "(showApprove.status == 1)">
                <button class="btn btn-primary" @click="Approve(2)">Approved</button>
                <button class="btn btn-success" @click="Reject(3)">Reject</button>
            </div>
        </div>    
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import axios from "axios";

export default {
    data(){
        return{
            heeeloo: 1,
            status:null,
            heeoo:{
                products:{
                    hello : 1,
                    ok : "2"
                }
            }
        }
    },
    props:["id"],
    computed:{
        ...mapGetters({
            showApprove:"posts/showApprove"
        }),
    },
    created()
    {
        this.$store.dispatch('posts/getApprovePost',this.$props.id);    
    },
    methods:{
        async approvePost()
        {
            await this.$store.dispatch("posts/updateStatusPost",{
                id:this.$props.id,
                status : this.status,
            }).then(() => {
                this.$emit("ok");
                this.$toast.success("Duyệt thành công")
            }).cactch(() =>{
                this.$toast.success("Đã xảy ra lỗi!");
            });
        },
        async Approve(status)
        {
            this.status = status;
            this.approvePost();
        },
        async Reject(status)
        {
            this.status = status;
            this.approvePost();
        }
    }
}
</script>

<style lang="scss" scoped>
.post_detail_approve{
    .post_description{
        padding:10px;
        .post_layout{
            margin: 10px 0px;
        }
        .post_image{
            img{
                width: 150px;
                height: 150px;
            }
        }
        .btn_event{
            display: flex;
            justify-content: space-evenly;
        }
    }
}

.ant-modal{
    width:700px !important;
}
</style>