<template>
<div>{{ message.user.email }} : {{ message.message }}</div>
</template>

<script>
export default {
props:['message']
}
</script>

<style>

</style>