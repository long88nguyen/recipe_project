<template>
    <div class="breadcumb-field">
        <a-breadcrumb>
        <a-breadcrumb-item><router-link to="/products">Home</router-link></a-breadcrumb-item>
        <a-breadcrumb-item><router-link to="/products">Products</router-link></a-breadcrumb-item>
        </a-breadcrumb>
    </div>
    <div class="table-product">
        list
    </div>
  </template>

  <script>
  export default {

  }
  </script>

  <style scoped>
    .breadcumb-field
    {
        background: white;
        padding:30px;
        width: 100%;
    }
    .table-product
    {
        margin:10px ;
        background: white;
        height: 80vh;

    }
  </style>
