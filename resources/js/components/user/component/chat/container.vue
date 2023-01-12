<template>
    <div class="chat_side">
        <div class="chat_container">
            <chatRoomSelection
            v-if="currentRoom.id"
            :rooms="chatRooms"
            :currentRoom = "currentRoom"
            @roomchanged = setRoom($event)
            />
            <h1>Container</h1>
            <messageContainer
            :messages = "messages"
            />
            <inputMessage :room = "currentRoom"
                        @messagesent = "getMessages()"
            />

            {{getAllRoom}}
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
        width: 70%;
        margin: 0 auto;
    }
   }
   </style>