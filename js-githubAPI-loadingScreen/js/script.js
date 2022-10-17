const warpper = document.querySelector('.warpper');
const html=document.querySelector('html')
const input = document.querySelector('input');
const loadScreen = document.querySelector('.loadScreen');
const container = document.querySelector('.container');
var elem = document.querySelector(".progress-bar");
var span = document.querySelector("span");
var progress = document.querySelector(".slide-progress-bar");
var width = 1;
var interval;

let username='';
var time = window.performance.now();
let end ;
isLoading= false;
loading= 0;
var sendDate = (new Date()).getTime()/ 1000;
var responseTimeMs ;





input.addEventListener('keydown', function (e) {

  if(e.key === 'Enter') {
    warpper.innerHTML =``

    progressBar(responseTimeMs)
   
    username=input.value;
    axios({
      method: 'get',
      url:"https://api.github.com/users/"+username})

    .then(res => {

      var receiveDate = (new Date()).getTime()/ 1000;
       responseTimeMs = receiveDate - sendDate;

    



        const data =res.data;
        let item = `

        <div class="account-info" style="display:flex,justify-content: space-around">
        <a href="${data.html_url}"><img src="${data.avatar_url}" alt="" ></a>
            <h2><a href="${data.html_url}">${data.name}</a></h2>
            <div class="info">
            <span> Followers:${data.followers}</span>
            <span> following:${data.following}</span>
            </div>
            </div>
            <div class="repos" style="display:flex,justify-content: space-around">
            Repos:
            <ul></ul>
            </div>
            

            `
            loading = true;

        document.querySelector('.warpper').innerHTML += item
        axios.get("https://api.github.com/users/"+username+"/repos")

        .then(res => {

           const repos =res.data;
           loading = false;

           let repo=[]
           repos.forEach(el => {
             repo = `
                <li><a href="${el.html_url}">${el.name}</a></li>    
                `

                document.querySelector('ul').innerHTML += repo

        });
        console.log(responseTimeMs);

        });




   
})  

}  


});




function progressBar(time) {
  resetProgressBar();
  progress.style.display="inline-block";
  warpper.style.display="none";


  interval = setInterval(frame, time);

  function frame() {
    if (width >= 100) {
      clearInterval(interval);
      warpper.style.display="inline-block";
      progress.style.display="none";



    } else {
      width++;
      elem.style.width = width + '%';
      span.innerHTML=width + '%';

      warpper.style.display="none";

    }
  }
}

function resetProgressBar() {
  width = 1;
  clearInterval(interval)
  elem.style.width = width + '%';
  span.innerHTML=width + '%';
  //warpper.style.display="inline-block";

}