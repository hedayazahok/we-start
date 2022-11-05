<script>

import store from '../stores/store'
    import CartShopping from '../components/CartShopping.vue'

    export default {
        data() {
            return {
                cartItem:store()
            }
        }, props:['products']
          ,components: {
          CartShopping
        

        },methods: {
            imagePath(product) {
         return new URL(`../assets/img/${product.id}/${product.images[0]}`, import.meta.url).href    }
         

    
        },}
</script>

<template>
  <main>
  <div id="contentCart">
  <section class="hero">
      <h1>Welcome to Our App</h1>
      <img src="src/assets/img/bg.avif" alt="" />
    </section>
 <cart-shopping v-if="cartItem.cartCount!=0"></cart-shopping>
</div>
  </main>
</template>

<style scoped>
#contentCart{
  position:relative ;

}
cart-shopping{
  position: absolute;
  top:10;

}
.hero {
  position: relative;
}
.hero img {
  height: 500px;
  width: 100%;
  object-fit: cover;
  display: block;
}
.hero:before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,.5);
  top: 0;
  left: 0;
}
.hero h1 {
  font-size: 60px;
  color: #fff;
  position: absolute;
  z-index: 9;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  margin: 0;
}

</style>