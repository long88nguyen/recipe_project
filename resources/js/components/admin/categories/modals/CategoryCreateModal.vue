<template>
    <a-modal 
    class="add-timesheet-modal"
        v-model:visible="visible" 
        :footer = null
        centered
        title="Thêm mới danh mục" 
        >
        <div class="form_input-category">
            <form @submit.prevent="addCategory" enctype="multipart/form-data">
                <div class="form_group">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="category.name">
                </div>
                <div class="form-image-cate">
                    <div class="form_group">
                        <label for="">image</label>
                        <input type="file" class="form-control" id="imageCate" style="display:none"  @change ="onChange">
                    </div>
                    <div class="show-image">
                        <div class="show-image-upload">
                            <label for="imageCate">
                                Upload
                            </label>
                        </div>
                        <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
            
        </div>
    </a-modal>
</template>

<script>
export default {
    data(){
        return{
            category:{
                name:null,
                image:null,
            },
            imagePreview: null,
            showPreview: false,
        }
    },
    props:{
        visible:{
            type:Boolean,
            default:false,
        }
    },
    methods: {
        onChange(e)
        {
           this.category.image = e.target.files[0];
           let reader  = new FileReader();

            reader.addEventListener("load", function () {
            this.showPreview = true;
            this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.category.image ){

        if ( /\.(jpe?g|png|gif)$/i.test( this.category.image.name ) ) {

            reader.readAsDataURL( this.category.image );
        }
            }
        },
        async addCategory()     
        {
            let formData = new FormData();
            formData.append('name', this.category.name);
            formData.append('image', this.category.image);
            await this.$store.dispatch("categories/createCategory",formData)
            .then(() =>{
                this.$toast.success('Thêm mới thành công !');
                this.$emit("ok");
                this.$router.push({ path: "/categories" });
                this.category.name = null;
                this.category.image = null;
            })
            .catch(() => {
                this.$toast.error('Đã xảy ra lỗi !');
                
            })
        }
    },
}
</script>

<style lang="scss" scoped>
.form_input-category{
    padding:20px;
    .form-image-cate{
        .show-image{
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .show-image-upload{
                background: silver;
                width: 100px;
                height: 30px;
                text-align: center;
                line-height: 30px;
                border-radius: 15px;
                color: black;
            }
            .show-image-upload:hover{
                background: rgb(182, 180, 180);
                transition: 0.5s;
        }
        }
    }
}
</style>
<style lang="scss" scoped>
.add-timesheet-modal{
    .ant-modal-header {
    padding: 16px 24px;
    color: rgba(0, 0, 0, 0.65);
    background: #fff;
    border-bottom: 1px solid #e8e8e8;
    border-radius: 10px 10px 0 0;
    background-color: #d2d6ff;
    border-bottom-color: #3d4cdc;
    .ant-modal-title {
      color: #020519;
      font-weight: bold;
    }
  }.ant-modal {
    width: 100% !important;
    max-width: 684px;
  }
    .ant-modal-content {
    border-radius: 10px;
  }
  .ant-modal-close {
    outline: unset !important;
  }
  .ant-modal-close-x {
       line-height: 48px;
  }
  .popup_confirm-content{
    font-weight: bold;
  }
  .button_cofirm{
    margin-top:20px;
    display: flex;
    justify-content: flex-end;
    button{
        margin:0 5px;
    }
  }
}
</style>