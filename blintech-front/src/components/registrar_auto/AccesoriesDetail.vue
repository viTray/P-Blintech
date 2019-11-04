<template>
  <div class="uk-padding-small">
    <header class="uk-background-default ">
      <h3 class="uk-text-primary uk-padding-small uk-heading-bullet">
        Accesorios y Herramientas
      </h3>
    </header>
    <div
      class="uk-padding-small"
    >
      <div class="uk-width-1-1 uk-text-center">
        <span
          v-if="spinAll"
          class="uk-margin-small-right"
          uk-spinner
        />
      </div>
      <ul
        class="uk-list uk-width-1-1 uk-grid-divider uk-child-width-1-2@s"
        uk-grid
      >
        <li class="uk-width-1-1">
          <span
            class="uk-float-left"
            uk-icon="list"
          />
          <div class="uk-float-right">
            <span class="uk-margin-left uk-text-small"> Si </span>
            <span class="uk-margin-left uk-text-small"> No </span>
            <span
              uk-icon="link"
              class="uk-margin-small-left uk-text-small"
            />
          </div>
        </li>
        <MeliDetail
          v-for="(x, index) in accesories"
          :id="x.id"
          :key="x.id"
          class="uk-width-1-2@s"
          :code="index"
          :title="x.title.description"
          :state="x.state"
          :extra="x.extra"
          :description="x.description"
          :file="x.file"
        />
      </ul>
    </div>
  </div>
</template>
<script> 
import MeliDetail from "@/components/my_canvas/MeliDetail"
import api from '@/api/Global';

export default {
  name: "Detallegeneral",
  components: {
    MeliDetail
  },
  props:{
  },
  data() {
    return {
      spinAll: false,
      accesories: []
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
      api.init('accessorys')
      api.all('', '', this.id)
      .then(response => {
        console.log(response.data.accesories)
        this.accesories = response.data.accesories;
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
