/*const arr1=[1,2,3,4]

console.log(arr1.map((x)=>[x * 2]));
console.log(arr1.flatMap((x) => [x * 2]));
console.log(arr1.flatMap((x) => [[x * 2]]));


arr1.forEach(Element=>console.log(Element*2))*/
/*

let x=5;
let y=20;

function age(){
    let z=50;

}
console.log(z);

console.log(x);

*/
/*
let sum=0;
let number= parseInt(prompt('enter number'));
while(number>0){
    sum += number;

    // take input again if the number is positive
    number = parseInt(prompt('Enter a number: '));


}

console.log(`The sum is ${sum}.`);
*/
/*
let sum=0;
let number=parseInt(prompt('enter number:'));
do{
    sum+=number;
    number=parseInt(prompt('enter number:'));

    
}while(number >0);

console.log(`The sum is ${sum}.`);*/

/*
let i =1;
let n=5;
do{
console.log(i);
i++;
}while(i<=5);
*/
/*
for(let i=1;i<=5;i++){
    if(i==3){
        continue;
    }
    console.log(i);
}*/

/*function countDown(number){
    if(number>0){
        console.log(number)
        countDown(--number);

    }

}

countDown(5);

*/

/*

function factorial(x){
    if(x==0){
        return 1;
    }else{
        return x*factorial(x-1);
    }


}

let x=5;
let fac=factorial(x);
console.log(`factorial ${x}=${fac}`)


let f=factorial(5);


*/
/*

function Person (person_name,person_age,person_gender){
    this.name=person_name,
    this.age=person_age,
    this.gender=person_gender,
    this.greet= function(){
        return ('Hi' + ' ' + this.name)
    }
}

const person1= new Person ('ali',23,'male');
const person2=new Person ('ahmed',25,'male');
console.log(person1.name); // "John"
console.log(person2.name); // "Sam"

*/

/*
// constructor function
function Person (person_name, person_age, person_gender) {

    // assigning  parameter values to the calling object
     this.name = person_name,
     this.age = person_age,
     this.gender = person_gender,
 
     this.greet = function () {
         return ('Hi' + ' ' + this.name);
     }
 }
 
 
 // creating objects
 const person1 = new Person('John', 23, 'male');
 const person2 = new Person('Sam', 25, 'female');
 
 // accessing properties
 console.log(person1.name); // "John"
 console.log(person2.name); // "Sam"
 */



 //Object.defineProperty()=>to define getter and setter proberty

/*
 const Student={fname:"monica"};

 Object.defineProperty(Student,'getName',{
     get:function(){
         return this.fname
        }
 });


 Object.defineProperty(Student,'changeName',{
     set:function(value){
         this.fname=value;
     }
 });


 console.log(Student.fname); // Monica

 // changing the property value
 Student.changeName = 'Sarah';
 
 console.log(Student.fname); // Sarah
 */


 /*
console.log(document.getElementById('btn'));
let i=20;

function counter() {
   

    setInterval(function(){


        let width=document.getElementById('timer').width;
        // i-=1;
        document.getElementById('count').innerHTML=i--;
       document.getElementById('timer').style='width:100-';
       console.log(i);
    

    
    },1000);

}

    



 document.getElementById('btn').addEventListener('click',function () {
    if(i>0){

counter();
    }
    else{

        document.innerHTML='finished'
    }
    
 });


 */


 let warpper=document.getElementById('warpper');
 let warpperFinished=document.getElementById('warpperFinished');
 let warpperCount=document.getElementById('warpperCount');
 let count=document.getElementById('count');
 let timer=document.getElementById('timer');
 let box=document.getElementById('box');
 let btn=document.getElementById('btn');


 btn.addEventListener('click',function(){
    let i =count.innerHTML;
    let f =-10;
    let size = 100 / i ;

     let d=setInterval(function() {
         if(i<0){
            clearInterval(d);
            warpperCount.style.display='none';
            warpperFinished.style.display='block';

            
         }else{
            count.innerHTML=i--;
            f += size;
            f=Math.floor(f);
            timer.style.width = f + '%';
    
         }
     },1000);

});

     
 








 
 