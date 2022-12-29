<template>
<div class="form_input-category">
    <form @submit.prevent="updateCategory" enctype="multipart/form-data">
        <div class="form_group">
        <label for="">Name</label>
        <input type="text" class="form-control" v-model="memberDetail.name">

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
                <img :src="`uploads/profile/${memberDetail.image}`" width="100" height="100" class="img-thumbnail" alt="" v-if="(showPreview == false)"/>
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
        return {
            category:{
                name:null,
                image:null,
            },
            imagePreview: null,
            showPreview: false,
        }
    },
    props:["id"],
    computed:{
        ...mapGetters({
            memberDetail:"members/memberDetail"
        })
    },
    created(){
        this.getEditMember();
    },
    methods:{
        async getEditMember(){
            await this.$store.dispatch('members/getMemberDetail',this.$props.id);
        },
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

            console.log("here");
            reader.readAsDataURL( this.category.image );
        }
            }
        },
    }
}
</script>

<style lang="scss">
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