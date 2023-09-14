<template>
    <div class="chat_item my" v-if="checkMessageMine"><span>{{ message.user.email }} : {{ message.message }}</span></div>
    <div class="chat_item you" v-else><span> {{ message.message }} : {{ message.user.email }}</span></div>
    </template>

<script>
import { mapGetters } from 'vuex'
export default {
    props:['message'],

    computed:{
        ...mapGetters({
            userCommon:"common/userCommon"
        }),
        checkMessageMine(){
            return this.userCommon.user_id == this.message.user_id
        }
    }
}
</script>

<style lang="scss">
.chat_item{
    margin: 10px;
    max-width: 300px;
    height: 40px;
    line-height: 40px;
    border-radius: 20px;
    padding: 0px 20px;
    
}
.my{
        background: #0084ff;
        color: white;

    }
    .you{
        background: #e4e6eb;
        color: black;
        margin-left: 550px;
        text-align: end;

    }
</style>