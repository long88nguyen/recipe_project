<template>
    <div>
            <div class="input_search_rate">
                <a-row>
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    post title
                                </label> 
                                <input type="text" class="form-control" 
                                v-model="post_title"
                                @change="search"
                                v-on:keyup.enter="search"
                                >
                            </div>
                        </a-col>
                    
                    
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    Member name
                                </label>
                                <input type="text" class="form-control" 
                                v-model="member_name"
                                @change="search"
                                v-on:keyup.enter="search"
                                >
                            </div>
                        </a-col>              
                    
                </a-row>
            </div>
            <div class="input_submit">
                <button class="btn btn-success"  @click.prevent="search">Tìm kiếm</button>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            post_title:'',
            member_name:'',
        }
    },
    methods:{
        search() {
            this.$emit("search", {
                member_name: this.member_name,
                post_title: this.post_title
            });
        },
    }
}
</script>

<style lang="scss" scoped>
.input_search_rate
{
    .form-input{
        margin-right:10px ;
    }
    
}
.input_submit{
        text-align: center;
        margin: 10px 0;
}
</style>