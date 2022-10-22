<template>

  <div id="wrap">
  <div class="shopping-cart">
    <div class="shopping-cart-header">
      <font-awesome-icon icon="shopping-cart"  /><span class="badge">{{cartItem.cartCount}}</span>
      <div class="shopping-cart-total">
        <span class="lighter-text">Total:</span>
        <span class="main-color-text">${{totalPrice}}</span>
      </div>
    </div> <!--end shopping-cart-header -->

    <ul class="shopping-cart-items"  >
      <li class="clearfix"  v-for="(cart,i) in cartItem.cart" :key="i">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" /> 
        <span class="item-name">{{ cart.name }}</span>
        <span class="item-price">${{ cart.price * cart.quantity }}</span>
        <span class="item-quantity">Quantity: {{ cart.quantity }}</span>
        <span class="item-remove">
        <button @click="removeButton(cart)" > 
                  <font-awesome-icon icon="close" color="red" style="border:none"  />
                  </button>
                  </span>
      </li>

    </ul>
 

    <a href="#" class="button">Checkout</a>
  </div> <!--end shopping-cart -->
</div> <!--end container -->
</template>
 <script>
    import store from '../stores/store'
    export default {
        data() {
            return {
        cartItem:store(),

            }
           
        }
        ,computed: {
    totalPrice() {
const cartItem = store()
        let total = 0;
        for (let item of cartItem.cart) {
            total += item.totalPrice;
        }
        return total.toFixed(2);
    },
    
    
    
    
    },methods: {
        removeButton(item) {
        const cartItem = store()
            cartItem.removeFromCart(item)
        }
}
    
        
            
            
            
        
            
        
    }
    </script>

