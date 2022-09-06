<template>
    <div class="header-nav">
    <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="#">NavBar</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <b-nav-item href="#">Link</b-nav-item>
            <b-nav-item href="#" disabled>Disabled</b-nav-item>
        </b-navbar-nav>
        </b-collapse>
    </b-navbar>
    </div>
</template>

<script>
export default {

}
</script>

<style>
.header-nav {

  position: fixed;
  width: calc(100% - 78px);
  left:78px;
  transition: all 0.5s ease;
  overflow: hidden;
  background-color: #f1f1f1;
  z-index: 1;
}
 .sidebar.active ~.header-nav
{
    width: calc(100%-240px);
    left: 240px;

}
</style>
