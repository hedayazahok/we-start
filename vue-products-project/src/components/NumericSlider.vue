<template>
  
<div class="slider">
<input type="range" id="myRange" name="currentValue" :value=10  :min=10 :max=1000> 
<div id="demo"></div>
</div>
</template>

<script>
//import sliderComponent from './NumericSlider.vue'

export default {
  props: {
    value: {
      type: Number,
      required: true
    },
    min: {
      type: Number,
      required: true
    },
    max: {
      type: Number,
      required: true
    }
  },
  data(){
    return {
        currentValue:0,
    priceInputValue: 10,   // initial input value
      priceInput: {           // slider values
      0: 10,
      1: 50,
      2: 100,
      3: 150,
      4: 200,
      5: 250,
      6: 300,
      7: 350,
      8: 400,
      9: 450,
      10:500
    },
    priceOutput:10
    }
  },
  methods: {
    onInput() {
      //this.currentValue is a string because HTML is weird
      this.$emit('input', parseInt(this.currentValue));
              console.log(this.value);

    }
  }
}
</script>

<style scoped>
.slider{
  border-radius: 3px;
  width:100%;
  background-color: rgb(255, 255, 255);
}

.range-slider {
  width:100%;
  text-align: center;
  position: relative;
  padding-bottom: 20px;
}
p{
  text-align: center;
  margin-top: -10px;
  font-size: 30px;
  color: rgb(7, 77, 189);
}

.range-slider .rangeValues {
  display: block;
  box-shadow: 0 0 20px rgba(0,139,253,0.25);
  padding: 20px 0px;
  font-size: 16px;
  margin-bottom: 35px;
}

input[type=range] {
  -webkit-appearance: none;
  border: 1px solid white;
 /* width: 300px;*/
  position: absolute;
  left: 0;
}

input[type=range]::-webkit-slider-runnable-track {
 /* width: 300px;*/
  height: 5px;
  background: #ddd;
  border: none;
  border-radius: 3px;
}

input[type=range]::-webkit-slider-thumb {
  -webkit-appearance: none;
  border: none;
  height: 18px;
  width: 18px;
  border-radius: 50%;
  background: #0273a0;
  margin-top: -6px;
  cursor: pointer;
  position: relative;
  z-index: 1;
}

input[type=range]:focus {
  outline: none;
}

input[type=range]:focus::-webkit-slider-runnable-track {
  background: #ccc;
}

</style>