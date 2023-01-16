<template>
  <div class="create_post_new">
    <div class="create_post_container">
        <div class="create_post_detail">
            <div class="breadcumb-field">
              <a-breadcrumb>
              <a-breadcrumb-item><router-link to="/home-page">Trang chủ</router-link></a-breadcrumb-item>
              <a-breadcrumb-item><router-link to="/create-post">Tạo mới bài viết</router-link></a-breadcrumb-item>
              </a-breadcrumb>
          </div>
            <h4>Tạo bài viết mới</h4>
            <form action=""  @submit.prevent="registerOverTimeRequest">
              <div class="create_post-header">
                <a-row>
                    <a-col :xxl="14" :xl="14" :lg="14" :xs="24">

                     <div class="form-ingredient"> 
                        <label for="">Tiêu đề <span class="validate_feedback">*</span></label>
                        <div class="form-group">
                          <textarea :rows="3" 
                          type="text" 
                          class="form-control" 
                          v-model="forms.title"
                          @blur="validate()"
                          :class="{'is-invalid' : errors.title }"
                          >
                        </textarea>                        
                        </div>
                        <div class="validate_feedback">{{ errors.title }}</div>
                      </div>

                      <div class="form-ingredient">
                        <label for="">Mô tả <span class="validate_feedback">*</span></label>
                        <div class="form-group">
                          <textarea :rows="3" type="text" 
                          class="form-control" 
                          v-model="forms.content"
                          @blur="validate()"
                          :class="{'is-invalid' : errors.content }"
                          ></textarea>     
                        </div>
                        <div class="validate_feedback">{{ errors.content }}</div>
                      </div>

                      <div class="form-ingredient">
                        <label for="">Danh mục <span class="validate_feedback">*</span></label>
                        <div class="form-group">
                          <select class="form-control" v-model="forms.category_id"
                          @change="validate()"
                          :class="{'is-invalid' : errors.category_id }"
                          >
                            <option value="">-- Chọn danh mục --</option>
                            <template v-for="(option,index) in getAllcategory" :key="index">
                              <option :value="option.id">{{option.name}}</option>
                            </template>
                             
                          </select>
                          
                        </div>
                        <div class="validate_feedback">{{ errors.category_id }}</div>
                      </div>



                      <div class="form-ingredient">
                        <label for="">Thành phần <span class="validate_feedback">*</span></label>
                        <div class="form-group" v-for="(input,k) in forms.ingredients" :key="k">
                          <input type="text" class="form-control" v-model="input.name" 
                          @blur="validate()"
                          :class="{'is-invalid' : errors.ingredients }"
                          />
                              <span>
                                <div
                                  class="fas fa-minus-circle"
                                  @click="removeIngredient(k)"
                                  v-show="k || ( !k && forms.ingredients.length > 1)"
                                ></div>
                                <div
                                  class="fas fa-plus-circle"
                                  @click="addIngredient(k)"
                                  v-show="k == forms.ingredients.length-1"
                                >
                                </div>
                              </span>
                        </div>
                        <div class="validate_feedback">{{ errors.ingredients }}</div>
                      </div>

              
                        
                      <div class="form-ingredient">
                        <label for="">Các bước thực hiện <span class="validate_feedback">*</span></label>
                        <div class="form-group" v-for="(input,k) in forms.directions" :key="k">
                          <textarea :placeholder="'Bước ' + (k+1)" :rows="4" type="text" class="form-control" v-model="input.desc"       
                          @blur="validate()"
                          :class="{'is-invalid' : errors.directions }"></textarea>
                              <span>
                                <div
                                  class="fas fa-minus-circle"
                                  @click="removeDirection(k)"
                                  v-show="k || ( !k && forms.directions.length > 1)"
                                ></div>
                                <div
                                  class="fas fa-plus-circle"
                                  @click="addDirection(k)"
                                  v-show="k == forms.directions.length-1"
                                >
                                </div>
                              </span>
                        </div>
                        <div class="validate_feedback">{{ errors.directions }}</div>
                      </div>

                      <div class="form-ingredient">
                        <label for="">Thời gian thực hiện <span class="validate_feedback">*</span></label>
                        <div class="form-group">
                          <input  type="text" 
                          class="form-control" 
                          v-model="forms.time"
                          @blur="validate()"
                          :class="{'is-invalid' : errors.time }"
                          />
                        </div>
                        <div class="validate_feedback">{{ errors.time }}</div>
                      </div>

                      <div class="form-ingredient">
                        <label for="">Thành phần dinh dưỡng (nếu có)</label>
                        <div class="form-group">
                          <textarea :rows="2" type="text" class="form-control" v-model="forms.nutrition_facts"></textarea>
                          
                        </div>
                      </div>

                      <div class="form-ingredient">
                        <label for="">Ghi chú </label>
                        <div class="form-group">
                          <textarea :rows="2" type="text" class="form-control" v-model="forms.note"></textarea>
                          
                        </div>
                      </div>
                    </a-col>
                  <a-col :xxl="10" :xl="10" :lg="10" :xs="24">
                      <div class="form-image">
                        <div class="form-upload">
                            <label for="">Ảnh sản phẩm <span class="validate_feedback">*</span></label>
                            <div class="file_input_wrap" style="display: none">
                              <input
                                  type="file"
                                  class="form-control-file mb-1"
                                  v-on:change="onImageChange"
                                  id="fileImage"
                                  multiple
                                  />
                            </div>
                            <div class="file_input_button">
                              <label for="fileImage" class="">
                                  <div class="">
                                    Tải ảnh lên  <i class="fa-solid fa-cloud-arrow-up"></i>
                                  </div>
                              </label>
                            </div>
                            <span v-if="!isImage" class="error image required">
                            {{ errorFileMessage }}
                            </span>
                            <div
                              class="img__name mb-1"
                              v-for="(data, index) in image_name"
                              :key="index"
                              >
                                {{ data }}
                              <div class="img-btn__close" @click="removeImage(index)">
                                  <div class="image_delete">
                                    <i class="fa-solid fa-trash"></i>
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div v-if="image_evidence.length > 0" class="showImg">
                            <img
                              v-for="(data, index) in image_evidence"
                              :key="index"
                              class="image-evidence"
                              :src="data"
                              width="100"
                              height="100"
                              /> 
                        </div>
                        <div v-else>
                        </div>
                        <div class="validate_feedback">{{ errors.img_evidence }}</div>
                      </div>            
                   
                    </a-col>
                </a-row>
                <button type="submit" class="btn btn-outline-success text-center mt-3">
                    Tạo mới bài viết
                </button>
            </div>
            </form>
        </div>  
        
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      errors:[],
      errorFileMessage: "",
      imageType: [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/PNG",
        "image/JPG",
      ],
      isImage: true,
      image_evidence: [],
      image_name: [],
      errors:{
        img_evidence: "",
        category_id:"",
        title:"",
        content:"",
        time:"",
        ingredients:"",
        directions:"",

      },
      forms: {
        img_evidence: [],
        category_id:"",
        title:"",
        content:"",
        time:"",
        nutrition_facts:"",
        note:"",
        ingredients: [
        {
        name:""
         }],
        directions: [
          {
          desc:"",
        }],
      },
     
      
    };
  },
  computed:{
    ...mapGetters({
      getAllcategory:"categories/getAllcategory"
    })
  },  
  created(){
    this.$store.dispatch('categories/getAllCategories')
  },
  methods: {
    addIngredient () {
      this.forms.ingredients.push({
        name:""
      })
    },

    removeIngredient (index) {
      this.forms.ingredients.splice(index, 1)
    },
    
    addDirection () {
      const hello =  1;
      this.forms.directions.push({
        desc:"",
      })
    },

    removeDirection (index) {
      this.forms.directions.splice(index, 1)
    },
   
    onImageChange(e) {
      if (e.target.files.length + this.forms.img_evidence.length > 2) {
        this.errorFileMessage = "Vui lòng chọn tối đa 2 ảnh";
        this.isImage = false;
        return;
      }
      let file = e.target.files[0];
      let file2 = e.target.files[1];
      if (
        e.target.files[0] &&
        !this.imageType.includes(e.target.files[0].type)
      ) {
        console.log(2);

        this.isImage = false;
        this.forms.img_evidence = [];
        this.errorFileMessage = this.$t("error.img_type");
        return;
      }
      if (
        e.target.files[1] &&
        !this.imageType.includes(e.target.files[1].type)
      ) {
        this.isImage = false;
        this.forms.img_evidence = [];
        this.errorFileMessage = this.$t("error.img_type");
        return;
      }
      if (file !== undefined) {
        console.log(1);
        let fileName = file.name;
        this.image_evidence.push(URL.createObjectURL(file));
        this.forms.img_evidence.push(file);
        console.log(this.image_evidence);
        this.image_name.push(fileName);
      }
      if (file2 !== undefined) {
        let fileName2 = file2.name;
        this.image_evidence.push(URL.createObjectURL(file2));
        this.forms.img_evidence.push(file2);
        this.image_name.push(fileName2);
      }
      this.errorFileMessage = null;
      this.isImage = true;
    },
    removeImage(index) {
      this.forms.img_evidence.splice(index, 1);
      this.image_evidence.splice(index, 1);
      this.image_name.splice(index, 1);
    },

    validate(){
        this.errors = {
          img_evidence: "",
          category_id:"",
          title:"",
          content:"",
          time:"",
          ingredients:"",
          directions:"",
          
        }
        let isValid = true;
        if(!this.forms.title)
        {
          this.errors.title = "Tiêu đề là bắt buộc"
          isValid = false
        }
        
        if(!this.forms.category_id)
        {
          this.errors.category_id = "Vui lòng chọn 1 danh mục"
          isValid = false
        } 

        if(this.forms.title.length > 255)
        {
          this.errors.title = "Tiêu đề quá dài (tối đa 255 ký tư)"
          isValid = false
        }

        if(!this.forms.content)
        {
          this.errors.content = "Mô tả là bắt buộc"
          isValid = false
        }  

        else if(this.forms.content.length > 255)
        {
          this.errors.content = "Mô tả quá dài (tối đa 255 ký tư)"
          isValid = false
        }

        if(!this.forms.time)
        {
          this.errors.time = "Thời gian thực hiện là bắt buộc"
          isValid = false
        }

        else if(!this.isNumber(this.forms.time))
        {
          this.errors.time = "Thời gian nhập sai định dạng (0-9)"
          isValid = false
        }
        if( this.forms.img_evidence.length == 0)
        {
          this.errors.img_evidence = "Chọn tối thiểu một ảnh"
          isValid = false
        }

        if(this.forms.directions[0].desc == "")
        {
          this.errors.directions = "Vui lòng nhập các bước thực hiện"
          isValid = false 
        }
        
        
        else if(this.forms.directions[0].desc.length > 255)
        {
          this.errors.directions = "Các bước thực hiện quá dài ( tối đa 255 ký tự)"
          isValid = false
        }
        console.log(this.forms.directions[0].desc.length)

        if(this.forms.ingredients[0].name == "")
        {
          this.errors.ingredients = "Vui lòng nhập nguyên liệu" 
          isValid = false
        }

        return isValid

    },

    isNumber(value){
      return /^\d*$/.test(value)
    },
    async registerOverTimeRequest()
    {
      console.log(this.validate());
      if(this.validate()){
        let formData = new FormData();
      for (let key in this.forms) {
        // console.log(key);
        if (key === "img_evidence") {
          if (this.forms.img_evidence && this.forms.img_evidence.length > 0) {
            for (let i = 0; i < this.forms.img_evidence.length; i++) {
              formData.append(`img_evidence[${i}]`, this.forms.img_evidence[i]);
            }
          }
        } else {
          formData.append(key, this.forms[key]);
        }
        for (let i = 0; i < this.forms.ingredients.length; i++) {
              formData.append(`ingredients[${i}]`, this.forms.ingredients[i].name);
          }
        for (let i = 0; i < this.forms.directions.length; i++) {
            formData.append(`directions[${i}]`, this.forms.directions[i].desc);
        }
      }
      await this.$store
        .dispatch("posts/createPost", formData)
        .then(() => {
          this.$router.push({ path : "/home-page"})
          this.$toast.success("Tạo mới bài viết thành công, vui lòng chờ duyệt!")
        })
        .catch(() => {
          this.$toast.error("Error! Please check again !")
        });
      }
    }, 

  },
};  
</script>

