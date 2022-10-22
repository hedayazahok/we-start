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
                  <font-awesome-icon icon="shopping-cart" color="red"/>
                  </button></td>
                </tr>

                <tr v-if="cartItem.cart.length != 0">
                    <th colspan="3">Total</th>
                    <th>{{ totalPrice }}$</th>
                </tr>
            </table>
        </div>
    
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