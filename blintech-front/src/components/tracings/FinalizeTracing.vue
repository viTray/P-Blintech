<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="tracing" />
      </div>
      <div
        id="modal-notifi-end"
        class="uk-flex-top"
        uk-modal="esc-close:false; bg-close:false"
      >
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
          <img
            src="../../assets/logo.svg"
            width="120px"
            alt=""
            class="uk-margin-right"
          >
          <span
            class="uk-margin-left uk-float-right"
            uk-spinner
          />
          <span class="uk-text-small uk-margin-left">Finalizando recepción...</span>
        </div>
      </div>
      <div class="cont uk-background-default uk-width-1-1">
        <div class="uk-clearfix uk-margin-left">
          <h3 class="uk-text-primary uk-text-normal uk-float-left uk-heading-bullet">
            Finalizar Seguimiento
          </h3>
        </div>
        <div class="uk-margin-left">
          <div class="uk-width-1-1 uk-text-center">
            <span
              v-if="spinAll"
              class="uk-margin-small-right"
              uk-spinner
            />
          </div>
          <p class="uk-text-small uk-text-muted">
            <span uk-icon="user" /> {{ reception.customer.name }} <br>
            <span uk-icon="lifesaver" /> {{ reception.general[0].licensePlate }} <br>
            <span uk-icon="receiver" /> {{ reception.customer.phone }} <br>
            <span uk-icon="mail" /> {{ reception.customer.email }} <br>                    
          </p>
          <div class=" uk-label uk-margin-small-right">
            {{ id }}
          </div>
          <div class=" uk-label uk-margin-small-right">
            {{ reception.type }}
          </div>
        </div>
        <form class="uk-padding uk-margin-remove uk-form-horizontal uk-margin-large">
          <fieldset class="uk-fieldset">
            <legend class="uk-legend">
              Encuesta al Servicio
            </legend>

            <div class="uk-margin">
              <label
                class="uk-form-label"
                for="form-horizontal-text"
              >                                <span
                v-if="qualification == 0"
                class="uk-text-danger uk-text-small"
              > <span uk-icon="icon: warning" /></span>
                Calificación:</label>
              <div class="uk-form-controls">                      
                <p class="clasificacion uk-text-left">
                  <input
                    id="radio1"

                    v-model="qualification"
                    type="radio"
                    name="estrellas"
                    value="5"
                  ><label for="radio1"><span uk-icon="icon: uikit; ratio: 2" /></label>
                  <input
                    id="radio2"
                    v-model="qualification"
                    type="radio"
                    name="estrellas"
                    value="4"
                  ><label for="radio2"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                    id="radio3"

                    v-model="qualification"
                    type="radio"
                    name="estrellas"
                    value="3"
                  ><label for="radio3"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                    id="radio4"

                    v-model="qualification"
                    type="radio"
                    name="estrellas"
                    value="2"
                  ><label for="radio4"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                    id="radio5"

                    v-model="qualification"
                    type="radio"
                    name="estrellas"
                    value="1"
                  ><label for="radio5"><span uk-icon="icon: uikit; ratio: 2" /></label>
                </p>
              </div>
            </div>
            <div class="uk-margin">
              <label
                class="uk-form-label"
                for="form-horizontal-text"
              >                                                <span
                v-if="commentary == ''"
                class="uk-text-danger uk-text-small"
              > <span uk-icon="icon: warning" /></span>
                Comentario:</label>
              <div class="uk-form-controls">
                <textarea
                  v-model="commentary"
                  class="uk-textarea"
                  rows="3"
                  placeholder="..."
                />
              </div>
            </div>
            <div class="uk-margin">
              <div
                id="modal-firm-client"
                uk-modal
              >
                <div class="uk-modal-dialog uk-modal-body">
                  <div class="uk-margin">
                    <button
                      class="uk-modal-close-default"
                      type="button"
                      uk-close
                    />
                    <MyCanvas
                      title="Firma del cliente"
                      @firma="fileFirm=$event"
                    />
                    <span
                      v-if="error"
                      class="uk-text-danger uk-text-small"
                    >{{ msg }}</span>
                  </div>
                  <a
                    class="uk-float-right uk-button uk-button-primary"
                    @click="checkFirm('client')"
                  >Enviar</a>
                </div>
              </div>
            </div>
            <div class="uk-margin">
              <label
                class="uk-form-label"
                for="form-horizontal-text"
              >                                                <span
                v-if="personChecks == ''"
                class="uk-text-danger uk-text-small"
              > <span uk-icon="icon: warning" /></span>
                Entregado por:</label>

              <div class="uk-form-controls">
                <input
                  id="form-horizontal-text"
                  v-model="personChecks"
                  class="uk-input"
                  type="text"
                  placeholder="..."
                >
              </div>
            </div>
            <div class="uk-margin">
              <div
                id="modal-firm-person"
                class="border-radius"
                uk-modal
              >
                <div class="uk-modal-dialog uk-modal-body">
                  <div class="uk-margin">
                    <button
                      class="uk-modal-close-default"
                      type="button"
                      uk-close
                    />
                    <MyCanvas
                      title="Firma del encargado"
                      @firma="fileFirmPersonChecks=$event"
                    />
                    <span
                      v-if="error"
                      class="uk-text-danger uk-text-small"
                    >{{ msg }}</span>
                  </div>
                  <div>
                    <a
                      class="uk-float-right uk-button uk-button-primary"
                      @click="checkFirm('person')"
                    >Siguiente</a>
                  </div>
                  <span
                    v-if="spinAll"
                    class="uk-margin-small-right uk-float-left"
                    uk-spinner
                  />
                </div>
              </div>
            </div>
            <div class="uk-margin uk-width-1-1">
              <div class="uk-form-label">
                <div
                  class="js-upload"
                  uk-form-custom
                >
                  <input 
                    type="file"
                    multiple
                    @change="handleFile($event.target.files[0])"
                  >
                  <span
                    v-if="filePhoto == null"
                    class="uk-text-danger uk-text-small"
                  > <span uk-icon="icon: warning" /></span>

                  <a
                    class="uk-button uk-button-text uk-margin-right uk-text-success uk-float-right"
                  > Foto:</a>
                </div>
              </div>
              <div class="uk-form-controls">
                <img
                  ref="img"
                  width="160px"
                  alt=""
                >
              </div>
            </div>
            <div class="uk-width-1-1">
              <a
                class="uk-float-right uk-button uk-button-primary"
                @click="check"
              >Finalizar</a>
            </div>
          </fieldset>
        </form>
      </div>
      <div
        id="modal-alert"
        class="uk-flex-top"
        uk-modal
      >
        <div class="uk-modal-dialog uk-margin-auto-vertical">
          <button
            class="uk-modal-close-default"
            type="button"
            uk-close
          />
          <div class="uk-modal-body">
            <div class="uk-margin">
              <img
                src="../../assets/logo.svg"
                width="120px"
                alt=""
                class="uk-margin-right"
              >
              <span class="uk-text-small uk-margin-left">Complete el formulario!</span>
            </div>
            <button
              class="uk-button uk-button-primary uk-modal-close uk-button-small uk-float-right"
              type="button"
            >
              Ok
            </button>  
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script> 
import MyHeader from "@/components/Header";
import Menu from "@/components/Menu";
import MyCanvas from "@/components/my_canvas/CanvasFirma";
import api from "@/api/Global";
import UIkit from "uikit";

