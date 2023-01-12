<template>
    <div class="chat_side">
        <div class="chat_container">
            <!-- <chatRoomSelection
            v-if="currentRoom.id"
            :rooms="chatRooms"
            :currentRoom = "currentRoom"
            @roomchanged = setRoom($event)
            /> -->
            <div class="chat_pannel">

                <div class="chat_message">
                    <messageContainer
                        :messages = "messages"
                        />
                </div>
               
                
            <div class="chat_button">
                <inputMessage :room = "currentRoom"
                            @messagesent = "getMessages()"
                />
            </div>
                

            </div>
            
        </div>
        
    </div>
   </template>
   
<script>
import messageContainer from './messageContainer.vue';
import inputMessage from './inputMessage.vue';
import chatRoomSelection from './chatRoomSelection.vue';

import axios from 'axios';
import { mapGetters } from 'vuex';
export default {
    components:{
        messageContainer,
        inputMessage,
        chatRoomSelection
    },
    data(){
        return{
            chatRooms:[],
            currentRoom:[],
            messages:[],
        }
    },
    watch:{
        currentRoom(val,oldVal){
            if(oldVal.id)
            {
                this.disconnect(oldVal)
            }
            this.connect();
        }
    },
    computed:{
        ...mapGetters({
            getAllRoom : "chats/getAllRoom",
            getRoomById:"chats/getRoomById"
        })
    },
    methods:{
        connect(){
            if(this.currentRoom.id)
            {
                let vm = this;
                this.getMessages();
                window.Echo.private("chat." + this.currentRoom.id).listen('.message.new',e =>{
                    vm.getMessages()
                });
            }
        },
        disconnect(room)
        {
            window.Echo.leave("chat." + room.id);
        },
        async getRooms(){
           await this.$store.dispatch('chats/listAllRoom').then(() =>{
                this.chatRooms=this.getAllRoom
                this.setRoom(this.getAllRoom[0])
            })
        },

        setRoom( room)
        {
            console.log(room);
            this.currentRoom = room;
            this.getMessages();
        },

        async getMessages(){
            let roomId = this.currentRoom.id;
            console.log(roomId);
            await this.$store.dispatch('chats/getRoomByID',roomId).then(() =>{
                this.messages = this.getRoomById
            })
            .catch(error =>{
                console.log(error);
            })
        },
    },
    created(){
        this.getRooms();
    }
}
</script>
   
   <style lang="scss" scoped>
   .chat_side{
    width: 100%;
    padding-top: 200px;
    .chat_container{
        width: 60%;
        margin: 0 auto;
        .chat_pannel{
            border-radius: 20px;
            margin-top: 20px;
            width: 100%;
            height: 500px;
            //background: rgb(250, 248, 248);
            .chat_message{
                height: 450px;
                padding: 10px;
                overflow-y: scroll;
            }
            .chat_button{
                padding:10px;
            }

        }
    }
   }
   </style>