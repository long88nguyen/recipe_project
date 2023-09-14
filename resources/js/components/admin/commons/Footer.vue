<template>
    <div class="footer_layout" :class="{active:isActive}">
        <div class="footer-sub">

        </div>
    </div>
</template>

<script>
export default {
    props:{
        isActive:{
            type:Boolean
        }
    }
}
</script>

<style lang="scss" scoped>
.footer_layout
{
    width: calc(100% - 78px);
    margin-left:78px;
    margin-top:20px ;
    transition: all 0.5s ease;
    background: white;
    .footer-sub{
        width: 100%;
        height: 60px;
        background: rgb(227, 227, 227);
    }
}
.footer_layout.active {
    width: calc(100% - 240px);
    margin-left: 240px;
}
</style>