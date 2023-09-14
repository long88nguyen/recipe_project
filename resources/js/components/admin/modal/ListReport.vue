<template>
    <table class="content-table">
                <thead>
                    
                        <tr>
                        <th>STT</th>
                        <th>Bình luận </th>
                        <th >Lượt báo cáo</th>
                        <th >Hoạt động</th>
                        
                    </tr>       
                </thead>            
                 <tbody>
                        
                        <template v-for="(item,index) in getReports.dataReport" :key="index">
                        <tr>
                            <td>1</td>
                            <td>{{ item.comment }}</td>
                            <td>{{ item.report }}</td>
                            <td><i class="fa-solid fa-trash" style="color:red" @click="confirmClick(item.id)"></i></td>
                        </tr>
                    </template>
                    </tbody>
               
                
                
          </table>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed:{
       ...mapGetters({
        getReports : "comments/getReport"
       })
       
    },
    created(){
        this.getData();
    },
    methods:{
        async getData(){
            await this.$store.dispatch('comments/getReport')
        },
        async confirmClick(id)
        {
            await this.$store.dispatch('comments/deleteComment',id).then(() => {
                this.$toast.success('Xóa bình luận thành công'),
                this.getData()
            }).catch(()=>{
                this.$toast.error('Đã xảy ra lỗi')
            })
        }
    }
}
</script>

<style lang="scss">
   .content-table{
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 15px;
  width: 100%; 
  margin : 0 auto;
  border-radius:15px 15px 0 0 ;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.15);
  thead{
    tr{
        background-color: #009879;
        color:#ffffff;
        font-weight: bold;
        th{
            padding:12px 15px;
            border:2px solid white;
            text-align: center;
        }
        th:first-child{
          border-top-left-radius: 15px;
        }
        th:last-child{
          border-top-right-radius: 15px;
        }
    }
  } 
  tbody{
    tr{
        border-bottom : 1px solid #dddddd;
        td{
            padding:12px 15px;
            text-align: center;
             border:2px solid white;

            img{
              height: 100px;
              width: 250px;
            }
            i{
              font-size:15px;
              margin: 0px 10px ;
              padding:15px;
              background: rgb(239, 237, 237);
              border-radius: 50%;
              color: white;
            }
        }
    }
    tr:nth-of-type(even)
    {
        background-color: #f3f3f3;
    }
    tr:last-of-type
    {
        border-bottom: 2px solid #009879;
    }
  }
}
</style>