<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="reception" />
      </div>
      <div
        id="modal-notifi-reception"
        class="uk-flex-top"
        uk-modal="esc-close:false; bg-close:false"
      >
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
          <div class="uk-width-1-1 uk-margin">
            <img
              src="../../assets/logo.svg"
              width="120px"
              alt=""
              class="uk-margin-right"
            >
          </div>
          <div class="uk-text-muted">
            <span class="uk-text-small uk-margin-left">Recepción creada.</span><br><br>
            <span class="uk-text-small uk-margin-left"><span uk-icon="icon: hashtag" />: {{ reception.id }}</span><br>
            <span class="uk-text-small uk-margin-left"><span uk-icon="icon: calendar" />: {{ reception.date }}</span><br>
            <span class="uk-text-small uk-margin-left"><span uk-icon="icon: file-text" />: {{ reception.description }}</span><br>
            <span class="uk-text-small uk-margin-left"><span uk-icon="icon: social" />: {{ reception.type }}</span><br>
          </div>
          <button
            class="uk-button uk-button-primary uk-modal-close uk-button-small uk-float-right"
            type="button"
            @click="redi"
          >
            Ok
          </button> 
        </div>
      </div>
      <div
        id="modal-notifi"
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
          <span class="uk-text-small uk-margin-left">{{ msg }}</span>
        </div>
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
              <span class="uk-text-small uk-margin-left">{{ msgComplete }}</span>
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
      <div
        id="modal-init"
        uk-modal="esc-close:false; bg-close: false"
      >
        <div class="uk-modal-dialog uk-margin-auto-vertical uk-box-shadow-medium border">
          <div class="uk-modal-body">
            <p class="uk-text-emphasis">
              Escoja el tipo de recepción.
            </p>   
            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
              <label><input
                v-model="type"
                class="uk-radio"
                value="Blindaje"
                type="radio"
                name="radio2"
                checked
              > Blindaje</label>
              <label><input
                v-model="type"
                class="uk-radio"
                value="Mantenimiento"
                type="radio"
                name="radio2"
              > Mantenimiento</label>
            </div>
            <button
              class="uk-button uk-modal-close uk-button-primary uk-button-small uk-float-right"
              type="button"
              @click="closeInit"
            >
              Listo
            </button> 
          </div>
        </div>
      </div>
      <div
        class="cont uk-width-expand uk-background-default"
        style="border-top:1px solid darkgray"
      >
        <div class="uk-clearfix uk-margin-left uk-margin-right uk-margin uk-padding-small uk-box-shadow-medium">
          <h3 class="uk-text-primary uk-text-normal uk-float-left">
            Recepción de Vehículo - {{ type }}
          </h3>
          <div
            class="uk-button-group uk-float-right uk-margin-small-bottom"
            uk-switcher="connect: #my-id; animation: uk-animation-fade; toggle: > *;"
          >
            <button
              class="b b-l"
              :style="{color: cgeneral}"
              @click="cl('g')"
            >
              General
              <span
                v-if="statusGeneral > 0"
                class="uk-background-default uk-text-danger uk-badge uk-text-small"
              >!</span>
            </button>
            <button
              class="b"
              :style="{color: caccesorios}"
              @click="cl('a')"
            >
              Accesorios y Herramientas
            </button>
            <button
              class="b"
              :style="{color: cexterior}"
              @click="cl('e')"
            >
              Exterior
            </button>
            <button
              class="b b-r"
              :style="{color: ccliente}"
              @click="cl('c')"
            >
              Cliente
              <span
                v-if="statusClient > 0"
                class="uk-background-default uk-text-danger uk-badge uk-text-small"
              >!</span> 
            </button>
          </div>
          <ul
            id="my-id"
            class="uk-switcher uk-width-1-1 uk-float-left"
          >
            <li>
              <General
                @status="statusGeneral=$event"
                @data="general=$event"
              />
            </li>
            <li><Accesorios @data="accessories=$event" /></li>
            <li><Exterior @data="exteriors=$event" /></li>
            <li>
              <Client
                @status="statusClient=$event"
                @data="client=$event"
                @end="prepareData"
                @dataImages="clientImages=$event"
              />
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import MyHeader from "@/components/Header";
import Menu from "@/components/Menu";
import General from "@/components/registrar_auto/General";
import Accesorios from "@/components/registrar_auto/Accesorios";
import Exterior from "@/components/registrar_auto/Exterior";
import Client from "@/components/registrar_auto/Client";
import UIkit from "uikit";
import api from "@/api/Global";

