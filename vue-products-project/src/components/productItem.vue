    <template>

    <section class="box">
        <h2>New Products</h2>
        <div class="featured-items">
            <div class="featured-items__item" v-for="product in products" :key="product.id" >
           
            <router-link :to="{ name: 'singleProduct', params: {id:  product.id } }"><img class="product-image" :src="imagePath(product)" alt=""></router-link>
           <router-link :to="{ name: 'singleProduct', params: {id:  product.id } }"><p class="product-title">{{ product.name }}</p></router-link>
             <div class="product__price-tag"> <p class="product__price-tag-price">${{ product.price }}</p></div>
        <div class="tags"><span v-for="(color, i) in product.color" :key="i">{{ color }}</span></div>
        <div class="button-div"><button class="button is-success" @click="addToCart(product)" >  
         <font-awesome-icon icon="shopping-cart"  />

Add to Cart</button></div>
          
</div>
            </div>

            <div>
            
            </div>
         
<div>

<cart-shopping v-if="cartItem.cartCount!=0"></cart-shopping>
</div>
            
    </section>
    

            
    </template>

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
    //FilterProducts,
          CartShopping,
        

        },methods: {
            imagePath(product) {
         return new URL(`../assets/img/${product.id}/${product.images[0]}`, import.meta.url).href    }
         ,addToCart(item) {
            const cartItem = store()
            
            cartItem.addToCart(item)
           
    
        
    }

    
        },
            
            
            

        
            
        
    }
    </script>
    <style scoped>
.box {
  max-width: 800px;
  margin: 0 auto;
  
  @media only screen and (max-width: 832px) {
    max-width: 100%;
    padding: 1rem;
    text-align: center;
  }
}
.productItem{
    display: flex;
  flex-wrap: wrap;
  
}


.featured-items {
  padding-left: 0;
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  /*justify-content: space-between;*/
 
  @media only screen and (max-width: 832px) {
    flex-direction: column;
  }
}



.featured-items__item {
       width:30%;
        margin: 1%;
        height:350px;
        background: rgb(244, 244, 244);
        min-height: 300px;
        overflow: hidden;
        border-radius: 5px;
        position: relative;
       

      

  @media only screen and (max-width: 832px) {
    width: 100%;
  }
}
.featured-items__item:hover {

 box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.1);
  transform: scale(1.02);
}


     
.product-image {
  height: 200px;
  width: 100%;
  object-fit: cover;
    object-position: center;
   border-radius: 5px;
   vertical-align: middle;
   transition:0.5s;
  
}
.featured-items__item:hover .product-image {
  transition:0.2s;
  background: blue;
}




.product-title {
  font-weight: bold;
  margin:10px 20px
}

.featured-items__item a{
  text-decoration: none;
    font-weight: bold;
    text-align: center;
    color:#2e2635

  }
  

/* Makes the triangle */
.product__price-tag {
  width: 80px;
		display: flex;
		align-items: center;
		height: 50px;
		border-radius: 8px 8px 8px 0;
    border-left: 20px solid transparent;
		border-top: 10px solid #a72c29;
		background: #ed6663;
		z-index: 99;
          opacity: .8;

		position: absolute;
		top: -15px;
    border-radius: 2px;
  filter: drop-shadow(1px 1px 0.8px rgba(0, 0, 0, 0.2));
  transform: rotateZ(-5deg) scale(1);
  transition: all 0.5s ease;
}
/*.product__price-tag::after {
			content: 'ihiuiguiyguy';
			position: absolute;
		
			left: 0px;
			top: 50px;
		}*/


   .product__price-tag::before {
  content: "";
  padding: 18px;
  position: absolute;
  background-color: #ed6663;
  left: -6px;
  top: 1px;
  border-bottom-left-radius: 50%;
  border-top-left-radius: 50%;
  z-index: -1;
}

.product__price-tag::after {
  content: "";
  padding: 18px;
  position: absolute;
  background-color: #ed6663;
  right: -6px;
  top: 1px;
  border-bottom-right-radius: 50%;
  border-top-right-radius: 50%;
  z-index: -1;
}
	
		.product__price-tag-price {
			color: #fff;
      background: #ed6663;
			font-size: 24px;
		}
    .tags{
      margin: 10px 20px 30px;
      display: flex;
      flex-wrap: wrap;
      
      
    }
    .featured-items__item span {
        font-size: 13px;
        padding: 5px 5px;
        background: rgb(212, 212, 212);
        margin: 2px 3px;
        border-radius: 3px;
        text-transform: capitalize;
        /*font-weight: bold;*/
        
    }
     
    .button{
      border:none;
      width:100%;
      padding:12px 10px;
      background-color: #ed6663;
      cursor: pointer;
      border:1px solid  #ed6663;
      position:absolute;
right:    0;
bottom:   0; 
color:#fff;
transition: all .3s ease;

   }

.button:hover{
background: #fff;
color: #ed6663;
}


</style>