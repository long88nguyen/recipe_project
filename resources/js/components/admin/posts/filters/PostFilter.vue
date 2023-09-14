<template>
    <div>
            <div class="input_search">
                <a-row>
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    Nguời đăng
                                </label> 
                                <input type="text" class="form-control" 
                                v-model="member_name"
                                @change="search"
                                v-on:keyup.enter="search"
                                >
                            </div>
                        </a-col>
                    
                    
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    Danh mục
                                </label>
                                <input type="text" class="form-control" 
                                v-model="category_name"
                                @change="search"
                                v-on:keyup.enter="search"
                                >
                            </div>
                        </a-col>
                    
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    Trạng thái
                                </label>
                                <select name="" id="" class="form-control" v-model="status" @change="search">
                                    <option value="">Tất cả</option>
                                    <option value="1">Chờ duyệt</option>
                                    <option value="2">Đã duyệt</option>
                                    <option value="3">Tù chối</option>
                                </select>
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
            status:'',
            category_name:'',
            member_name:'',
        }
    },
    methods:{
        search() {
            this.$emit("search", {
                status: this.status,
                member_name: this.member_name,
                category_name: this.category_name
            });
        },
    }
}
</script>

<style lang="scss" scoped>
.input_search
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