<template>
  <div class="uk-padding-small">
    <header class="uk-background-default ">
      <h3 class="uk-text-primary uk-padding-remove uk-margin-remove uk-heading-bullet">
        General
      </h3>
    </header>          
    <div class="uk-width-1-1 uk-text-center">
      <span
        v-if="spinAll"
        class="uk-margin-small-right"
        uk-spinner
      />
    </div>
    <form
      action=""
      class="uk-padding-small uk-grid-small"
      uk-grid
    >
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Fecha de Recepción</label>
          <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
              <span
                class="uk-form-icon uk-form-icon-flip"
                uk-icon="icon: calendar"
              />
              <input
                id="datepicker"
                v-model="general.created_at"
                class="uk-input"
                type="text"
                disabled
              >
            </div>
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Propietario</label>
          <div class="uk-form-controls">
            <input
              id="general_owner"
              v-model="general.owner"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-margin uk-width-1-2@s">
        <label
          class="uk-form-label"
          for="form-horizontal-select"
        >Tarjeta de Circulación</label>
        <div class="uk-form-controls uk-flex">
          <label class="uk-margin-right"><input
            v-model="general.circulation"
            class="uk-radio"
            type="radio"
            name="radio1"
            value="si"
            disabled
          > Si</label>
          <label class="uk-margin-right"><input
            v-model="general.circulation"
            class="uk-radio"
            type="radio"
            name="radio1"
            value="no"
            disabled
          > No</label>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-select"
          >Tarjeta de Circulación Autenticada</label>
          <div class="uk-form-controls uk-flex">
            <label class="uk-margin-right"><input
              v-model="general.authenticatedCirculation"
              class="uk-radio"
              type="radio"
              name="radio2"
              value="si"
              disabled
            > Si</label>
            <label class="uk-margin-right"><input
              v-model="general.authenticatedCirculation"
              class="uk-radio"
              type="radio"
              name="radio2"
              value="no"
              disabled
            > No</label>
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Kilometraje</label>
          <div class="uk-form-controls">
            <input
              id="general_mileage"
              v-model="general.mileage"
              class="uk-input"
              type="number"
              placeholder="0"
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Nivel de Gasolina</label>
          <br>
          <input
            class="uk-range"
            type="range"
            value="2"
            min="0"
            max="100"
            step="1"
            disabled
            @change="slider($event.target.value)"
          >                
          <span
            class="uk-float-right"
            uk-icon="icon: settings"
          > {{ nivel }} </span>
          <span class="uk-float-left"> {{ general.level }}%</span>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Marca de Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_mileage"
              v-model="general.brand.description"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div> 
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Tipo de Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_licensePlate"
              v-model="general.type.description"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Placa del Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_mileage"
              v-model="general.licensePlate"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Color de Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_color"
              v-model="general.color"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Chasis</label>
          <div class="uk-form-controls">
            <input
              id="general_chassis"
              v-model="general.chassis"              
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Persona que revisa</label>
          <div class="uk-form-controls">
            <input
              id="general_person"
              v-model="general.person"
              class="uk-input"
              type="text"
              placeholder="..."
              disabled
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          >Teléfono</label>
          <div class="uk-form-controls">
            <input
              id="general_phone"
              v-model="general.phone"
              class="uk-input"
              type="number"
              placeholder="0000-0000"
              disabled
            >
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script> 
import api from '@/api/Global';

export default {
  name: "GeneralDetail",
  components: {

  },
  props:{
  },
  data() {
    return {
      nivel: '',
      id: 0,
      spinAll: false,
      general: {
        created_at: '',
        idReception: 0,
        date: '',
        circulation: 'si',
        authenticatedCirculation: 'si',
        level: 0,
        owner: '',
        idBrand: 1,
        idType: 1,
        type: {
          description: ''
        },
        brand: {
          description: ''
        },
        color: '',
        mileage: 0, 
        licensePlate: '',
        chassis: '',
        person: '',
        phone: 0
      },
    };
  },
  computed: {
  },
  mounted(){
    this.id = sessionStorage.getItem('idReception')
    this.init();
  },
  methods: {
    init() {
      this.spinAll = true;
      api.init('generals');
      api.all('', '', this.id)
      .then(response => {
        this.general = response.data.general;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    },
        slider(e){
      this.general.level= e;
      if(e < 30){
        this.nivel= 'Empty'
      }
      if(e < 70 && e > 30){
        this.nivel= 'R'
      }
      if(e > 70){
        this.nivel= 'Full'
      }
    }

  }
};
</script>
<style lang="scss" scoped>
span{
    font-size: 18px
}
.uk-input {
  background-color: transparent;
}
</style>
