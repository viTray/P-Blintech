<template>
  <div>
    <header class="uk-background-primary ">
      <h3 class="uk-text-secondary uk-padding-small uk-heading-bullet">
        Cliente
      </h3>
    </header>
    <form
      action=""
      class="uk-padding-small uk-grid-small"
      uk-grid
    >
      <div class="uk-margin uk-width-1-1@s">
        <label
          class="uk-form-label"
          for="form-horizontal-select"
        >Cliente:</label>
        <div class="uk-form-controls">
          <select
            id="form-horizontal-select"
            class="uk-select"
            @change="view($event.target.value)"
          >
            <option value="0" />
            <option
              v-for="x in customers"
              :key="x.id"
              :value="x.id" 
            >
              {{ x.name }}
            </option>
          </select>
          <span
            v-if="spinAll"
            class="uk-margin-small-right uk-float-right"
            uk-spinner
          />
        </div>
        <div class="uk-margin">
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: user" /> {{ customer.name }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: mail" /> {{ customer.email }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: receiver" /> {{ customer.phone }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: file-text" /> {{ customer.nit }}</span><br>
        </div>
      </div>
      <div class="uk-margin uk-width-1-1">
        <label
          class="uk-form-label"
          for="form-stacked-text"
        >Descripción:</label>
        <div class="uk-form-controls">
          <textarea
            v-model="description"
            class="uk-textarea"
            rows="2"
            placeholder="..."
          />
        </div>
      </div>
      <div class="uk-margin uk-width-1-1@s">
        <label
          class="uk-form-label"
          for="form-horizontal-text"
        >Estatus del Carro:</label>
        <div
          class="js-upload"
          uk-form-custom
        >
          <input 
            type="file"
            multiple
            accept="image/*"
            capture="camera"
            @change="handleFile($event.target.files[0])"
          >
          <a                       
            class="uk-icon-button uk-margin-left  uk-float-right uk-text-default"
            tabindex="-1"
            uk-icon="link"
          />
        </div>
        <ul uk-accordion>
          <li>
            <a
              class="uk-accordion-title"
              href="#"
            > <span uk-icon="icon: image" /></a>
            <div class="uk-accordion-content">
              <div
                class="uk-child-width-1-6@s uk-text-center"
                uk-grid
              >
                <div 
                  v-for="x in filesn" 
                  :key="x"
                >
                  <img
                    :src="x"
                    class="cimg uk-box-shadow-medium"
                  >
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="uk-width-1-1">
        <button
          class="uk-button uk-button-primary uk-float-right"
          uk-switcher-item="3"
          @click="checkClient"
        >
          Finalizar
        </button>
        <button
          class="uk-button uk-button-success uk-float-right uk-margin-small-right"
          uk-switcher-item="previous"
        >
          <span class="uk-text-small">Anterior</span>
        </button>
      </div>
    </form>
    <div
      id="modal-firma"
      uk-modal
    >
      <div class="uk-modal-dialog uk-modal-body">
        <div class="uk-margin">
          <button
            class="uk-modal-close-default"
            type="button"
            uk-close
          />
          <MyCanvasFirma
            title="Firma del Cliente"
            @firma="fileFirma=$event"
          />
        </div>
        <button
          class="uk-button uk-button-secondary uk-button-small uk-float-right"
          type="button"
          @click="check()"
        >
          Enviar
        </button>
        <span
          v-if="spinAll"
          class="uk-margin-small-right uk-float-left"
          uk-spinner
        />
      </div>
    </div>
    <div
      id="modal-alert-client"
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
            <span class="uk-text-small uk-margin-left">{{ msgAlert }}</span>
          </div>
          <button
            class="uk-button uk-button-primary uk-button-small uk-float-right"
            @click="checkClient()"
          >
            Ok
          </button>  
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import MyCanvasFirma from "@/components/my_canvas/CanvasFirma";
import api from '@/api/Global';
import UIkit from "uikit";

export default {
  name: "Client",
  components: {
    MyCanvasFirma
  },
  props:{
  },
  data() {
    return {
      title: '',
      saving: false,
      spinAll: false,
      msgAlert: '',
      fileFirma: '',
      description: '',
      files: [],
      filesn: [],
      customers: [],
      customer: {
        name: '',
        email: '',
        phone: '',
        nit: '',
        file: '',
        id: 0
      },
    };
  },
  computed: {},
  mounted(){
    this.getAll();
  },
  methods: {
    getAll() {
      this.spinAll = true;
      api.init('customers');
      api.all('all')
      .then(response => {
        this.customers = response.data.customers;
      })
      .catch(error => {
        console.log(error);
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
      },
      view(id) {
      console.log(id)
      this.spinAll = true;
      api.init('customers');
      api.find(id)
        .then(response => {
          this.customer = response.data.customer;
        })
        .catch(error => {
          console.log(error.response);
          this.error = true;
        })
        .finally(() => this.spinAll = false);      
      },
      check() {
        if(this.fileFirma){          
          UIkit.modal('#modal-firma').hide();
          let object = {
            "idCustomer": this.customer.id,
            "description": this.description,
            "file": new File([ this.fileFirma ], {type: "image/png"})
          };
          this.$emit('data', object);
          this.$emit('dataImages', this.files);
          this.$emit('status', 0);
          this.$emit('end', true);
        }else{
          this.msgAlert = 'Firma requerida!'
          UIkit.modal('#modal-alert-client').show();
        }
      },
      checkClient() {
        console.log(this.customer)
        if(this.description != '' && this.customer.id != 0) {
          UIkit.modal('#modal-firma').show();
        }else{
          this.msgAlert = 'Completa el paso el cliente!'
          UIkit.modal('#modal-alert-client').show();
        }
      },
      handleFile(file){
        this.files.push(file);
        this.filesn.push(URL.createObjectURL(file));
      }
  }
};
</script>
<style lang="scss" scoped>
.cimg {
  width: 150px;
  border-radius: 3px;
}
</style>
