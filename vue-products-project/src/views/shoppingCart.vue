<template>
<div class="main">

<div class="CartContainer">

<cart-shopping></cart-shopping>

</div>
</div>


</template>
    


<style>
.main{
 margin: 0;
 padding: 0;
 background: linear-gradient(to bottom right, #E3F0FF, #FAFCFF);
 height: 100vh;
 display: flex;
 justify-content: center;
 align-items: center;
}
.Cart-Container{
 width: 70%;
 height: 85%;
 background-color: #ffffff;
 border-radius: 20px;
 box-shadow: 0px 25px 40px #1687d933;
}

.remove{
 padding-top: 5px;
 font-size: 14px;
 font-family: ‘Open Sans’;
 font-weight: 600;
 color: #E44C4C;
 cursor: pointer;
}
</style>