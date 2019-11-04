<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="tracing" />
      </div>
      <div class="cont uk-background-default uk-width-1-1">
        <a
          class="uk-icon-button uk-margin-left uk-margin"
          uk-icon="arrow-left"
          @click="redi"
        />
        <div class="uk-clearfix uk-margin-left">         
          <h3 class="uk-text-primary uk-text-normal uk-float-left uk-heading-bullet">
            Detalles del Seguimiento
          </h3>
          <a
            v-if="reception.state == 'Abierto'"
            class="uk-button uk-button-text uk-margin-right uk-text-success uk-float-right"
            @click="rediComment"
          >Comentar</a>
          <a
            v-if="reception.state == 'Abierto'"
            class="uk-button uk-button-text uk-margin-right uk-text-primary uk-float-right"
            @click="rediFinalize"
          >Finalizar</a>
          <a
            v-if="reception.state == 'Cerrado'"
            class="uk-button uk-button-text uk-margin-right uk-text-success uk-float-right"
            @click="rediDelivered"
          >Detalles de Entrega</a>
          <div
            id="modal-comment"
            uk-modal
          >
            <div class="uk-modal-dialog uk-modal-body uk-box-shadow-small radius">
              <button
                class="uk-modal-close-default"
                type="button"
                uk-close
              />
              <h4 class="uk-heading-bullet">
                Añadir Comentario
              </h4>
              <div class="uk-width-1-1@s">
                <div class="uk-margin">
                  <label
                    class="uk-form-label"
                    for="form-horizontal-text"
                  >Descripcion:</label>
                  <div class="uk-form-controls">
                    <textarea
                      v-model="commentary"
                      class="uk-textarea"
                      rows="3"
                      placeholder="..."
                    />
                  </div>
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
                        class="uk-child-width-1-4@s uk-text-center"
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
              <p class="uk-text-right">
                <button
                  class="uk-button uk-button-default uk-modal-close uk-button-small uk-margin-small-right"
                  type="button"
                >
                  Cancelar
                </button>
                <button
                  class="uk-button uk-button-primary uk-button-small"
                  type="button"
                  :disabled="saving"
                  @click="createComment()"
                >
                  Enviar
                </button>
              </p>
            </div>
          </div>
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
          <div class=" uk-label uk-margin-small-right">
            {{ reception.state }}
          </div>
          <a
            class="uk-button uk-button-text uk-margin-right uk-text-success uk-float-right"
            @click="rediDetails"
          ><span uk-icon="folder" /> Detalles</a>
        </div>
        <div>
          <div class="uk-width-1-1 uk-text-center uk-margin-top">
            <span
              v-if="spinAll"
              class="uk-margin-small-right"
              uk-spinner
            />
            <span
              v-if="comments.length == 0"
              class="uk-text-small"
            >{{ msg }} <span
              v-if="msg !== ''"
              class="uk-text-danger"
              uk-icon="icon: comment"
            /></span>
          </div>
          <div
            class="uk-child-width-1-1@s uk-padding-small"
            uk-grid
          >
            <div class="uk-margin-remove">
              <div
                v-for="x in comments"
                :key="x.id"
                class="uk-card uk-padding-small"
              >
                <div
                  class="uk-grid-small uk-flex-middle"
                  uk-grid
                >
                  <div
                    class="uk-width-expand uk-child-width-1-1@s uk-text-left"
                    uk-grid
                  >
                    <p>
                      <span
                        uk-icon="calendar"
                        class="uk-text-muted uk-text-small"
                      >{{ x.date }} </span>
                      <br> {{ x.commentary }}
                      <br>
                      <ul uk-accordion>
                        <li>
                          <a
                            class="uk-accordion-title uk-text-small"
                            href="#"
                          ><span uk-icon="image" /> Fotos</a>
                          <div class="uk-accordion-content">
                            <div
                              class="uk-child-width-1-5@s uk-text-center"
                              uk-grid
                            >
                              <div
                                v-for="y in x.images"
                                :key="y.id"
                              >
                                <div class="uk-box-shadow-small">
                                  <img
                                    :src="y.image"
                                    alt=""
                                    width="160px"
                                  >
                                </div>
                              </div>
                            </div>  
                          </div>
                        </li>
                      </ul>
                    </p>
                  </div>
                </div>
              </div>
            </div> 
          </div> 
        </div>
      </div>
    </div>    
  </div>
</template>
<script> 
import MyHeader from "@/components/Header";
import Menu from "@/components/Menu";
import api from "@/api/Global";
import UIkit from "uikit";

export default {
  name: "Detalles",
  components: {
    MyHeader,
    Menu
  },
  props:{
  },
  data() {
    return {
      id: 0,
      // data a enviar
      idCustomer: 0,
      files: [],
      commentary: '',
      filesn: [],
      // validaciones
      saving: false,
      spinAll: false,
      spinComments: false,
      msg: '',
      // datos de la base de datos
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
      comments: []
    };
  },
  computed: {},
  mounted(){
    this.id = this.$route.params.id;
    this.init();
    this.allComments();
  },
  methods: {
    init() {
      this.spinAll = true;
      api.init('receptions');
      api.find(this.id)
      .then(response => {
        this.reception = response.data.reception;
        this.idCustomer = this.reception.customer.id;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    },
    createComment() {
      this.saving = true;
      let formData = new FormData(); 
      formData.append("idCustomer", this.idCustomer);
      formData.append("idReception", this.id);
      formData.append("commentary", this.commentary);
      let existImages = 'no'
      if(this.files.length > 0){
        for (let index = 0; index < this.files.length; index++) {
          formData.append("filesComment["+index+"][file]", this.files[index]);
        }
        existImages = 'si';
      }
      // validación
      formData.append("existImages", existImages);


      api.init('comments', 'multipart/form-data')
      api.create(formData)
      .then(response => {
        console.log(response);
        this.saving = false;
        UIkit.notification({
          message: '<span uk-icon="icon: check"></span> <span class="uk-text-small">Comentario Agregado</span>',
          status: 'primary',
          pos: 'top-right',
          timeout: 3000
        });
      })
      .catch(error => {
      this.error = true;
      console.log(error)
      })
      .finally(()=> {
        UIkit.modal('#modal-comment').hide();
        this.clear();
      });
    },
    clear() {
      UIkit.modal('#modal-comment').hide();
      this.files= [];
      this.filesn= [];
      this.commentary = '';
      this.allComments();
    },
    allComments() {
      this.spinComments = true;
      api.init('comments');
      api.all('', '', this.id)
      .then(response => {
        this.comments = response.data.comments;
        if(this.comments.length == 0) {
          this.msg = 'Sin comentarios'
        }
      })
      .catch(error => {
        console.log(error)
        this.error = true ;
      })
      .finally(() => this.spinComments = false);
    },
    handleFile(file){
      this.files.push(file);
      this.filesn.push(URL.createObjectURL(file));
    },
    rediDetails() {
      sessionStorage.setItem('idReception', this.id);
      this.$router.push({ name: 'Reception-Detail', params: { id: this.id }});
    },
    rediFinalize() {
      this.$router.push({ name: 'Finalize-Tracing', params: { id: this.id }});
    },
    redi() {
      this.$router.push({ name: 'Tracing', params: { id: this.id }});
    },
    rediComment() {
      this.$router.push({ name: 'Comment', params: { id: this.id }});
    },
    rediDelivered() {
      this.$router.push({ name: 'Delivered-Detail', params: { id: this.id } })
    }
  }
};
</script>
<style lang="scss" scoped>
  .cimg {
  width: 120px;
  border-radius: 3px;
}
.radius {
  border-radius: 3px
}
</style>
