<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="delivereds" />
      </div>
      <div class="cont uk-background-default uk-width-1-1">
        <a
          href=""
          class="uk-icon-button uk-margin-left uk-margin"
          uk-icon="arrow-left"
          @click="rediBack"
        />
        <div class="uk-clearfix uk-margin-left">         
          <h3 class="uk-text-primary uk-text-normal uk-float-left uk-heading-bullet">
            Detalles de la Entrega
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
          <p class="uk-text-small uk-text-muted uk-width-1-1">
            <span uk-icon="user" /> {{ reception.customer.name }} <br>
            <span uk-icon="lifesaver" /> {{ reception.general[0].licensePlate }} <br>
            <span uk-icon="receiver" /> {{ reception.customer.phone }} <br>
            <span uk-icon="mail" /> {{ reception.customer.email }} <br>  
            <br>                  
            <span uk-icon="calendar" /> {{ delivered.date }} <br>  
          </p>
          <div class=" uk-label uk-margin-small-right">
            {{ id }}
          </div>
          <div class=" uk-label uk-margin-small-right">
            {{ reception.type }}
          </div>
          <div class=" uk-label uk-margin-small-right">
            {{ reception.state }}
          </div>
          <a
            class="uk-button uk-button-text uk-margin-right uk-text-success uk-float-right"
            @click="redi"
          ><span uk-icon="folder" /> Detalles</a>
        </div>
        <form
          class="uk-padding uk-margin-remove uk-form-horizontal uk-margin-large"
          uk-grid
        >
          <legend class="uk-legend">
            Encuesta al Servicio
          </legend>

          <div class=" uk-width-1-1 uk-margin">
            <label
              class="uk-form-label"
              for="form-horizontal-text"
            >Calificación:</label>
            <div class="uk-form-controls">                      
              <p class="clasificacion uk-text-left">
                <input
                  id="radio1"

                  v-model="delivered.qualification"
                  type="radio"
                  name="estrellas"
                  value="5"
                ><label for="radio1"><span uk-icon="icon: uikit; ratio: 2" /></label>
                <input
                  id="radio2"
                  v-model="delivered.qualification"
                  type="radio"
                  name="estrellas"
                  value="4"
                ><label for="radio2"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                  id="radio3"

                  v-model="delivered.qualification"
                  type="radio"
                  name="estrellas"
                  value="3"
                ><label for="radio3"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                  id="radio4"

                  v-model="delivered.qualification"
                  type="radio"
                  name="estrellas"
                  value="2"
                ><label for="radio4"><span uk-icon="icon: uikit; ratio: 2" /></label><input
                  id="radio5"

                  v-model="delivered.qualification"
                  type="radio"
                  name="estrellas"
                  value="1"
                ><label for="radio5"><span uk-icon="icon: uikit; ratio: 2" /></label>
              </p>
            </div>
          </div>
          <div class="uk-width-1-1 uk-margin">
            <label
              class="uk-form-label"
              for="form-horizontal-text"
            >Comentario:</label>
            <div class="uk-form-controls">
              <textarea
                v-model="delivered.commentary"
                class="uk-textarea"
                rows="3"
                disabled
              />
            </div>
          </div>
          <div class="uk-margin">
            <label
              class="uk-form-label"
              for="form-horizontal-text"
            >Entregado por:</label>
            <div class="uk-form-controls uk-width-1-1">
              <input
                v-model="delivered.personChecks"
                class="uk-input"
                type="text"
                disabled
              >
            </div>
          </div>
          <div class="uk-width-1-1">
            <a
              href="#modal-galery"
              class="uk-float-right"
              uk-toggle
            ><span uk-icon="icon: folder" /> Galería</a>
            <div
              id="modal-galery"
              uk-modal
            >
              <div class="uk-modal-dialog uk-modal-body border">
                <h5 class="">
                  <span uk-icon="icon: folder" /> Galería:
                </h5>
                <div class="uk-text-center">
                  <div uk-grid>
                    <div class="uk-width-auto@m">
                      <ul
                        class="uk-tab-left"
                        uk-tab="connect: #component; animation: uk-animation-fade"
                      >
                        <li><a href="#">Foto del cliente</a></li>
                        <li><a href="#">Firma del cliente</a></li>
                        <li><a href="#">Firma del encargado</a></li>
                      </ul>
                    </div>
                    <div class="uk-width-expand@m">
                      <ul
                        id="component"
                        class="uk-switcher"
                      >
                        <li>
                          <img
                            :src="delivered.photo"
                            width="220px"
                          >
                        </li>                    
                        <li>
                          <img
                            :src="delivered.firm"
                          >
                        </li>                    
                        <li>
                          <img
                            :src="delivered.firmPersonChecks"
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>    
  </div>
</template>
<script> 
import MyHeader from "@/components/Header";
import Menu from "@/components/Menu";
import api from "@/api/Global";

export default {
  name: "Detallentrega",
  components: {
    MyHeader,
    Menu
  },
  props:{
  },
  data() {
    return {
      spinAll: false,
      id: 0,
      reception: {
        type: '',
        state: '',
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
      delivered: {
        date: '',
        qualification: '',
        commentary: '',
        personChecks: '',
        photo: '',
        firm: '',
        firmPersonChecks: ''
      },
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
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
      this.getDelivered();
    },
    getDelivered() {
      this.spinAll = true;
      api.init('delivereds');
      api.all('','', this.id)
      .then(response => {
        this.delivered = response.data.delivered;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    },
    redi() {
    sessionStorage.setItem('idReception', this.id);
    this.$router.push({ name: 'Reception-Detail', params: { id: this.id }});
    },
    rediBack() {
      this.$router.push({ name: 'Delivereds', params: { id: this.id }});
    }
  }
};
</script>
<style lang="scss" scoped>
.uk-textarea {
  background-color: transparent;
}
.uk-input {
  background-color: transparent;
}
.border{
  border-radius: 3px;
}
  .uk-button{
    border-radius: 0px;
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

    input[type="radio"]:checked ~ label {
    color: #1e87f0;
    }
</style>
