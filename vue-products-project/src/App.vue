<script setup>
import { RouterLink, RouterView } from "vue-router";
//import HelloWorld from "./components/HelloWorld.vue";
</script>

<template>
  <div>
  <!-- <router-view></router-view>
  <router-view/>
  <RouterView></RouterView> -->

  <header>
    <nav>
      <div class="logo">
        <router-link to="/">Ecommerce</router-link>
      </div>

      <div class="menu">
        <ul>
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/products">Products</router-link></li>
        </ul>
      </div>
    </nav>
  </header>
  <RouterView />
</div>
</template>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
#nav {
  padding: 30px;
  

}
#nav a {
      font-weight: bold;
    color: #2c3e50;
}
 router-link-exact-active {
      color: #42b983;
    }
</style>