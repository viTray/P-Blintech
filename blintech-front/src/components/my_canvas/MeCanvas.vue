<template>
  <div
    class="uk-flex-center"
    uk-grid
  >
    <div>
      <ul class="uk-breadcrumb">
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
            type="button"
            uk-icon="icon: paint-bucket"
            :style="{ color: color }"
          />
          <div
            uk-dropdown="pos: bottom-left"
            style="border: 1px solid darkgrey"
          >
            <div class="uk-padding-remove">
              <span class="uk-text-muted">Colores:</span>
              <ul
                class="uk-nav uk-dropdown-nav uk-text-center"
                uk-grid
              >
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:black"
                    @click="color= 'black'"
                  />
                </li>
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:blue"
                    @click="color= 'blue'"
                  />
                </li>
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:yellow"
                    @click="color= 'yellow'"
                  />
                </li>
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:red"
                    @click="color= 'red'"
                  />
                </li>
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:lightblue"
                    @click="color= 'lightblue'"
                  />
                </li>
                <li>
                  <button
                    class="uk-button uk-button-text"
                    uk-icon="icon: paint-bucket"
                    style="color:green"
                    @click="color= 'green'"
                  />
                </li>
              </ul>
            </div>
          </div>
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
      <div class="uk-width-auto@s">
        <canvas
          id="canvas"
          ref="canvas"
          width="550"
          height="300"
        />
      </div>
    </div>
    <div class="uk-width-expand@l">
      <h3 class="uk-card-title uk-text-primary">
        {{ title }}
      </h3>
      <div class="uk-margin uk-width-1-1">
        <label
          class="uk-form-label"
          for="form-stacked-text"
        >Descripción:</label>
        <div class="uk-form-controls">
          <textarea
            v-model="description"
            class="uk-textarea"
            rows="5"
            placeholder="..."
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  
  name: 'Mecanvas',
    
  props:{
      title: {
        type: String,
        default: 'Undefined'
      },
      no: {
        type: String,
        default: 'Undefined'
    },

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
      description: ''
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

    document.addEventListener('touchend', vm.mouseup) ;
    document.addEventListener('mouseup', vm.mouseup) ;
    let formData = new FormData();
      formData.append("title", this.title);
      formData.append("descriptions", null);
      vm.$emit('init', formData);
    var foto = new Image()
    switch (this.no) {
      case "1":
        foto.src = require("../../assets/toyotalefty.png")
        break;
      case "2":
        foto.src = require("../../assets/toyotarighty.png")
        break;
      case "3":
        foto.src = require("../../assets/toyotacentery.png")
        break;
      case "4":
        foto.src = require("../../assets/toyotatopy.png")
        break;
      default:
        break;
    }
    foto.onload = function(){
      vm.context.drawImage(foto, 0, 20);
    }
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
      var foto = new Image()
      switch (this.no) {
        case "1":
          foto.src = require("../../assets/toyotalefty.png")
          break;
        case "2":
          foto.src = require("../../assets/toyotarighty.png")
          break;
        case "3":
          foto.src = require("../../assets/toyotacentery.png")
          break;
        case "4":
          foto.src = require("../../assets/toyotatopy.png")
          break;
        default:
          break;
      }
      foto.onload = function(){
        vm.context.drawImage(foto, 0, 0);
      }
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
      var foto = new Image()
      switch (this.no) {
        case "1":
          foto.src = require("../../assets/toyotalefty.png")
          break;
        case "2":
          foto.src = require("../../assets/toyotarighty.png")
          break;
        case "3":
          foto.src = require("../../assets/toyotacentery.png")
          break;
        case "4":
          foto.src = require("../../assets/toyotatopy.png")
          break;
        default:
          break;
      }
      foto.onload = function(){
        vm.context.drawImage(foto, 0, 0);
      }
      // load localStorage
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
        vm.context.lineWidth = 3;
        vm.context.lineCap = 'round';
        vm.context.strokeStyle = "blue";
        vm.context.stroke();
      }
    },
    send(){
      var vm = this
      var b64Image = vm.canvas.toDataURL();
      var u8Image  = this.tran(b64Image);
      let object = {
        "title": this.title,
        "description": this.description,
        "file": new File([ u8Image ], {type: "image/png"})
      }
      vm.$emit('print', object);
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
<style lang="css">
  #canvas{
    cursor: all-scroll;  
  }
</style>
