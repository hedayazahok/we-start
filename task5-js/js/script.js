let products=[
    {
        name:'product1',
        price:'300',
        features:'Quality|Design|Material'
    },
    {
        name:'product2',
        price:'120',
        features:'Quality|Design|Material'
    },
    {
        name:'product3',
        price:'20',
        features:'Quality|Design|Mateeerial|low-Price'
    },




]

//my answer after

let warpper=document.getElementById('warpper')

for({name,price,features}of products){
let box=document.createElement('div');
box.className='card';
let f=features.split("|");
box.innerHTML+= `<a href="" class="pname"><h2>${name}</h2></a><p>${(price<50)?'<span style="color:red;font-size:28px">sale </span>'+ price:price}$</p>`
    f.forEach(element => {
        
            box.innerHTML+=`<span class="tag">${element}</span>`
        
    
    });

warpper.appendChild(box);

}



//my answer  before

/*
let f;
let p=0;
products.forEach(element => {

f=element.features.split("|").map(function (value) {
    return value.trim();
 });

let card=document.createElement('div');
card.setAttribute('class','card');
card.innerHTML=`<a href="" class="pname"><h2>${element.name}</h2></a><p>${element.price}</p>`

warpper.appendChild(card)

let list=document.createElement("ul");
list.setAttribute('class','tags');
list.setAttribute('id','tags_'+p);

card.appendChild(list);

ul=document.getElementById("tags_"+p);
let x=0;
    while(x<f.length){
        const li = document.createElement("li");
        li.setAttribute('class','tag')
    li.appendChild(document.createTextNode(f[x]));

   ul.appendChild(li);
   x++;

    }

    p++;



})


*/






