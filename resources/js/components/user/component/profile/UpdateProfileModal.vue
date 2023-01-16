<template>
<div class="form_input-category">
    <form @submit.prevent="updateProfile" enctype="multipart/form-data">
        <div class="form_group">
            <label for="">Name</label>
            <input type="text" class="form-control" v-model="memberDetail.name">
        </div>

        <div class="form_group">
            <label for="">Birthday</label>
            <input type="date" class="form-control" v-model="memberDetail.birthday" >
        </div>

        <div class="form_group">
            <label for="">Phone number</label>
            <input type="text" class="form-control" v-model="memberDetail.phone">
        </div>
        <div class="form-group">
            <label for="">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="0" v-model="memberDetail.gender"/>
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="1" v-model="memberDetail.gender">
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
            </div>
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
                <img :src="memberDetail.avatar" width="100" height="100" class="img-thumbnail" alt="" v-if="(showPreview == false)"/>
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
import moment from 'moment';
import { mapGetters } from 'vuex';
export default {
    data(){
        return {
            forms:{
                id:"",
                name:"",
                phone:"",
                avatar:null,
                birthday:"",
                gender:"",

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
           this.forms.avatar = e.target.files[0];
           let reader  = new FileReader();

            reader.addEventListener("load", function () {
            this.showPreview = true;
            this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.forms.avatar ){

        if ( /\.(jpe?g|png|gif)$/i.test( this.forms.avatar.name ) ) {

            reader.readAsDataURL( this.forms.avatar );
        }
            }
        },
        async updateProfile(){

            let formData = new FormData();
            for(let key in this.forms)
            {
                
                let data = this.memberDetail[key] !== undefined ? this.memberDetail[key] : "";
                formData.append(key, data);
            }
            formData.append('avatar', this.forms.avatar); 

            await this.$store.dispatch('members/updateMember',formData).then(() => {
                this.$toast.success("Update profile success!");
                this.$emit("ok");
                this.$router.push({ path: "/profile" });
                this.$store.dispatch('common/getUserCommon')
            }).catch(() =>{
                this.$toast.error('Đã xảy ra lỗi !');
            })
        } 
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
    .form_group{
            margin:15px 0;
        }
}
</style>