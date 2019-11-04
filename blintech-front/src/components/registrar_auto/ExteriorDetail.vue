<template>
  <div class="uk-padding-small">
    <header class="uk-background-default ">
      <h3 class="uk-text-primary uk-padding-small uk-heading-bullet">
        Exteriores     
      </h3>
    </header>          
    <div class="uk-width-1-1 uk-text-center">
      <span
        v-if="spinAll"
        class="uk-margin-small-right"
        uk-spinner
      />
    </div>
    <div
      class="uk-padding-small"
      uk-grid
    >
      <div class="uk-width-auto@m">
        <ul
          class="uk-tab-left"
          uk-tab="connect: #component-tab-left; animation: uk-animation-fade"
        >
          <li><a href="#">Izquierda</a></li>
          <li><a href="#">Derecha</a></li>
          <li><a href="#">Frontal</a></li>
          <li><a href="#">Superior</a></li>
        </ul>
      </div>
      <div class="uk-width-expand@m">
        <ul
          id="component-tab-left"
          class="uk-switcher"
        >
          <li 
            v-for="x in exteriors"
            :key="x.id"
          >
            <div
              class="uk-child-width-1-1@s"
              uk-grid
            >
              <div>
                <img
                  :src="x.file"
                  alt=""
                >
              </div>
              <div>
                <h3 class="uk-card-title uk-text-primary">
                  {{ x.title }}
                </h3>
                <div class="uk-margin">
                  <div class="uk-form-controls">
                    <p>Descripción: {{ x.description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </li>               
        </ul>
      </div>
    </div>
  </div>
</template>
<script> 
import api from '@/api/Global';
export default {
  name: "ExteriorDetail",
  components: {

  },
  props:{
  },
  data() {
    return {
      spinAll: false,
      exteriors: []
    };
  },
  computed: {},
  mounted(){    
    this.id = sessionStorage.getItem('idReception')
    this.init();
  },
  methods: {
    init() {
      this.spinAll = true;
      api.init('exteriors')
      api.all('', '', this.id)
      .then(response => {
        console.log(response.data.exteriors)
        this.exteriors = response.data.exteriors;
      })
      .catch(error => {
        console.log(error);
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    }
  }
};
</script>
<style lang="scss">
</style>
