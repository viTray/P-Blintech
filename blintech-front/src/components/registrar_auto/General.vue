<template>
  <div>
    <header class="uk-background-primary ">
      <h3 class="uk-text-secondary uk-padding-small uk-heading-bullet">
        General
      </h3>
    </header>
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
                class="uk-input"
                type="text"
                placeholder="..."
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
          ><span
            v-if="general.owner == ''"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Propietario</label>
          <div class="uk-form-controls">
            <input
              id="general_owner"
              v-model="general.owner"
              class="uk-input"
              type="text"
              placeholder="..."
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
            checked
          > Si</label>
          <label class="uk-margin-right"><input
            v-model="general.circulation"
            class="uk-radio"
            type="radio"
            name="radio1"
            value="no"
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
              checked
            > Si</label>
            <label class="uk-margin-right"><input
              v-model="general.authenticatedCirculation"
              class="uk-radio"
              type="radio"
              name="radio2"
              value="no"
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
              min="0"
              class="uk-input"
              type="number"
              placeholder="..."
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
            for="form-horizontal-select"
          >Marca de Vehículo</label>
          <div class="uk-form-controls">
            <select
              id="form-horizontal-select"
              class="uk-select"
              @change="general.idBrand = $event.target.value"
            >
              <option
                v-for="x in brands"
                :key="x.id"
                :value="x.id" 
              >
                {{ x.description }}
              </option>
            </select>
            <span
              v-if="spinAll"
              class="uk-margin-small-right uk-float-right"
              uk-spinner
            />
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
            <select
              id="form-horizontal-select"
              class="uk-select"
              @change="general.idType = $event.target.value"
            >
              <option
                v-for="x in types"
                :key="x.id"
                :value="x.id" 
              >
                {{ x.description }}
              </option>
            </select>
            <span
              v-if="spinAll"
              class="uk-margin-small-right uk-float-right"
              uk-spinner
            />
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          ><span
            v-if="general.licensePlate == ''"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Placa de Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_licensePlate"
              v-model="general.licensePlate"
              class="uk-input"
              type="text"
              placeholder="..."
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          ><span
            v-if="general.color == ''"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Color de Vehículo</label>
          <div class="uk-form-controls">
            <input
              id="general_color"
              v-model="general.color"
              class="uk-input"
              type="text"
              placeholder="..."
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          ><span
            v-if="general.chassis == ''"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Chasis</label>
          <div class="uk-form-controls">
            <input
              id="general_chassis"
              v-model="general.chassis"              
              class="uk-input"
              type="text"
              placeholder="..."
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          ><span
            v-if="general.person == ''"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Persona que revisa</label>
          <div class="uk-form-controls">
            <input
              id="general_person"
              v-model="general.person"
              class="uk-input"
              type="text"
              placeholder="..."
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-2@s">
        <div class="uk-margin">
          <label
            class="uk-form-label"
            for="form-horizontal-text"
          ><span
            v-if="general.phone == 0"
            class="uk-text-danger uk-text-small"
          > <span uk-icon="icon: warning" /></span> Teléfono</label>
          <div class="uk-form-controls">
            <input
              id="general_phone"
              v-model="general.phone"
              class="uk-input"
              type="number"
              min="0"
              maxlength="8"
              placeholder="..."
              @input="maxLengthCheck($event.target.value)"
            >
          </div>
        </div>
      </div>
      <div class="uk-width-1-1@s">
        <button
          class="uk-button uk-button-primary uk-float-right"
          uk-switcher-item="next"
          type="submit"
          @click="check()"
        >
          <span class="uk-text-small">Siguiente</span>
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import Flatpickr from "flatpickr";
import 'flatpickr/dist/flatpickr.css';
import 'flatpickr/dist/themes/dark.css';
import { Spanish } from "flatpickr/dist/l10n/es.js"
import api from '@/api/Global';

export default {
  name: "General",
  components: {
  },
  props:{
  },
  data() {
    return {
      nivel: '',
      saving: false,
      spinAll: false,
      brands: [],
      types: [],
      status: false, 
      general: {
        circulation: 'si',
        authenticatedCirculation: 'si',
        level: 0,
        owner: '',
        idBrand: 1,
        idType: 1,
        color: '',
        mileage: 0,
        licensePlate: '',
        chassis: '',
        person: '',
        phone: 0
      },
    };
  },
  computed: {},
  mounted(){
    Flatpickr('#datepicker',{
      "locale": Spanish,
      dateFormat: "d-m-y",
      altInput: true,
      altFormat: "F j, Y",
      defaultDate: new Date()
    });
    this.all();
  },
  methods: {
    maxLengthCheck(e)
    {
      if(e > 8){
        this.general.phone = e.slice(0, 8)
      }
    },
    check() {
    var x = 0 ;
      if(this.general.owner == '') {
        x+= 1;
      }
      if(this.general.licensePlate == '') {
        x+= 1;
      }
      if(this.general.color == '') {
        x+= 1;
      }
      if(this.general.chassis == '') {
        x+= 1;
      }
      if(this.general.person == '') {
        x+= 1;
      }
      if(this.general.phone == '') {
        x+= 1;
      }
      this.$emit('status', x);
      this.$emit('data', this.general);      
    },
    all() {
      this.spinAll = true;
      api.init('brands');
      api.all()
      .then(response => {
        this.brands = response.data.brands;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally();

      api.init('types');
      api.all()
      .then(response => {
        this.types = response.data.types;
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
<style lang="scss">
#id{
  width: 100%
}
</style>