export default {
  name: "Recepcion",
  components: {
    MyHeader,
    General,
    Accesorios,
    Exterior,
    Client,
    Menu
  },
  props:{

  },
  data() {
    return {
      msgComplete: '',
      // style
      cgeneral:'#1e87f0',
      caccesorios:'#666',
      cexterior:'#666',
      ccliente:'#666',
      // verificaciones
      statusGeneral: 1,
      statusClient: 1,
      type: 'Blindaje',
      msg: 'enviando...',
      // formularios
      general: '',
      client:  '',
      clientImages: [],
      accessories: [],
      exteriors: [],
      reception: {
        id: 0,
        data: '',
        description: '',
        type: ''
      }
    };
  },
  computed: {

  },
  mounted(){
    UIkit.modal('#modal-init').show();
  },
  methods: {
    cl(e){
      this.cgeneral='#666',
      this.caccesorios='#666',
      this.cexterior='#666',
      this.ccliente='#666'
      switch (e) {
        case 'g':
          this.cgeneral= '#1e87f0'
          break;
        case 'a':
          this.caccesorios= '#1e87f0'
          break;
        case 'e':
          this.cexterior= '#1e87f0'
          break;
        case 'c':
          this.ccliente= '#1e87f0'
          break;
        default:
          break;
      }
    },
    closeInit() {
      UIkit.modal('#modal-init').hide();
    },
    closeAlert() {
      UIkit.modal('#modal-alert').hide();
    },
    prepareData(){
      if(this.statusGeneral == 0 ){
        if(this.statusClient == 0) {
          let formData = new FormData(); 
          // Datos del Cliente
          formData.append("idCustomer", this.client.idCustomer);
          formData.append("description", this.client.description);
          formData.append("fileFirm", this.client.file);
          formData.append("type", this.type);
          // Datos General
          formData.append('general', JSON.stringify(this.general));
          // Datos de Accesorios
          for (let index = 0; index < this.accessories.length; index++) {
            formData.append("accessories["+index+"][state]", this.accessories[index].state);
            formData.append("accessories["+index+"][extra]", this.accessories[index].extra);
            formData.append("accessories["+index+"][description]", this.accessories[index].description);
            formData.append("accessories["+index+"][file]", this.accessories[index].file);
            formData.append("accessories["+index+"][idTitle]", this.accessories[index].idTitle);
          }
          // Datos de Exteriores
          for (let index = 0; index < this.exteriors.length; index++) {
            formData.append("exteriors["+index+"][title]", this.exteriors[index].title);
            formData.append("exteriors["+index+"][description]", this.exteriors[index].description);
            formData.append("exteriors["+index+"][file]", this.exteriors[index].file);
          }
          // Images del carro
          let existImages = 'no'
          if(this.clientImages.length > 0){
            for (let index = 0; index < this.clientImages.length; index++) {
              formData.append("clientImages["+index+"][file]", this.clientImages[index]);
            }
            existImages = 'si';
          }
          // validación
          formData.append("existImages", existImages);
          this.createReception(formData);
        }else{
          this.msgComplete = 'Complete el paso Cliente'
          UIkit.modal('#modal-alert').show();
        }
      }else{
        this.msgComplete = 'Complete el paso General'
        UIkit.switcher('#my-id').show(0);
        UIkit.modal('#modal-alert').show();
      }
      this.statusGeneral = 0;
      this.statusClient = 0;
    },
    createReception(send) {
      UIkit.modal('#modal-notifi').show();
      this.msg = 'registrando...';
      api.init('receptions', 'multipart/form-data');
      api.create(send).then(response => {
      this.msg = 'registrando...';
      this.reception = response.data.reception;
      console.log(response.data.reception)
      })
      .catch(error => {
      this.error = true;
      console.log(error)
      })
      .finally(()=>{        
        UIkit.modal('#modal-notifi').hide()
        UIkit.modal('#modal-notifi-reception').show()
      });
    },
    redi(){
        this.$router.push({ name: 'Tracing', params: { id: 0 }});
    }
  }
};
</script>
<style lang="scss">
.border {
  border-radius: 3px;
}
.b{
  background-color: transparent;
  width: auto;
  height: 30px;
  border: none;
  border-left: 1px solid #c5d9e8;
  border-top: 1px solid #c5d9e8;
  border-bottom: 1px solid #c5d9e8;
  font-size: 12px;
  color: #666;
  box-shadow: rgb(236, 235, 235) 0px 1px;
}
.b-l{
  border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
  }
  .b-r{
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
        border-right: 1px solid #c5d9e8;

  }
  .b:focus{
    color: #1e87f0;
  }
  .b:hover{
    cursor: pointer;
  }
  .rc {
    border: 1px solid gray;
    background: white;
    border-radius: 1px;
  }
</style>
