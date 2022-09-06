<template>
    <Navbar/>
    <Header></Header>
    <Body>
    </Body>
</template>

  <script>
  import Navbar from "./Navbar";
  import Header from "./Header";
  import Body from "./Body";
//   import UserLoading from "./Loading";
//   import { mapState } from "vuex";

  export default {
    name: "AuthLayout",
    components: {
      Navbar,
      Header,
      Body
    },

    computed: {
    }
  };
  </script>

  <style lang="scss" scoped>
  </style>
