<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="customers" />
      </div>
      <div
        class="cont uk-width-expand uk-background-default"
        style="border-top:1px solid darkgray"
      >
        <div class="uk-clearfix uk-padding-small">
          <h3 class="uk-text-primary uk-text-normal uk-float-left uk-heading-bullet">
            Clientes
          </h3>
          <a
            class="uk-icon-button uk-float-right uk-text-default"
            uk-toggle="target: #offcanvas-flip"
            uk-icon="plus-circle" 
            @click="clear(); option= false; view = false; add= true; title = 'Registrar Cliente'"
          />
        </div>

        <div
          id="offcanvas-flip"
          uk-offcanvas="flip: true; overlay: true"
        >
          <div
            class="uk-offcanvas-bar uk-background-default uk-text-small"
            style="width:350px"
          >
            <button
              class="uk-offcanvas-close uk-float-left"
              type="button"
              uk-close
            />
            <a
              v-if="add && option"
              class="uk-icon-button uk-margin-bottom"
              uk-icon="reply"
              @click="view = true; add= false; option= false"
            />
            <div
              v-if="view"
              class="uk-padding-small"
            >
              <div class="uk-margin uk-width-1-1 uk-text-center">
                <span
                  v-if="spinView"
                  class="uk-margin-small-right"
                  uk-spinner
                />
              </div>
              <span class="uk-heading-bullet">Cliente: {{ customer.id }}</span> <br> <br>
              <div class="uk-margin uk-width-1-1 uk-text-center">
                <img
                  ref="img"
                  class=""
                  :src="customer.file"
                  width="120px"
                  height="120px"
                  alt=""
                  style="background:white"
                >
              </div>
              <span class="uk-text-small uk-text-muted"><span uk-icon="icon: user" /> {{ customer.name }}</span><br>
              <span class="uk-text-small uk-text-muted"><span uk-icon="icon: mail" /> {{ customer.email }}</span><br>
              <span class="uk-text-small uk-text-muted"><span uk-icon="icon: receiver" /> {{ customer.phone }}</span><br>
              <span class="uk-text-small uk-text-muted"><span uk-icon="icon: file-text" /> {{ customer.nit }}</span><br>
              <div class="uk-margin">
                <a
                  class="uk-icon-button uk-float-right uk-margin-left"
                  uk-icon="pencil"
                  @click="view = false; add= true; option= true; title = 'Editar Cliente:'"
                />
                <a
                  href="#modal-delete"
                  uk-toggle
                  class="uk-icon-button uk-float-right uk-margin-left "
                  uk-icon="trash"
                />
              </div>
            </div>
            <div v-if="add">
              <div class="">
                <h5>{{ title }} {{ customer.id }}</h5>
                <form
                  class="uk-padding-small uk-grid-small"
                  @submit.prevent="onSubmit()"
                >
                  <div class="uk-margin uk-width-1-1 uk-text-center">
                    <img
                      ref="img"
                      class=""
                      :src="customer.file"
                      width="120px"
                      height="120px"
                      alt=""
                      style="background:white"
                    >
                    <div
                      class="js-upload"
                      uk-form-custom
                    >
                      <input 
                        type="file"
                        multiple
                        @change="handleFile($event.target.files[0])"
                      >
                      <a                       
                        class="uk-icon-button uk-margin-left  uk-float-right uk-text-default"
                        tabindex="-1"
                        uk-icon="link"
                      />
                    </div>
                  </div>
                  <div class="uk-margin uk-width-1-1">
                    <label
                      class="uk-form-label"
                      for="form-horizontal-text"
                    >Nombre</label>
                    <div class="uk-form-controls">
                      <input
                        id="customer_name"
                        v-model="customer.name"
                        class="uk-input"
                        type="text"
                        placeholder="..."
                      >
                    </div>
                  </div>
                  <div class="uk-margin uk-width-1-1">
                    <label
                      class="uk-form-label"
                      for="form-horizontal-text"
                    >Email</label>
                    <div class="uk-form-controls">
                      <input
                        id="customer_email"
                        v-model="customer.email"
                        class="uk-input"
                        type="email"
                        placeholder="..."
                      >
                    </div>
                  </div>
                  <div class="uk-margin uk-width-1-1">
                    <label
                      class="uk-form-label"
                      for="form-horizontal-text"
                    >Teléfono</label>
                    <div class="uk-form-controls">
                      <input
                        id="customer_phone"
                        v-model="customer.phone"
                        class="uk-input"
                        type="number"
                        @input="maxLengthCheck($event.target.value)"
                      >
                    </div>
                  </div>
                  <div class="uk-margin uk-width-1-1">
                    <label
                      class="uk-form-label"
                      for="form-horizontal-text"
                    >Nit</label>
                    <div class="uk-form-controls">
                      <input
                        id="customer_nit"
                        v-model="customer.nit"
                        class="uk-input"
                        type="text"
                        placeholder="..."
                      >
                    </div>
                    <div class="uk-margin-small">
                      <span
                        v-if="error"
                        class="uk-text-danger uk-text-small"
                      >{{ message }}</span>
                    </div>
                    <div>
                      <button
                        class="uk-button uk-button-primary uk-button-small uk-margin uk-float-right"
                        type="submit"
                        :disabled="saving"
                      >
                        {{ saving ? 'Enviando...' : 'Enviar' }}
                      </button>
                      <span
                        v-if="spinAdd"
                        class="uk-margin-small-right"
                        uk-spinner
                      />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div
          id="modal-delete"
          uk-modal
        >
          <div class="uk-modal-dialog uk-modal-body">
            <button
              class="uk-modal-close-default"
              type="button"
              uk-close
            />
            <br>
            <p>
              Deseas eliminar el cliente? <br>
              <span class="uk-text-small uk-text-muted"><span uk-icon="icon: user" /> {{ customer.name }}</span><br>
            </p>        
            <p class="uk-text-right">
              <button
                class="uk-button uk-button-succes uk-button-small uk-modal-close"
                type="button"
                :disabled="saving"
              >
                Cancelar
              </button>
              <button
                class="uk-button uk-button-primary uk-button-small uk-margin-small-left"
                type="button"
                :disabled="saving"
                @click="deleteData"
              >
                Eliminar
              </button>
              <span
                v-if="spinDelete"
                class="uk-margin-small-right"
                uk-spinner
              />
            </p>
          </div>
        </div>

        <div class="uk-margin-left uk-margin-right">
          <div class="uk-text-center uk-width-1-1 uk-margin">
            <span
              v-if="spinAll"
              class="uk-margin-small-right"
              uk-spinner
            />
            <span
              v-if="msgData"
              class="uk-text-small uk-text-muted"
            ><span uk-icon="icon: minus-circle" /> Sin regitros....</span>
          </div>
          <div>
            <a
              href=""
              class="uk-icon-button"
              uk-icon="triangle-down"
            />
            <div uk-dropdown>
              <ul class="uk-nav uk-dropdown-nav">
                <li>
                  <label class="uk-margin-right"><input
                    v-model="type"
                    value="all"
                    class="uk-radio"
                    type="radio"
                    name="radio1"
                    @change="getAll"
                  > Todos</label>
                </li>
                <li>
                  <label class="uk-margin-right"><input
                    v-model="type"
                    value="ID"
                    class="uk-radio"
                    type="radio"
                    name="radio1"
                    @change="search"
                  > ID</label>
                </li>
                <li class="uk-nav-divider" />

                <li>
                  <div class="uk-inline">
                    <span
                      class="uk-form-icon"
                      uk-icon="icon: search"
                    />
                    <input
                      v-model="id"
                      class="uk-input"
                      type="number"
                      min="1"
                      @change="search"
                    >
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="uk-overflow-auto uk-box-shadow-medium">
            <table class="uk-table uk-table-small uk-table-divider uk-text-small uk-table-hover">
              <thead>
                <tr>
                  <th />
                  <th />
                  <th class="uk-table-shrink">
                    <span
                      class="uk-text-small"
                      uk-icon="icon: user"
                    />
                  </th>
                  <th class="uk-table-expand">
                    | Nombre
                  </th>
                  <th class="uk-table-expand">
                    | Email
                  </th>
                  <th class="uk-table-expand">
                    | Teléfono
                  </th>
                  <th class="uk-table-expand">
                    | Nit
                  </th>
                </tr>
              </thead>
              <tbody v-if="type == 'all'">
                <tr
                  v-for="x in customers.data"
                  :key="x.id"
                >
                  <td>
                    <button
                      class="uk-button uk-button-text uk-text-large"
                      uk-toggle="target: #offcanvas-flip"
                      @click="viewData(x.id)"
                    >
                      ֍
                    </button>
                  </td>
                  <td>{{ x.id }}</td>
                  <td>
                    <img
                      class="uk-preserve-width uk-border-circle"
                      :src="x.file"
                      width="30"
                      alt=""
                    >
                  </td>
                  <td>{{ x.name }}</td>
                  <td>{{ x.email }}</td>
                  <td>{{ x.phone }}</td>
                  <td>{{ x.nit }}</td>
                </tr>
              </tbody>
              <tbody v-if="type == 'ID'">
                <tr
                  v-for="x in cusotmerOne"
                  :key="x.id"
                >
                  <td>
                    <button
                      class="uk-button uk-button-text uk-text-large"
                      uk-toggle="target: #offcanvas-flip"
                      @click="viewData(x.id)"
                    >
                      ֍
                    </button>
                  </td>
                  <td>{{ x.id }}</td>
                  <td>
                    <img
                      class="uk-preserve-width uk-border-circle"
                      :src="x.file"
                      width="30"
                      alt=""
                    >
                  </td>
                  <td>{{ x.name }}</td>
                  <td>{{ x.email }}</td>
                  <td>{{ x.phone }}</td>
                  <td>{{ x.nit }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            class="uk-flex uk-float-right uk-margin-small"
          >
            <div v-if="customers.current_page > 1">
              <a
                class="uk-button uk-button-text uk-text-muted"
                @click="page = 1; all()"
              ><span uk-icon="icon: chevron-double-left" />
              </a> 
            </div>
            <div v-if="customers.prev_page_url !== null">
              <a
                class="uk-button uk-button-text uk-text-muted"
                @click="page = customers.current_page - 1; all()"
              ><span uk-icon="icon:  chevron-left" />
              </a> 
            </div>    
            <div>
              <span class="uk-text-middle uk-text-small">{{ customers.current_page }}</span>
            </div>          
            <div v-if="customers.next_page_url !== null">
              <a
                class="uk-button uk-button-text uk-text-muted"
                @click="page = customers.current_page + 1; all()"
              ><span uk-icon="icon: chevron-right" />
              </a> 
            </div>
            <div v-if="customers.last_page > 1">
              <a
                class="uk-button uk-button-text uk-text-muted"
                @click="page = customers.last_page; all()"
              ><span uk-icon="icon: chevron-double-right" />
              </a> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <MyFooter />
  </div>
</template>
<script> 
import MyHeader from "@/components/Header";
import MyFooter from "@/components/Footer";
import Menu from "@/components/Menu";
import api from '@/api/Global';
import UIkit from "uikit";

export default {
    name: "Entregas",
    components: {
        MyHeader,
        MyFooter,
        Menu
    },
    props:{
    },
    data() {
        return {
          //Formularios
          title: 'Registrar Cliente',
          filex: '/',
          customers: [],
          cusotmerOne: [],
          customer: {
            name: '',
            email: '',
            phone: 0,
            nit: '',
            file: '',
            id: ''
          },
          message: '',
          // validaciones
          spinView: false,
          spinAdd: false,
          spinAll: false,
          spinDelete: false,
          saving: false,
          option: false,
          msgData: false,
          add: true,
          view: false,
          error: false,
          who: false,
          disableds: false,
          type: 'all',
          id: 1
        };
    },
    computed: {
    },
    mounted(){
      this.clear();
      this.getAll();
    },
    methods: {
      clear() {
        var img = this.$refs.img;
        img.src = require("../../assets/cl.png")
        this.customer.name = '';
        this.customer.email = '';
        this.customer.phone = 0;
        this.customer.nit = '';
        this.customer.id = '';
        this.filex = '/';
        UIkit.modal('#modal-delete').hide();
        UIkit.offcanvas('#offcanvas-flip').hide();
      },
      getAll() {
        this.spinAll = true;
        api.init('customers?page=' + this.page);
        api.all()
        .then(response => {
          console.log(response.data.customers)
          this.customers = response.data.customers;
          this.msgData = false;
        })
        .catch(error => {
          console.log(error);
          this.error = true ;
          this.msgData = true;
        })
        .finally(() => this.spinAll = false);
      },
      onSubmit() {
        this.saving = true;
        this.spinAdd = true;
        let formData = new FormData();
        formData.append("name", this.customer.name);
        formData.append("email", this.customer.email);
        formData.append("nit", this.customer.nit);
        formData.append("phone", this.customer.phone);
        formData.append("file", this.filex);
        if(this.option == true){
          api.init('customers');
          api.update(this.customer.id, this.customer).then(response => {
            console.log(formData)
            UIkit.notification({
              message: '<span uk-icon="icon: check"></span> <span class="uk-text-small">Cliente Editado</span>',
              status: 'primary',
              pos: 'top-right',
              timeout: 3000
            });
            this.clear();
            this.getAll();
            console.log(response);
          })
          .catch(error => {
            console.log(error.response);
            this.error = true;
            if(error.response.data.errors.name){
              this.message = 'Nombre no valido!'
            }
            if(error.response.data.errors.email){
              this.message = 'Email no valido!'
            }
            if(error.response.data.errors.nit ){
              this.message = 'Nit no valido!'
            }
            if(error.response.data.errors.phone){
              this.message = 'Teléfono no valido!'
            }
            if(error.response.data.errors.file){
              this.message = 'Escoja una Imagen!'
            }
            setTimeout(() => {
                      this.error = false;
            }, 3000);
          })
          .finally(() => {
            this.spinAdd = false;
            this.saving = false;
          });
        }else{
          api.init('customers', 'multipart/form-data');
          api.create(formData).then(response => {
            UIkit.notification({
              message: '<span uk-icon="icon: check"></span> <span class="uk-text-small">Cliente Agregado</span>',
              status: 'primary',
              pos: 'top-right',
              timeout: 3000
            });
            this.clear();
            this.getAll();
            console.log(response);
          })
          .catch(error => {
            console.log(error.response.data.errors);
            this.error = true;
            if(error.response.data.errors.name){
              this.message = 'Nombre no valido!'
            }
            if(error.response.data.errors.email){
              this.message = 'Email no valido!'
            }
            if(error.response.data.errors.nit ){
              this.message = 'Nit no valido!'
            }
            if(error.response.data.errors.phone){
              this.message = 'Teléfono no valido!'
            }
            if(error.response.data.errors.file){
              this.message = 'Escoja una Imagen!'
            }
            setTimeout(() => {
              this.error = false;
            }, 3000);
          })
          .finally(() => {
            this.spinAdd = false;
            this.saving = false;
          });
        }
      },
      viewData(id) {
        this.title = 'Cliente';
        this.spinView = true;
        this.add = false;
        this.view = true;
        api.init('customers');
        api.find(id).then(response => {
          console.log(response);
          this.customer = response.data.customer;
        })
        .catch(error => {
          console.log(error.response);
          this.error = true;
        })
        .finally(() => this.spinView = false);
      },
      deleteData() {
        this.saving = true;
        this.spinDelete = true;
        this.title = 'Eliminar Cliente';
        api.init('customers');
        api.delete(this.customer.id).then(response => {
          console.log(response);
          UIkit.notification({
            message: '<span uk-icon="icon: check"></span> <span class="uk-text-small">Cliente Eliminado</span>',
            status: 'primary',
            pos: 'top-right',
            timeout: 3000
          });
          this.clear();
          this.getAll();
        })
        .catch(error => {
          console.log(error.response);
          this.error = true;
        })
        .finally(() => this.saving = false);
        this.spinDelete = false;
      },
      handleFile(file){
        this.filex = file;
        var img = this.$refs.img;
        img.src = URL.createObjectURL(file);
      },
      search() {
        if(this.type == 'ID'){
          this.spinAll = true;
          this.msgData = true;
          this.cusotmerOne = [];
          api.init('customers');
          api.find(this.id)
          .then(response => {
            console.log(response)
            this.cusotmerOne.push(response.data.customer);
            this.msgData = false;
          })
          .catch(error => {
            console.log(error)
            this.error = true ;
          })
          .finally(() => this.spinAll = false);
        }
      },
      maxLengthCheck(e)
      {
        if(e > 8){
          this.customer.phone = e.slice(0, 8)
        }
      }
    }
};
</script>
<style lang="scss" scoped>
tr th {
  color: rgb(89, 106, 124);
  text-transform: none;
}
.c {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  border: none;
}
</style>
