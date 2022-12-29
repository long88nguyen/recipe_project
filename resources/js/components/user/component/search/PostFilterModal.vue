<template>
     <a-modal 
            class="add-timesheet-modal"
            v-model:visible="visibleSearch" 
            title="Bộ lọc" 
            @ok="handleOk" 
            @cancel="handleCancel"
            :footer = null
            centered
            >
                <form action="">
                    <div class="form-group">
                        <label for="">Nhập tên nguyên liệu</label>
                        <input type="text" class="form-control"  v-model="ingredient_name">
                    </div>
                    <div class="form-group">
                        <label for="">Nhập tên tác giả</label>
                        <input type="text" class="form-control"  v-model="member_name">
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục</label>
                        <input type="text" class="form-control"  v-model="category_name">
                    </div>
                    <button class="btn btn-primary mt-3"   @click.prevent="search">Tìm kiếm</button>   
                </form>
        </a-modal>
</template>

<script>
export default {
    data(){
        return{
            ingredient_name:"",
            member_name:"",
            category_name:"",
        }
    },
    props:{
    visibleSearch:{
            type:Boolean
        }   
    },
    methods:{
        handleOk() {
            this.$emit('ok');
            this.ingredient_name="",
            this.member_name="",
            this.category_name="";
        },
        handleCancel(e) {
            this.$emit('cancel', e);
            this.ingredient_name="",
            this.member_name="",
            this.category_name="";
        },
        search(){
            this.$emit("search",{
                ingredient_name:this.ingredient_name,
                member_name:this.member_name,
                category_name:this.category_name,
            }),
            this.ingredient_name="",
            this.member_name="",
            this.category_name="";
        }
    }

}
</script>

<style>
.form-group{
    margin:15px 0;
}
</style>