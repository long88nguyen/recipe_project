<template>
    <div class="form_input-category">
            <form @submit.prevent="updateCategory" enctype="multipart/form-data">
                <div class="form_group">
                <label for="">Name</label>
                <input type="text" class="form-control" v-model="CategoryDetail.name">
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
                        <img :src="`uploads/category/${CategoryDetail.image}`" width="100" height="100" class="img-thumbnail" alt="" v-if="(showPreview == false)"/>
                        <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
     data(){
        return{
            forms:{
                id: "",
                name:'',
                image:null,
            },
            imagePreview: null,
            showPreview: false,
        }
    },
    async created(){
        await this.$store.dispatch("categories/getCategoryDetail",this.$props.id)
    },
    props:["id"],
    computed:{
        ...mapGetters({
            CategoryDetail:"categories/categoryDetail",
        })
    },
    methods:{
        onChange(e)
        {
           this.forms.image = e.target.files[0];
           let reader  = new FileReader();

            reader.addEventListener("load", function () {
            this.showPreview = true;
            this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.forms.image ){

        if ( /\.(jpe?g|png|gif)$/i.test( this.forms.image.name ) ) {

            console.log("here");
            reader.readAsDataURL( this.forms.image );
        }
            }
        },
        async updateCategory()
        {
            let formData = new FormData();
            for(let key in this.forms)
            {
                
                let data = this.CategoryDetail[key] !== undefined ? this.CategoryDetail[key] : "";
                formData.append(key, data);
            }
            formData.append('image', this.forms.image); 
            await this.$store.dispatch("categories/updateCategory",formData)
            .then(() =>{
                this.$toast.success('Thêm mới thành công !');
                this.$emit("ok");
                this.$router.push({ path: "/categories" });
            })
            .catch(() => {
                this.$toast.error('Đã xảy ra lỗi !');
                console.log("errorr");
                
            })
        }
        
    }
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