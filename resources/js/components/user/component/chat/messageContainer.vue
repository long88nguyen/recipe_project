<template>
        <div class="list_message">
            <div v-for="(message,index) in messages" :key="index">
                <messageItem
                :message = "message"
                />
            </div>
        </div>
</template>

<script>
import messageItem from './messageItem.vue';

export default {
    components:{
        messageItem
    },

    
    props:[
        'messages'
    ]
}
</script>

<style>

</style>