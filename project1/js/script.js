// Initialize and add the map
function initMap() {
    // The location of Uluru
    const uluru = { lat: -25.344, lng: 131.031 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 4,
      center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: uluru,
      map: map,
    });
  }
  
  window.initMap = initMap;



  //change header background after hero section
  const body = document.querySelector('body');
  const hero = document.getElementById("hero");

  let heroHeight=hero.offsetHeight;
  let header=document.querySelector("header");

  document.addEventListener("scroll", event => {
    if(window.scrollY-heroHeight+75>0){
      header.style.backgroundColor='#3b3a3a'
      header.style.color='#c7c7c7'
      header.style.color='#c7c7c7'
      header.style.zIndex=2000
       


    }else{
      header.style.backgroundColor = 'transparent'; 

      header.style.color='#c7c7c7'

    }
    
}, { passive: true });

//smoth scroll to section


document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {

      e.preventDefault();
      /*window.scrollTo({
        top: sectionOffset+200,
        left: 0,
        behavior: 'smooth'
      });*/

    document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'instant', block: "nearest", inline: "nearest"
         
      });


      
  });
});
//smoth scroll to top

let topBtn=document.getElementById('top')

window.onscroll = function() {

  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    topBtn.style.display = "block";
}else{
  topBtn.style.display = "none";

}
}

function scrollToTop(){


  window.scrollTo({top: 0, behavior: 'smooth'});
}





//validation form 
const input = document.querySelectorAll('input');

const name = document.querySelector('#name');
const email = document.querySelector('#email');
const msg = document.querySelector('#msg');
const form = document.querySelector('form');
const formField = input.parentElement;
const errors = form.querySelectorAll('span');

form.addEventListener('submit',function(e){
  e.preventDefault
  if( email.value!==""&&name.value!==""&&msg.value!==""){
    e.preventDefault

    for (let i = 0; i < errors.length; i++) {
      errors[i].textContent = '';

      
    }
    name.value=''
    email.value=''

    msg.value=''
    
    window.location.href="#ContactUs"; 
    return(true);
    
          }
          else{
          
            
  if( name.value == "" ) {
    e.preventDefault();

     name.focus() ;
     errors[0].textContent = 'Please provide your name!';
   
   }else{
    errors[0].textContent = '';

   }
   if( email.value == "" ) {
     e.preventDefault();
    email.focus() ;
    errors[1].textContent = 'Please provide your Email!';

 
       }else{
        errors[1].textContent = '';

       }
       
      if( msg.value == "" ) {
        e.preventDefault();

        msg.focus() ;
        errors[2].textContent = 'Please provide your msg!';

      }else{
        errors[2].textContent = '';

       }
 
  
      }




})

  













//filter


let list = document.querySelectorAll('.bttn');
let itemBox = document.querySelectorAll('.pItem');
for(let i = 0; i<list.length; i++){
    list[i].addEventListener('click', function(){
      
        for(let j = 0; j<list.length; j++){
            list[j].classList.remove('active');

        }
        this.classList.add('active');

        let dataFilter = this.getAttribute('data-filter');
        console.log(dataFilter);

        for(let k = 0; k<itemBox.length; k++){
            itemBox[k].classList.remove('active');
            itemBox[k].classList.add('hide');
            console.log(itemBox[k]);

        if(itemBox[k].getAttribute('data-item') == dataFilter || dataFilter == "all"){
            itemBox[k].classList.remove('hide');
            itemBox[k].classList.add('active');

        }
    }
    })
}
