<template>
    <Navbar
        :isActive="isActive"
        @ToggleNavbar = "ToggleNavbar"
        @logout = "logout"
    />
    <Header
    :isActive="isActive"
    >

    </Header>
    <Body
        :isActive="isActive"
    >
    </Body>

</template>

<script>
import Navbar from "./Navbar";
import Header from "./Header"
import Body from "./Body.vue";

export default {
    name: "AuthLayout",
    components: {
        Navbar,
        Body,
        Header
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
};
</script>

<style>

</style>
