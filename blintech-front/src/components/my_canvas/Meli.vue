<template>
  <li>
    <span class="uk-float-left uk-text-middle uk-text-small">{{ title }}</span>
    <div class="uk-float-right">
      <input
        class="uk-radio uk-margin-left"
        type="radio"
        :name="code"
        checked
        @click="status = 'si'; meliChange()"
      >
      <input
        class="uk-radio uk-margin-left"
        type="radio"
        :name="code"
        @click="status = 'no'; meliChange()"
      >
      <input
        class="uk-checkbox uk-margin-left"
        type="checkbox"
        @click="extrax($event.target.checked); meliChange()"
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
              v-model="description"
              class="uk-textarea"
              rows="3"
              placeholder="..."
              style="border: 1px solid black"
              @change="meliChange"
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
          <div class="uk-width-1-1">
            <div
              class="js-upload uk-width-1-1"
              uk-form-custom
            >
              <input
                id="mypic"
                ref="input"
                type="file"
                accept="image/*"
                capture="camera"
                @change="file = $event.target.files[0]; x += 1; meliChange();"
              >
              <button
                class="uk-button uk-button-primary uk-width-1-1"
                type="button"
                tabindex="-1"
              >
                <span class="uk-text-small">Foto</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </li>
</template>

<script>

export default {
  name: 'Meli',
    props:{
      title: {
        type: String,
        default: 'Undefined'
      },
      code: {
        type: Number,
        default: 0
      },
      id: {
        type: Number,
        default: 0
      },
    },
    data () {
      return {
        status: 'si',
        extra: 'no',
        description: null,
        file: null,
        x: 0
      }
    },
    mounted(){
      var input = this.$refs.input    
      var img = this.$refs.img;
      input.onchange = function (e) {
        var file = URL.createObjectURL(e.target.files[0]);
        img.src = file;
      }
    },
    methods:{
      meliChange() {
          let object = {
            "state": this.status,
            "extra": this.extra,
            "description": this.description,
            "idTitle": this.id,
            "file": "/"
            }
          if(this.x > 0){
            object["file"] = this.file;
          }
          this.$emit('changes', object);
      },
      extrax(e){
        if(e == true){
          this.extra = 'si'
        }else{
          this.extra = 'no'
        }
      }
    }
}
</script>
<style lang="scss" scoped>
  .uk-button{
    border-radius: 0px;
  }
</style>
