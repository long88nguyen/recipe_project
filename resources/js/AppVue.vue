<template>
    <div id="app">
      <component :is="layout" v-if="layout" />
    </div>
  </template>

  <script>
  export default {
    el: "#app",
    components: {
    },
    computed: {
      /**
       * Set the application layout.
       */
      layout() {
        return this.$route.meta.layout;
      }
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
