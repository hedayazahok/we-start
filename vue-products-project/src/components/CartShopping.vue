<template>

      <div class="cart-wrapper">
            <table border="1">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Delete</th>
                </tr>
                <tr v-for="(cart,i) in cartItem.cart" :key="i">
                    <td>{{ cart.name }}</td>
                    <td>{{ cart.quantity }}</td>
                    <td>{{ cart.price }}$</td>
                    <td>{{ cart.price * cart.quantity }}$</td>
                  <td><button @click="removeButton(cart)" > 
                  <font-awesome-icon icon="shopping-cart" />
                  </button></td>
                </tr>

                <tr v-if="cartItem.cart.length != 0">
                    <th colspan="3">Total</th>
                    <th>{{ totalPrice }}$</th>
                </tr>
            </table>
        </div>

    <!--<div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="">
            Cart ({{ cartItem.cartCount }})
        </a>

        <div v-if="cartItem.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <a v-for="item in cartItem.cart"
                :key="item.id"
                class="navbar-item"
                href=""
            >
                {{ item.title }} x{{ item.quantity }} - ${{ item.totalPrice }}
            </a>

            <a class="navbar-item" href="">
                Total: ${{ totalPrice }}
            </a>

            <hr class="navbar-divider">

            <a class="navbar-item" href="">
                Checkout
            </a>
            <a v-for="item in cartItem.cart"
    :key="item.id"
    class="navbar-item"
    href=""
>
    <span class="removeBtn"
        title="Remove from cart"
        @click.prevent="removeFromCart(item)">X</span>

    {{ item.title }} x{{ item.quantity }} - ${{ item.totalPrice }}
</a>
        </div>

        <div v-else class="navbar-dropdown is-boxed is-right">
            <a class="navbar-item" href="">
                Cart is empty
            </a>
        </div>
    </div>-->
</template>
 <script>
    import store from '../stores/store'

    export default {
        data() {
            return {
        cartItem:store()
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

<style>
.removeBtn {
    margin-right: 1rem;
    color: red;
}



</style>
