<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="delivereds" />
      </div>
      <div class="cont uk-background-default uk-width-1-1">
        <div class="uk-clearfix uk-margin-left">
          <h3 class="uk-text-primary uk-heading-bullet">
            Entregas
          </h3>
        </div>
        <div class="uk-padding uk-padding-remove-vertical">
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
          <div uk-filter="target: .js-filter">
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
                      @change="all()"
                    > Todos</label>
                  </li>
                  <li @click="type = 'Blindaje'">
                    <label class="uk-margin-right"><input
                      v-model="type"
                      value="Blindaje"
                      class="uk-radio"
                      type="radio"
                      name="radio1"
                      @change="all()"
                    > Blindajes</label>
                  </li>                
                  <li>
                    <label class="uk-margin-right"><input
                      v-model="type"
                      value="Mantenimiento"
                      class="uk-radio"
                      type="radio"
                      name="radio1"
                      @change="all()"
                    > Mantenimientos</label>
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
            <div class="uk-overflow-auto uk-box-shadow-small">
              <table class="uk-table uk-table-small uk-table-divider uk-text-small uk-table-hover uk-padding-small">
                <thead>
                  <tr>
                    <th class="uk-table-shrink">
                      <span
                        class="uk-text-small"
                        uk-icon="icon: user"
                      />
                    </th>
                    <th class="uk-table-expand">
                      | Fecha
                    </th>
                    <th class="uk-table-shrink">
                      | Tipo
                    </th>
                    <th class="uk-table-expand">
                      | Nombre
                    </th>
                    <th class="uk-table-expand">
                      | Placa
                    </th>
                    <th class="uk-table-expand">
                      | Propietario
                    </th>
                  </tr>
                </thead>
                <tbody v-if="receptions !== []">
                  <tr
                    v-for="x in receptions.data"
                    :key="x.id"
                  >
                    <td>{{ x.id }}</td>
                    <td>{{ x.date }}</td>
                    <td>{{ x.type }}</td>
                    <td>{{ x.customer.name }}</td>
                    <td>{{ x.general[0].licensePlate }}</td>
                    <td>{{ x.general[0].owner }}</td>
                    <td>
                      <a
                        class="uk-button uk-button-text uk-text-success"
                        @click="redi(x.id)"
                      >Detalles</a>
                    </td>
                  </tr>
                </tbody>
                <tbody v-if="reception !== []">
                  <tr
                    v-for="x in reception"
                    :key="x.id"
                  >
                    <td>{{ x.id }}</td>
                    <td>{{ x.date }}</td>
                    <td>{{ x.type }}</td>
                    <td>{{ x.customer.name }}</td>
                    <td>{{ x.general[0].licensePlate }}</td>
                    <td>{{ x.general[0].owner }}</td>
                    <td>
                      <a
                        class="uk-button uk-button-text uk-text-success"
                        @click="redi(x.id)"
                      >Detalles</a>
                    </td>
                  </tr>
                </tbody>
              </table> 
            </div>
            <div
              v-if="type !== 'ID'"
              class="uk-flex uk-float-right uk-margin-small"
            >
              <div v-if="receptions.current_page > 1">
                <a
                  class="uk-button uk-button-text uk-text-muted"
                  @click="page = 1; all()"
                ><span uk-icon="icon: chevron-double-left" />
                </a> 
              </div>
              <div v-if="receptions.prev_page_url !== null">
                <a
                  class="uk-button uk-button-text uk-text-muted"
                  @click="page = receptions.current_page - 1; all()"
                ><span uk-icon="icon:  chevron-left" />
                </a> 
              </div>    
              <div>
                <span class="uk-text-middle uk-text-small">{{ receptions.current_page }}</span>
              </div>          
              <div v-if="receptions.next_page_url !== null">
                <a
                  class="uk-button uk-button-text uk-text-muted"
                  @click="page = receptions.current_page + 1; all()"
                ><span uk-icon="icon: chevron-right" />
                </a> 
              </div>
              <div v-if="receptions.last_page > 1 && receptions.last_page > receptions.current_page">
                <a
                  class="uk-button uk-button-text uk-text-muted"
                  @click="page = receptions.last_page; all()"
                ><span uk-icon="icon: chevron-double-right" />
                </a> 
              </div>
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
import api from "@/api/Global";

export default {
  name: "Delivered",
  components: {
    MyHeader,
    MyFooter,
    Menu
  },
  props:{
  },
  data() {
    return {
      title: '',
      receptions: [],
      reception: [],
      spinAll: false,
      type: 'all',
      id: 1,
      msgData: false,
      page: 1
    };
  },
  computed: {},
  mounted(){
    this.all();
  },
  methods: {
    all() {
      this.spinAll = true;
      this.msgData = true;
      this.reception = [];
      api.init('receptions?page=' + this.page);
      api.all('Cerrado', this.type)
      .then(response => {
        console.log(response.data)
        this.receptions = response.data.receptions;
        this.msgData = false;
      })
      .catch(error => {
        console.log(error)
        this.error = true;
      })
      .finally(() => this.spinAll = false);
    },
    search() {
      if(this.type == 'ID'){
        this.spinAll = true;
        this.msgData = true;
        this.receptions = [];
        this.reception = [];
        api.init('receptions');
        api.find(this.id, 'Cerrado')
        .then(response => {
          console.log(response)
          if(response.data.reception.state == 'Cerrado'){
            this.reception.push(response.data.reception)
            this.msgData = false;
          }
        })
        .catch(error => {
          console.log(error)
          this.error = true ;
        })
        .finally(() => this.spinAll = false);
      }
    },
    redi(e) {
      this.$router.push({ name: 'Delivered-Detail', params: { id: e } })
    }
  }
};
</script>
<style lang="scss">
.uk-card{
  border: 1px solid darkgray;
}
</style>