<style lang="scss">
.create_post_new{
    width: 100%;
    padding-top:200px;
    background: #f4f9f6;
    font-family: 'Roboto', sans-serif ;;
    .create_post_container
    {

        width: 70%;
        margin:0 auto;
        background: white;
        .create_post_detail{
          .breadcumb-field{
            margin-bottom : 10px;
          }
          padding: 30px;
          .form-ingredient{
            margin:20px 0;
            .form-group{
              margin:0px;
              padding: 5px 10px 5px 0px;
              display: flex;
              align-items: center;
              input{
                width: 80%;
              }
              textarea{
                width: 80%;
              }
              select{
                width: 80%;
              }
              span{
                width: 20%;
                height: 40px;
                line-height: 40px;
                margin-left: 5px;
                font-size: 25px;
                .fa-minus-circle{
                  color:red;
                }
                .fa-plus-circle{
                  margin-left:5px;
                  color:blue
                }
              }
            }
          }
       
        } 
    }
}

.form-image{
    .form-upload{
      .file_input_button{
      width: 150px;
      height: 40px;
      background: rgb(219, 216, 216);
      border-radius: 20px;
      text-align: center;
      line-height: 40px;
      margin-top: 10px;
    }
    .file_input_button:hover{
      cursor: pointer;
      border:1px solid blue;
      transition : 0.5s;
     }
     .img__name{
        display: flex;
        justify-content: space-between;
        padding: 20px 20px 10px 0;
        i{
          font-size: 15px;
          color:red;
          cursor: pointer;
        }
      
     }
    }
    .showImg{
      img{
        border: 1px solid blue;
        margin-right:5px;
      }
    }
           
}
.validate_feedback{
              color:red;
              font-size: 12px;
            }
@media (max-width: 520px)
{
  .create_post_new{
    .create_post_container{
      width: 96%;
      .create_post_detail{
        padding: 10px;
        .form-ingredient {
          width: 100%;
          .validate_feedback{
              color:red;
              font-size: 12px;
            }
          .form-group{
           
            textarea{
              width: 100%;
            }
            input{
              width: 100%;
            }
            select{
              width: 100%;
            }
            span{
              width: 20px;
            };
          }
        }
      }
    }
  }
}

</style>

