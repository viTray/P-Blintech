<template>
  <div class=" uk-background-default">
    <div class=" uk-width-1-1">
      <div>
        <img
          src="../../assets/logo.svg"
          width="120px"
          alt=""
        >
      </div>
    </div>
    <div class="">
      <ul class="uk-breadcrumb uk-float-right">
        <li>
          <button
            class="uk-button uk-button-text"
            @click="replay"
          >
            <span
              class="uk-text-muted"
              uk-icon="icon: history"
            />
          </button>
        </li>
        <li>
          <button
            class="uk-button uk-button-text"
            @click="resetCanvas"
          >
            <span
              class="uk-text-muted"
              uk-icon="icon: tablet-landscape"
            />
          </button>
        </li>
      </ul>
    </div>
    <div class="uk-card-media-top uk-text-center">
      <canvas
        id="canvas"
        ref="canvas"
        width="500px"
        height="200px"
        style="border: 1px dashed darkgray;"
      />  
    </div>
    <div class="uk-margin">
      <h5>{{ title }}</h5>
    </div>
  </div>
</template>

<script>

export default {
  
  name: 'Canvasfirma',
    props:{
      title: {
        type: String,
        default: 'Indefinido'
      }
    },
    data () {
      return {
      foto: new Image(),
      canvas: null,
      context: null,
      isDrawing: false,
      startX: 0,
      startY: 0,
      points: [],
      color: 'black',
      size: 5, 
      }
    },
    mounted(){
      var vm = this
      vm.canvas = vm.$refs.canvas
      vm.context = vm.canvas.getContext('2d');
      vm.canvas.addEventListener('mousedown', vm.mousedownT);
      vm.canvas.addEventListener('mousemove', vm.mousemoveT); 
      vm.canvas.addEventListener('touchstart', vm.touchdown);
      vm.canvas.addEventListener('touchmove', vm.touchmove); 
      vm.canvas.addEventListener('touchend', vm.mouseup) ;
      vm.canvas.addEventListener('mouseup', vm.mouseup) ;
    },
  methods:{
    mousedownT(e){
      var vm = this
      var rect = vm.canvas.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      
      vm.isDrawing = true;
      vm.startX = x;
      vm.startY = y;
      vm.points.push({
        x: x,
        y: y
      });
    },
    touchdown(e){
      var vm = this
      var rect = vm.canvas.getBoundingClientRect();
      var x = e.touches[0].clientX - rect.left;
      var y = e.touches[0].clientY - rect.top;
      
      vm.isDrawing = true;
      vm.startX = x;
      vm.startY = y;
      vm.points.push({
        x: x,
        y: y
      });
    },
    mousemoveT(e){
      var vm = this
      var rect = vm.canvas.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      
      if (vm.isDrawing) {
        vm.context.beginPath();
        vm.context.moveTo(vm.startX, vm.startY);
        vm.context.lineTo(x, y);
        vm.context.lineWidth = 5;
        vm.context.lineCap = vm.size;
        vm.context.strokeStyle = vm.color;
        vm.context.stroke();
        
        vm.startX = x;
        vm.startY = y;  
        
        vm.points.push({
          x: x,
          y: y
        });
      }
    },
    touchmove(e){
      var vm = this
      var rect = vm.canvas.getBoundingClientRect();
      var x = e.touches[0].clientX - rect.left;
      var y = e.touches[0].clientY - rect.top;
      
      if (vm.isDrawing) {
        vm.context.beginPath();
        vm.context.moveTo(vm.startX, vm.startY);
        vm.context.lineTo(x, y);
        vm.context.lineWidth = 5;
        vm.context.lineCap = vm.size;
        vm.context.strokeStyle = vm.color;
        vm.context.stroke();
        
        vm.startX = x;
        vm.startY = y;  
        
        vm.points.push({
          x: x,
          y: y
        });
      }
    },
    mouseup(){
      var vm = this
      vm.isDrawing = false;
      if (vm.points.length > 0) {
        localStorage['points'] = JSON.stringify(vm.points);    
      }
      this.send();
    },
    resetCanvas(){
      var vm = this
      vm.context.clearRect(0, 0, vm.canvas.width, vm.canvas.height);
      vm.points.length = 0;
      vm.$emit('firma', '');
    },
    saveImage(){
      var vm = this
      var dataURL = vm.canvas.toDataURL();
      var img = vm.$refs.img;
      img.src = dataURL;
    },
    replay(){
      var vm = this
      vm.context.clearRect(0, 0, vm.canvas.width, vm.canvas.height);
      if (vm.points.length === 0) {
        if (localStorage["points"] !== undefined) {
          vm.points = JSON.parse(localStorage["points"]);
        }
      }
      
      var point = 1;
      setInterval(function(){
        drawNextPoint(point);
        point += 1;
      },10);
      
      function drawNextPoint(index) {    
      if (index >= vm.points.length) {
        return;
      }
        var startX = vm.points[index-1].x;
        var startY = vm.points[index-1].y;
        
        var x = vm.points[index].x;
        var y = vm.points[index].y;
        
        vm.context.beginPath();
        vm.context.moveTo(startX, startY);
        vm.context.lineTo(x, y);
        vm.context.lineWidth = 4;
        vm.context.lineCap = 'round';
        vm.context.strokeStyle = "blue";
        vm.context.stroke();
      }
    },
    send(){
      var vm = this
      var b64Image = vm.canvas.toDataURL();
      var u8Image  = this.tran(b64Image);
      vm.$emit('firma', u8Image);
    },
    tran (b64Image) {
        var img = atob(b64Image.split(',')[1]);
        var img_buffer = [];
        var i = 0;
        while (i < img.length) {
            img_buffer.push(img.charCodeAt(i));
            i++;
        }
        return new Uint8Array(img_buffer);
    }
  }
}
</script>
<style>
.border{
  border-radius: 3px;
}
</style>
