<template>
    <div>
            <div class="input_search">
                <a-row>
                        <a-col :xl = "8" :lg = "8" :md = "8">
                            <div class="form-input">
                                <label for="">
                                    member name
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
                                    category name
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
                                    status
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
                <button class="btn btn-info"  @click.prevent="search">Search</button>
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

<style lang="scss">
.input_search
{
    .form-input{
        padding: 0 20px;
    }
    
}
.input_submit{
        text-align: center;
        margin-top: 10px;
}
</style>