export default {
  name: "Finalize",
  components: {
    MyHeader,
    MyCanvas,
    Menu
  },
  props:{
  },
  data() {
    return {
      id: 0,
      saving: false,
      spinAll: false,
      msg: '',
      finalize: 0,
      error:  false,
      reception: {
        type: '',
        customer: {
          id: 0,
          name: '',
          email: '',
          phone: ''
        },
        general: [
          {
            licensePlate: ''
          }
        ]
      },
      qualification: 0,
      commentary: '',
      personChecks: '',
      filePhoto: null,
      fileFirm: null,
      fileFirmPersonChecks: null
    };
  },
  computed: {},
  mounted(){
    this.id = this.$route.params.id;
    this.init();
  },
  methods: {
    init() {
      this.spinAll = true;
      api.init('receptions');
      api.find(this.id)
      .then(response => {
        this.reception = response.data.reception;
        this.comment.idReception = this.reception.id;
        this.comment.idCustomer = this.reception.customer.id;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    },
    checkFirm(e) {
      if(e == 'person'){
        if(this.fileFirmPersonChecks != null){
          this.error = false;
          UIkit.modal('#modal-firm-client').show();
        }else{
          this.error = true;
          this.msg = 'Firma del encargado requerida!'
        }
      }else{
        if(this.fileFirm != null){
          this.error = false;
          this.createDevilered();
        }else{
          this.error = true;
          this.msg = 'Firma del cliente requerida!'
        }
      }
    },
    check() {
      this.finalize = 0;
      if(this.qualification == 0){
        this.finalize +=1;
      }
      if(this.commentary == ''){
        this.finalize +=1;
      }
      if(this.personChecks == ''){
        this.finalize +=1;
      }
      if(this.filePhoto == null){
        this.finalize +=1;
      }

      if(this.finalize == 0) {
      UIkit.modal('#modal-firm-person').show();
      }else{
      UIkit.modal('#modal-alert').show();
      }
    },
    createDevilered() {
      UIkit.modal('#modal-notifi-end').show();
      api.init('delivereds', 'multipart/form-data')
      let formData = new FormData();
          formData.append("qualification", this.qualification);
          formData.append("idReception", this.id);
          formData.append("commentary", this.commentary);
          formData.append("personChecks", this.personChecks);
          formData.append("photo", new File([ this.filePhoto ], {type: "image/png"}));
          formData.append("firm", new File([ this.fileFirm ], {type: "image/png"}));
          formData.append("firmPersonChecks", new File([ this.fileFirmPersonChecks ], {type: "image/png"}));

      api.create(formData).then(() => {
        this.msg = 'registrando...'
      })
      .catch(() => {
      this.error = true;
      })
      .finally(()=>{
        UIkit.modal('#modal-notifi-end').hide();
        UIkit.notification({
          message: '<span uk-icon="icon: check"></span> <span class="uk-text-small">Recepción Finalizada</span>',
          status: 'primary',
          pos: 'top-right',
          timeout: 3000
        });
        this.$router.push({ name: 'Tracing', params: { id: 0 }});
      });
    },
    handleFile(file){
      this.filePhoto = file;
      var img = this.$refs.img;
      img.src = URL.createObjectURL(file);
    },
  }
};
</script>
<style lang="scss" scoped>
.border-radius {
  border-radius: 3px;
}
.uk-card{
  border: 1px solid darkgray;
}
    #form label {
    font-size: 34px;
    }

    input[type="radio"] {
    display: none;
    }

    p label {
    color: rgb(216, 208, 208);
    }

    .clasificacion {
    direction: rtl;
    unicode-bidi: bidi-override;
    }

    p label:hover,
    label:hover ~ label {
    color: #1e87f0;
    }

    input[type="radio"]:checked ~ label {
    color: #1e87f0;
    }
</style>
