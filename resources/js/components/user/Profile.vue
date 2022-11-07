<template>
    <a-modal
                title="Chỉnh sửa trang cá nhân"
                :visible="visible"
                :confirm-loading="confirmLoading"
                @ok="handleOk"
                @cancel="handleCancel"
                >
                <a-form :model="formState" :label-col="labelCol" :wrapper-col="wrapperCol">
                    <a-form-item >
                        <label for="">Họ tên</label>
                        <a-input />
                    </a-form-item>
                    <a-form-item class="form_label">
                        <label for="">Giới tính</label>
                        <a-select  placeholder="please select your zone">
                            <a-select-option value="shanghai">Nam</a-select-option>
                            <a-select-option value="beijing">Nữ</a-select-option>
                        </a-select>
                    </a-form-item>
                    <a-form-item>
                        <label for="">Ngày sinh</label>
                        <a-date-picker
                            show-time
                            type="date"
                            placeholder="Chọn ngày sinh"
                            style="width: 100%"
                            />
                    </a-form-item>
                    <a-form-item>
                        <label for="">Ghi chú</label>
                        <a-input type="textarea" />
                    </a-form-item>
                </a-form>
    </a-modal>
  <div class="profile_page">
    <div class="profile_container">
        <div class="profile_account">
            
            <img src="../../uploads/images/avatar1.jpg" alt="">
            <div class="profile_account-detail">
                <h1>Long nguyen</h1>
                <h3>@longnguyen</h3>
            </div>
        </div>
        <div class="profile_button">
            <button class="btn btn-outline-primary" @click="showModal">Chỉnh sửa thông tin cá nhân</button>
           
            <router-link class="btn btn-outline-info " style="margin-left:10px" to="/create-post">Tạo bài viết</router-link>
        </div>
       
        <div class="profile_tab">
        <a-tabs default-active-key="1" @change="callback">
            <a-tab-pane key="1" tab="Bài viết đã đăng">
                Bài viết đã đăng
                <a-row>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/fishfood2.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                            Món cá
                            </h5>
                            <h4 class="card_category">
                               Cá chiên
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/eggfood1.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                            Món Trứng
                            </h5>
                            <h4 class="card_category">
                                Trứng ốp
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/eggfood.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                           Món Trứng
                            </h5>
                            <h4 class="card_category">
                                Trứng ốp la
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    
                </a-row>
            </a-tab-pane>
            <a-tab-pane key="2" tab="Bài viết đã thích" force-render>
                Bài viết đã thích
                <a-row>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/meatfood1.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                            Món Thịt bò
                            </h5>
                            <h4 class="card_category">
                                Thit bò sốt
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/meatfood.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                            Món thịt bò
                            </h5>
                            <h4 class="card_category">
                               Bít tết
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    <a-col :xxl="6" :xl="6" :lg="6" :md="6" :xs="6">
                    <div class="card_item">
                            <img src="../../uploads/images/fishfood3.jpg" alt="" class="card_img">
                            <div class="card_heart">
                                <i class="fa-regular fa-heart"></i>
                            </div>
                        
                            <h5 class="card_title">
                            Món cá
                            </h5>
                            <h4 class="card_category">
                                Cá chiên
                            </h4>
                            <div class="card-rating">
                                <div class="card_star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                            
                                <h5>4.5</h5>
                            </div>
                    </div>    
                    </a-col>
                    
                </a-row>
            </a-tab-pane>   
        </a-tabs>
        </div>
        
    </div>
  </div>
</template>

<script>
export default {
    data() {
    return {
        ModalText: 'Content of the modal',
        visible: false,
        confirmLoading: false,
    };
    },
    methods: {
        callback(key) {
        console.log(key);
        },
        showModal() {
      this.visible = true;
    },
        handleOk(e) {
        this.ModalText = 'The modal will be closed after two seconds';
        this.confirmLoading = true;
        setTimeout(() => {
            this.visible = false;
            this.confirmLoading = false;
        }, 2000);
        },
        handleCancel(e) {
        console.log('Clicked cancel button');
        this.visible = false;
        },
    },
}   
</script>

<style lang="scss">
.profile_page{
    width: 100%;
    margin-top:200px;
   font-family: Arial, Helvetica, sans-serif;
    .profile_container
    {
        border-radius:10px;
        background: white;
        height: 1000px;
        width: 70%;
        margin:0 auto;
        .profile_tab{
            padding:20px;
            .card_item{
            width: 90%;
            height: 300px;
            border-radius:5px;
            transition: 0.3s;
            background: white; 
            margin: 10px 5px; 
            box-shadow:2px 1px gray;

            img{
                width: 100%;
                height: 150px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                top:0;
                position: relative;

            }
           
           .card_heart{
                width: 30px;
                height: 30px;
                background: orange;
                position: absolute;
                top:15px;
                left:10px;
                font-size: 20px;
                border-radius: 50%;
                i
                {
                    display: flex;
                    justify-content: center;
                    line-height: 30px;
                }
            }
            h4{
                font-size: 24px;
                padding:0px 10px 0 10px;
               
            }
            h5{
                font-size:18px;
                padding:10px
            }
            .card-rating
            {
                width: 100%;
                height: 40px;
                line-height: 40px;
                display: flex;
                .card_star
                {
                    padding:0px 10px 0 10px;
                    i{
                        color: #d54215;
                        padding: 0px 5px 0 0;
                    }
                }
                
            }
        }
        .card_item:hover{
            box-shadow:2px 1px gray;
            transition: 0.3s;
        }
        }
        .profile_account
        {   display: flex;
            padding:20px;
            position: relative;
            img{
                width: 80px;
                height: 80px;
                border-radius:50%;
            }
            .profile_account-detail
            {
                margin-left:20px;
                h1{
                font-size:24px;
            }
                h3{
                    font-size:16px;
                    font-weight: 200;
                }
            }
           
        }
        .profile_button{
            position: absolute;
            right: 241px;
             top: 210px;
        }
    }
    
}
</style>