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
          <li><router-link to="/">services</router-link></li>
          <li id="cart"> 
          <div  @click="showShoppingCart()">
           <font-awesome-icon icon="shopping-cart"/> <span class="badge">{{cart.cartCount}}</span>
          </div>
           </li>
               <div id="shoppingaCart" > <cart-shopping  v-if="display"></cart-shopping> </div>

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
#cart{
  cursor: pointer;
}
#nav a {
      font-weight: bold;
    color: #2c3e50;
}
 router-link-exact-active {
      color: #42b983;
    }
</style>

<script>
import store from '../src/stores/store'
export default {
  data(){

    return {
      cart:store(),
      display:false


    }

  },methods: {
     showShoppingCart(){
      if(this.display==true){
        this.display=false

      }else{
        this.display=true
      }
      
     //console.log(this.display);
   
 
}

  }
  }

 

 


</script>

<style>

#wrap{
position:absolute;
top:0;
right:50px;
background: #2c3e50;
}
.badge {
    background-color: #ed6663;
    border-radius: 10px;
    color: white;
    display: inline-block;
    font-size: 12px;
    line-height: 1;
    padding: 3px 7px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
      
}

.shopping-cart {
  margin: 0;
  float: right;
  background: white;
  width: 320px;
  position: relative;
  border-radius: 3px;
  padding: 20px;

        

  
}
 .shopping-cart .shopping-cart-header {
    border-bottom: 1px solid #E8E8E8;
    padding-bottom: 15px;
    
   
  }
 .shopping-cart .shopping-cart-total {
      float: right;
    }

   .shopping-cart  .shopping-cart-items {
        
        padding-top: 20px;
        max-height:200px;
        overflow: auto;
        width:100%;

      
      }
   .shopping-cart  .shopping-cart-items li {
        margin-bottom: 18px;
        list-style: none;
        position: relative;

        
      }

   .shopping-cart  .shopping-cart-items img {
      float: left;
      margin-right: 12px;
    }
    
   .shopping-cart .shopping-cart-items .item-name {
      display: block;
      padding-top: 10px;
      font-size: 16px;
    }
    
    .shopping-cart .shopping-cart-items .item-price {
      color: #6394F8;
      margin-right: 8px;
    }
    
   .shopping-cart .shopping-cart-items .item-quantity {
      color: #ABB0BE;
    }

.shopping-cart:after {
	bottom: 100%;
	left: 89%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	border-bottom-color: white;
	border-width: 8px;
	margin-left: -8px;
}

.cart-icon {
  color: #515783;
  font-size: 24px;
  margin-right: 7px;
  float: left;
}

.button {
  background: #6394F8;
  color:white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  display: block;
  border-radius: 3px;
  font-size: 16px;
  margin: 25px 0 15px 0;
  
 
}
 .button:hover {
    background: lighten(#6394F8, 3%);
  }

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}




.item-remove {
  position: absolute;
  top:5px;
  right:0

}


.item-remove button{
  border: none;
  cursor: pointer;
}


</style>