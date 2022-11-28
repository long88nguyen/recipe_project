  <template>
        <router-view></router-view>
  </template>

  <script>
    import AuthLayout from "./components/admin/commons/AuthLayout.vue"
  export default {
    el: "#app",
    components: {
        AuthLayout
    },
    data: function() {
      return {
      };
    },
    methods: {
    },
    mounted() {
    }
  };
  </script>

  <style lang="scss">
  </style>
