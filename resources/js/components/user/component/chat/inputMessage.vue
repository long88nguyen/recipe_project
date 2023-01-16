<template>
        <div class="chat_button_panel">
            <input type="text"
                v-model ="message"
                @keyup.enter="sendMessage()"
                placeholder="Say something ..."
                class=""
            >
            <div class="button-side">
                <img src="../../../../uploads/send.png" @click="sendMessage()" alt="">
                
            </div>
           
        </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['room'],
    data(){
        return {
            message:'',
        }
    },
    methods:{
      async sendMessage(){
            if(this.message == ''){
                return;
            }
            await this.$store.dispatch('chats/sendMessage',{        
                id : this.room.id,
                message:this.message

            }).then(() =>{
                  this.message= '';
                    this.$emit('messagesent');
               
            }).catch(error =>{
                })
            
            
        }
    }
}
</script>

<style lang="scss">
.chat_button_panel{
    height: 40px;
    width: 100%;
    display: flex;
    input{
        width: 90%;
        height: 100%;
        outline: none;
        padding: 0 0 0 20px;
        border-radius: 20px;
        border: 1px solid silver;
    }
    .button-side{
        width: 10%;
        text-align: center;
        height: 40px;
        line-height: 40px;
        img{
            width: 30px;
            height: auto;
            text-align: center;
        }
    }
}
</style>