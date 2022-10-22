

<template>
    <div class="container">
        <div class="main-wrapper">
            <div class="imageSection">
              <div class="productimgaes">
             <div  :id="++i+'div'" v-for="(img,i) in product[0].images" :key="i" ><img :src="'../src/assets/img/'+product[0].id+'/'+img" :id="i" alt=""  @click="changeImage(i)"   ></div>
              </div>
              <div class="displayImage"><img :src="currentImageSrc" :id="currentImageId"></div>
            </div>

        <div class="description">
        <h2>{{product[0].name}}</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam voluptatum dolor doloremque unde perferendis possimus eaque ab. Delectus voluptatibus at eos animi ipsa obcaecati accusamus nesciunt iusto repudiandae. Laboriosam illo architecto dolores saepe laudantium praesentium ipsam labore id nulla inventore sunt cupiditate quidem necessitatibus, repellat dolorem pariatur aut perspiciatis velit.</p>
        
                <h3>${{product[0].price}}</h3>
                 <ul class="color-variant">
                                <li class="bg-light0" :id="c" v-for="(c,i) in product[0].color" :key="i"></li>
                               
                            </ul>

        </div>
           
        </div>
    </div>
</template>

<script>
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
      props: {
    state: {
      type: String
    }
  },
        data() {
            return {
                            product:products,
                            currentImageId:0,
                            currentImageSrc:"",
                            isActive: false, 


       

            }
        },

  computed: {
    classObj () {
      return {
        [this.state]: this.isActive
      }
    }
  },
 

       methods: {
    changeImage(i){
      if(i!=0){
        
        this.currentImageId=i;
         this.currentImageSrc=this.currentImageSrc="../src/assets/img/"+this.product[0].id+"/"+i+".webp"

         


      }


    },
  
  
        },
    mounted() {
        this.product = products.filter(p => p.id == this.$route.params.id)
         this.currentImageSrc="../src/assets/img/"+this.product[0].id+"/1.webp"
           let div= document.getElementById('1div');
           div.classList.add("selected")
          //img.style.border="1px solid #273b68"

        
       
    }  
    
            

        
            
        
    }
    </script>

    <style>
    .main-wrapper{
      display:flex;
      justify-content:space-between;
      width:80%;
      margin:20px 0 ;
    }
    .imageSection{
      width:60%;
      display:flex;
      justify-content: space-evenly;
    }

    .imageSection .productimgaes{
      width:10%;
      display:block;
      margin-left:50px;
      overflow: hidden;
      


    }
        .imageSection .productimgaes img{
          width:50px;


        }


.imageSection .productimgaes img{
  width:100%;
    border: 1px solid transparent;
     object-fit: cover;
	object-position: center center;

}

.imageSection .productimgaes img:hover{
  border: 1px solid #273b68;
}


    .imageSection .displayImage{
      width:80%;
      height:400px;
      overflow:hidden;
      position:relative;




    }
        .imageSection .displayImage img{
         min-width:100%;
        position:absolute;
        object-fit: cover;
	object-position: center center;



        }

   

.selected{
  border: 1px solid #273b68;

}

    
    .description{
      width:38%
    }


    .description .color-variant {
      padding-top: 5px;
      display:flex;
      flex-wrap: wrap;
      list-style: none;
       }
      
.color-variant li {
  height: 50px;
  width: 50px;
  border-radius: 50%;
  margin-right: 5px;
  border:1px solid #0c0b0b;
  -webkit-transition: all 0.1s ease;
  transition: all 0.1s ease;
  vertical-align: middle;
  cursor: pointer;
   }
 
       #red{
         background-color: red;
       }
        #green{
         background-color: green;
       }
        #pink{
         background-color: rgb(173, 84, 99);
       }
        #black{
         background-color: black;
       }
        #white{
         background-color: #fff;
       }



    </style>