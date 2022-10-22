import { defineStore } from 'pinia'

let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');
// export const useUserStore = defineStore({
    export const store = defineStore('main', {
    
      id: 'user',
      state: () => ({
    cart: cart ? JSON.parse(cart) : [],
    cartCount: cartCount ? parseInt(cartCount) : 0,
    display: false,

  }),
  getters: {
    showCart: (state) => state.cart,
    showCartCount: (state) => state.cartCount 
  },
  actions: {
    addToCart(item) {


      let found = this.cart.find(product => product.id == item.id);
      if (typeof(found) != "undefined") {
        this.cart['quantity']=found.quantity ++;
       found.totalPrice = found.quantity * found.price;
       this.cart['totalPrice']=found.totalPrice
      
      
      }
     else {

      item['quantity']=1;
      item['totalPrice']= item.price;
        this.cart.push(item);

    }
    

    this.cartCount++;
    this.saveCart();

        },
removeFromCart(item) {

  let index = this.cart.indexOf(item);

    if (index > -1) {
        let product = this.cart[index];

        
      this.cartCount -= product.quantity;
    


        this.cart.splice(index, 1);
        this.saveCart(); }
        
   
},saveCart() {
    window.localStorage.setItem('cart', JSON.stringify(this.cart));
    window.localStorage.setItem('cartCount', this.cartCount);
}



  }}

)

export default store


