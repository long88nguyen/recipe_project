<template>
  <div class="create_post">
    <div class="create_post_container">
        <div class="create_post_detail">
            <h4>Tạo mới món ăn</h4>
            <div class="create_post-header">
                <a-row>
                    <a-col :xxl="14" :xl="14" :lg="14">
                        <div class="create_post-title">
                            <label for="">Tên chủ đề</label>
                            <a-textarea
                            placeholder="Nhập tên chủ đề ... "
                            :auto-size="{ minRows: 4, maxRows: 4 }"
                            />
                        </div>
                        <div class="create_post-description">
                            <label for="">Mô tả</label>
                            <a-textarea
                            placeholder="Nhập mô tả ... "
                            :auto-size="{ minRows: 3, maxRows: 3 }"
                            />
                        </div>  
                        <div class="create_post-ingre">
                            <label for="">Nhập nguyên liệu</label>
                            <a-input class="ingre_input"/>
                            <a-input class="ingre_input"/>

                            <a-input class="ingre_input"/>

                            <a-input class="ingre_input"/>
                            <a-input class="ingre_input"/>
                            <a-input class="ingre_input"/>
                            <a-input class="ingre_input"/>

                            
                        </div>   
                        <div class="create_post-direction">
                            <label for="">Nhập các bước thực hiện</label>
                            
                            <a-textarea
                            class="direction_input"
                            placeholder="Bước 1 ... "
                            :auto-size="{ minRows: 2, maxRows: 2 }"
                            />
                            <a-textarea
                            class="direction_input"
                            placeholder="Bước 2 ... "
                            :auto-size="{ minRows: 2, maxRows: 2 }"
                            />
                            <a-textarea
                            class="direction_input"
                            placeholder="Bước 3 ... "
                            :auto-size="{ minRows: 2, maxRows: 2 }"
                            />

                            
                        </div>                         
                    </a-col>
                    <a-col :xxl="10" :xl="10" :lg="10">
                        <div class="create_post-img">
                            <label for="">Chọn ảnh</label>
                        <div class="clearfix">
                            <a-upload
                            action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
                            list-type="picture-card"
                            :file-list="fileList"
                            @preview="handlePreview"
                            @change="handleChange"
                            >
                            <div v-if="fileList.length < 8">
                                <a-icon type="plus" />
                                <div class="ant-upload-text">
                                Upload
                                </div>
                            </div>
                            </a-upload>
                            <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
                                    <img alt="example" style="width: 100%" :src="previewImage" />
                            </a-modal>
                        </div>
                        </div>
                        
                    </a-col>
                </a-row>
                <button class="btn btn-outline-success text-center">
                    Tạo mới món ăn
                </button>
            </div>
        </div>  
        
    </div>
  </div>
</template>

<script>
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
}
export default {
  data() {
    return {
      previewVisible: false,
      previewImage: '',
      fileList: [
        
      ],
    };
  },
  methods: {
    handleCancel() {
      this.previewVisible = false;
    },
    async handlePreview(file) {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
      }
      this.previewImage = file.url || file.preview;
      this.previewVisible = true;
    },
    handleChange({ fileList }) {
      this.fileList = fileList;
    },
  },
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
        .create_post_detail
        {
            padding:30px;
            .create_post-header{
                label{
                    margin-top:20px;
                }
            }
            .create_post-header
            {
                .ingre_input{
                    margin:10px 0px;
                }
            }
            .create_post-direction
            {
                .direction_input{
                    margin: 10px 0;
                }
            }
        }
        .create_post-img{
            margin-left:10px;
        }
    }
}
</style>