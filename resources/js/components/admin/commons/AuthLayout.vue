<template>
    <Navbar
        :isActive="isActive"
        @ToggleNavbar = "ToggleNavbar"
        @logout = "logout"
    />
    <Body
        :isActive="isActive"
    >
    </Body>
    <Footer
        :isActive="isActive"
    >
    </Footer>

</template>

<script>
import Navbar from "./Navbar.vue";
import Header from "./Header.vue"
import Body from "./Body.vue";
import Footer from "./Footer.vue"

export default {
    name: "AuthLayout",
    components: {
        Navbar,
        Body,
        Header,
        Footer
    },
    data()
    {
        return {
            isActive:true,
        }
    },
    methods:{
        ToggleNavbar()
        {
            this.isActive=!this.isActive
        },
        logout()
        {
            console.log(123);
        }
    },

    computed: {
    }
}
</script>

<style>

</style>
