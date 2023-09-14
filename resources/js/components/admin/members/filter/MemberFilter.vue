<template>
    <div>
            <div class="input_search_member">
                <a-row>          
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    Tên người dùng
                                </label>
                                <input type="text" class="form-control" 
                                v-model="name"
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
            name:'',
        }
    },
    methods:{
        search() {
            this.$emit("search", {
                name: this.name
            });
        },
    }
}
</script>

<style lang="scss" scoped>
.input_search_member
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