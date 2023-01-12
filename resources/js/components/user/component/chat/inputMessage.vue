<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6" style="border-top:1px solid #e6e6e6">
            <input type="text"
                v-model ="message"
                @keyup.enter="sendMessage()"
                placeholder="Say something ..."
                class="col-span-5 outline-none p-1"
            >
            <button
                @click="sendMessage()"
                class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 "
            >
            Send
            </button>
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
                    console.log(error)
                })
            
            
        }
    }
}
</script>

<style>

</style>