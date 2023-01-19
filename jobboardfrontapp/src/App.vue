<template>
  <nav-bar v-cloak></nav-bar>
  <div id="views-router">
    <router-view/>
  </div>
  <Footer></Footer>
</template>

<script>
import NavBar from '@/components/NavBar'
import Footer from '@/components/Footer'
export default {
  components: {
    NavBar, Footer
  },
  setup() {

  }
}
</script>

<style>
[v-cloak] {
  display: none;
}

html, body {
  padding: 0;
  margin: 0;
  overflow-x:hidden;
  max-width:100%;
  min-width:100%;
  /* overflow-y: hidden; */
}

.main-btn-3.router-link-exact-active {
  background-color: white;
  color: #6EE7B7;
}

.main-a-3.router-link-exact-active {
  background-color: white;
  color: #6EE7B7;
  border-radius: 10px;
  padding: 5px;
}
</style>


