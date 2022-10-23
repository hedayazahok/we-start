<template>

            <!--<FilterProducts @update:filterGender="filterGenderUpdate" @update:filterSize="filterSizeUpdate" />-->
        <div class="warpper">
              <div class="sider">
              <h3>Category:</h3>
                <label  v-for="(cat,i) in categories" :key="i" @change="filterItem">
              <div class="filterCheckBox">
                <input type="checkbox" v-model="categoriesActive" :value="cat" >{{cat}}
              </div>
              </label>

              <hr>
              <h3>color:</h3>
                <label v-for="(color,i) in colors" :key="i" @change="filterItem">
              <div class="filterCheckBox" >
               <input type="checkbox" v-model="colorsActive" :value="color" class="colors" >{{color}}
              </div>
              </label>

              <hr>

              </div>

              <div class="content">
                  <productItem :products="products" />
              </div>

        </div>
  
   

 

</template>


<script>
import productItem from '../components/productItem.vue'

let products=[
      {
        name: "Extended Sizes male 1pc Allover Arrow Print Shirt",
        id: 1,
        price: 880,
        desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",

        color: ["white","black"],
        size: ['L','M'],
        category: "Shirts",
        images: [
         '1.webp',
          '2.webp',
          '3.webp',
          '4.webp',
        ]
      },
      {
        name: "Bishop Sleeve Draped Front Blouse",
        id: 2,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 13,
        color: ['black','white','pink'],
        size: ['S'],
        category: "Sweaters",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
          '4.webp',
        ]
      },
      {
        name: "High Neck Drop Shoulder Sweater",
        id: 3,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 16,
        color: ['black','green'],
        size: ['S','M','L'],
        category: "Pants",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
          '4.webp',
        ]
      },{
        name: "Antler Embroidery Contrast Collar Sweatshirt",
        id: 4,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 29.5,
        color: ['black','red'],
        size: ['S','L'],
        category: "Pants",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
        ]
      },{
        name: " Patched Detail Pullover",
        id: 5,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 10.5,
        color: ['black','pink','green','white'],
        size: ['S','M'],
        category: "shirt",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
       ]
      },{
        name: "High Neck Drop Shoulder Sweater",
        id: 6,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 16,
        color: ['pink','green','white'],
        size: ['S','M','L'],
        category: "Pants",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
          '4.webp',
        ]
      },{
        name: "Antler Embroidery Contrast Collar Sweatshirt",
        id: 7,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 29.5,
        color: ['pink'],
        size: ['S','L'],
        category: "Sweaters",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
          '4.webp',
        ]
      },{
        name: " Patched Detail Pullover",
        id: 8,
         desc:" Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perspiciatis temporibus ullam ratione deleniti ea voluptatem quod. Rerum hic placeat, quibusdam ipsum, officiis corporis non perspiciatis tempore aliquid ipsa doloremque recusandae. Vitae aliquid consequatur sint, reprehenderit ipsam exercitationem corrupti inventore officiis suscipit. Distinctio placeat reiciendis iusto porro maxime tenetur dolor cupiditate.",
        price: 10.5,
        color: ['black','red'],
        size: ['S','M'],
        category: "Pants",
        images: [
          '1.webp',
          '2.webp',
          '3.webp',
       ]
      }]



      
      export default {
    data() {
        return {
          products,
          categoriesActive:[],
          colorsActive:[],
          categories:["Pants","Sweaters","shirt"],
          colors:["black","red","green","white","pink"],

          baseItem:products
         //filteredItems:[],
           

         
    }}
,components: {
    //FilterProducts,
    productItem,
  },methods: {
      filterItem: function(){
     this.products=this.baseItem;

     if (this.categoriesActive.length>0) {
       if (this.colorsActive.length>0) {
        this.products=this.products.filter(p => this.categoriesActive.includes(p.category))

       }else{
                 this.products=this.baseItem.filter(p => this.categoriesActive.includes(p.category))

       }
     }

               if (this.colorsActive.length>0) {
        if(this.categoriesActive.length > 0) {
                    this.products = this.products.filter(p => p.color.some(c => this.colorsActive.includes(c)))
                 }else {
                     this.products = this.baseItem.filter(p => p.color.some(c => this.colorsActive.includes(c)))
                 }
     }


        
              console.log(this.baseproducts);

        }
   
    
  },
   
  mounted() {

      },

}
    
    
   

  

 

</script>

<style>
.warpper{
  position: relative;
  display:flex;
  flex-wrap: wrap;
  justify-content: space-between;
}


.content{

  width:80%;
    
    position:absolute;
    top: 0;
    right: 0;
    


}

.sider{

  width:20%;
   background:#fcfafa;
  height:100vh;
  /*float:left;*/
  position: absolute;
  top:0px;
  left:0;



}
.filterCheckBox{
  display: block;
  
}

#black{
  width:50px;
  height:50px;
  background-color: black;

  
}


</style>

