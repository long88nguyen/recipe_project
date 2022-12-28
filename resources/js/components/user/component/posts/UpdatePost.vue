<template>
    <div class="create_post">
      <div class="create_post_container">
          <div class="create_post_detail">
              <h4>Tạo mới món ăn</h4>
              <form action=""  @submit.prevent="registerOverTimeRequest">
                <div class="create_post-header">
                  <a-row>
                      <a-col :xxl="14" :xl="14" :lg="14">
                        <div class="form-ingredient">
                          <label for="">title</label>
                          <div class="form-group">
                            <textarea :rows="2" type="text" class="form-control" v-model="getPostDetail.title"></textarea>
                            
                          </div>
                        </div>
                        <div class="form-ingredient">
                          <label for="">content</label>
                          <div class="form-group">
                            <textarea :rows="4" type="text" class="form-control" v-model="getPostDetail.content"></textarea>
                            {{ fileList }}
                          </div>
                        </div>
                        <div class="form-ingredient">
                          <label for="">Cateogry</label>
                          <div class="form-group">
                            <select class="form-control" v-model="getPostDetail.category_id">
                              <template v-for="(option,index) in getAllcategory" :key="index">
                                <option :value="option.id">{{option.name}}</option>
                              </template>
                               
                            </select>
                            
                          </div>
                        </div>
                       
                        <div class="form-ingredient">
                          <label for="">Ingredient</label>
                          <div class="form-group" v-for="(input,k) in getPostDetail.ingredients" :key="k">
                            
                            <input type="text" class="form-control" v-model="input.name" />
                                <span>
                                  <div
                                    class="fas fa-minus-circle"
                                    @click="removeIngredient(k)"
                                    v-show="k || ( !k && getPostDetail.ingredients.length > 1)"
                                  ></div>
                                  <div
                                    class="fas fa-plus-circle"
                                    @click="addIngredient(k)"
                                    v-show="k == getPostDetail.ingredients.length-1"
                                  >
                                  </div>
                                </span>
                          </div>
                        </div>
                        <div class="form-ingredient">
                          <label for="">Direction</label>
                          <div class="form-group" v-for="(input,k) in getPostDetail.directions" :key="k">
                            <textarea :placeholder="'Step ' + k" :rows="4" type="text" class="form-control" v-model="input.description" ></textarea>
                                <span>
                                  <div
                                    class="fas fa-minus-circle"
                                    @click="removeDirection(k)"
                                    v-show="k || ( !k && getPostDetail.directions.length > 1)"
                                  ></div>
                                  <div
                                    class="fas fa-plus-circle"
                                    @click="addDirection(k)"
                                    v-show="k == getPostDetail.directions.length-1"
                                  >
                                  </div>
                                </span>
                          </div>
                        </div>
  
                        <div class="form-ingredient">
                          <label for="">Time</label>
                          <div class="form-group">
                            <input  type="text" class="form-control" v-model="getPostDetail.time"/>
                            
                          </div>
                        </div>

                        <div class="form-ingredient">
                          <label for="">Nutritions fact</label>
                          <div class="form-group">
                            <textarea :rows="2" type="text" class="form-control" v-model="getPostDetail.nutrition_facts"></textarea>
                            
                          </div>
                        </div>
                        <div class="form-ingredient">
                          <label for="">Note</label>
                          <div class="form-group">
                            <textarea :rows="2" type="text" class="form-control" v-model="forms.note"></textarea>
                            
                          </div>
                        </div>
                      </a-col>
                      <a-col :xxl="10" :xl="10" :lg="10">
                        <div class="form-image">
                          <div class="form-upload">
                              <label for="">Image</label>
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
                                      Click upload <i class="fa-solid fa-cloud-arrow-up"></i>
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
                        </div>            
                     
                      </a-col>
                  </a-row>
                  <button type="submit" class="btn btn-outline-success text-center">
                      Tạo mới món ăn
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
        errorFileMessage: "",
        imageType: [
          "image/jpeg",
          "image/jpg",
          "image/png",
          "image/PNG",
          "image/JPG",
        ],
        uploadImageMessage: "",
        isImage: true,
        image_evidence: [],
        image_name: [],
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
        getPostDetail:"posts/getPostDetail",
        getPostDetailMember:"posts/getPostDetailMember",
        getAllcategory:"categories/getAllcategory"
      })
    },  
    async created(){
      await this.$store.dispatch('posts/detailPostUser',this.$route.params.id);
      

      this.$store.dispatch('categories/getAllCategories')
    },
    methods:{
        addIngredient () {
      this.getPostDetail.ingredients.push({
        name:""
      })
    },

    removeIngredient (index) {
      this.getPostDetail.ingredients.splice(index, 1)
    },
    
    addDirection () {
      const hello =  1;
      this.getPostDetail.directions.push({
        desc:"",
      })
    },

    removeDirection (index) {
      this.getPostDetail.directions.splice(index, 1)
    },
   
    
    }
  };  
  </script>
  
  <style lang="scss">
  .create_post{
      width: 100%;
      margin-top:200px;
      
      .create_post_container
      {
          width: 70%;
          margin:0 auto;
          background: white;
          .create_post_detail{
            padding: 30px;
            .form-ingredient{
              margin-top:10px;
              .form-group{
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
  </style>
  
  