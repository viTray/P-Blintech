<template>
  <div>
    <li>
      <span class="uk-float-left">{{ title }}</span>
      <div class="uk-float-right">
        <input
          class="uk-radio uk-margin-left"
          type="radio"
          :name="code"
          @change="cambioRadio1"
        >
        <input
          class="uk-radio uk-margin-left"
          type="radio"
          :name="code"
          @change="cambioRadio2"
        >
        <input
          class="uk-checkbox uk-margin-left"
          type="checkbox"
          :checked="checked1"
          @change="cambioChecked1"
        > 
        <div uk-drop="mode: click">
          <div
            class="uk-card uk-card-body uk-card-default uk-padding-remove uk-background-default"
            style="width:250px"
          >
            <div
              class="uk-padding-small uk-width-1-1"
              style="border: 1px solid black"
            >
              <span>Observación</span>
              <textarea
                class="uk-textarea"
                rows="3"
                placeholder="..."
                style="border: 1px solid black"
              />
              <div>
                <ul
                  uk-accordion
                  class="uk-padding-remove"
                >
                  <li>
                    <a class="uk-accordion-title"><span uk-icon="icon: image" /></a>
                    <div class="uk-accordion-content uk-text-center">
                      <img
                        ref="img"
                        src=""
                        width="200px"
                        height="100px"
                        alt=""
                      >
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="uk-width-1-1 uk-flex">
              <div
                class="js-upload"
                uk-form-custom
              >
                <input
                  id="mypic"
                  ref="input"
                  type="file"
                  accept="image/*"
                  capture="camera"
                >
                <button
                  class="uk-button uk-button-primary"
                  style="width:125px"
                  type="button"
                  tabindex="-1"
                >
                  <span class="uk-text-small">Subir Foto</span>
                </button>
              </div>
              <button
                class="uk-button uk-button-danger"
                style="width:125px"
              >
                Enviar
              </button>
            </div>
          </div>
        </div>
      </div>
    </li>
  </div>
</template>

<script>
export default {
  
  name: 'Hijopruebas',
  props:{
    title: {
      type: String,
      default: 'Undefined'
    },
    code: {
      type: String,
      default: 'Undefined'
    },
  },
  data () {
    return {
      v:''
    }
    },
  mounted(){
    var input = this.$refs.input    
    var img = this.$refs.img;
      input.onchange = function (e) {
      console.log(e)
        var file = URL.createObjectURL(e.target.files[0]);
        img.src = file;
      }
    },
  methods: {
      cambioRadio1(){
          this.v= 'si'
          console.log(this.v)

      },
        cambioRadio2(){
          this.v= 'no'
          console.log(this.v)
      },
      cambioChecked1(){
        console.log(this.checked1)
      }
  }
}
</script>
<style>

</style>
