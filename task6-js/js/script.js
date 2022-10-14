
//context menu

let contextMenu=document.getElementById('contextMenu')

const scope = document.querySelector("body");

window.oncontextmenu=()=>{return false};

scope.addEventListener("mousedown", (event) => {
  event.preventDefault();

  (event.buttons==2)? contextMenu.classList.add("visible"):contextMenu.classList.remove("visible");
     

  
});

window.onkeydown = function(event){ 
  if(event.keyCode==32){
    contextMenu.classList.remove("visible")
  }

 }


 
 


//dark-light mood
const body = document.querySelector('body');
const i = document.querySelector('i');
function toggleDark() {
 i.classList.toggle("fa-moon-o");

  if (body.classList.contains('dark')) {
    body.classList.remove('dark');
    localStorage.setItem("theme", "light");
    localStorage.setItem("icon", "fa-sun-o");
  } else {
    body.classList.add('dark');
    localStorage.setItem("theme", "dark");
    localStorage.setItem("icon", "fa-moon-o");

  }


}

if(localStorage.getItem("theme") === "dark") {
  body.classList.add('dark');
  i.classList.add("fa-moon-o");



}

i.addEventListener('click', toggleDark);




  
