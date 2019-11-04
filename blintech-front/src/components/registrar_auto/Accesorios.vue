<template>
  <div>
    <header class="uk-background-primary ">
      <h3 class="uk-text-secondary uk-padding-small uk-heading-bullet">
        Accesorios y Herramientas
      </h3>
    </header>
    <div
      class="uk-padding-small"
    >
      <!-- <div class="">
      <div class="uk-margin">
        <div class="uk-inline uk-width-1-1">
          <div>
            <span class="uk-form-icon" uk-icon="icon: search"></span>
            <input class="uk-input" v-model="search" type="text">
          </div>
        </div>
      </div>
    </div> -->
      <ul
        ref="list"
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
        <Meli
          v-for="(x, index) in titles"
          :id="x.id"
          :key="x.id"
          class="uk-width-1-2@s"
          :code="index"
          :title="x.description"
          @changes="data[index] = $event; send"
        />
      </ul>
    </div>
    <div
      class="uk-width-1-1 uk-margin"
      style="height: 40px"
    >
      <button
        class="uk-button uk-button-primary uk-margin-right uk-float-right"
        uk-switcher-item="next"
      >
        <span class="uk-text-small">Siguiente</span>
      </button>
      <button
        class="uk-button uk-button-success uk-margin-small-right uk-float-right"
        uk-switcher-item="previous"
      >
        <span class="uk-text-small">Anterior</span>
      </button>
    </div>
  </div>
</template>
<script>
import Meli from "@/components/my_canvas/Meli"
import api from '@/api/Global';

export default {
  name: "Accesorios",
  components: {
    Meli
  },
  props:{
  },
  data() {
    return {
      titles: [],
      data: [],
      search: ''
    };
  },
  mounted(){
    this.all();
  },
  methods: {
    all() {
      this.spinAll = true;
      api.init('titles');
      api.all()
      .then(response => {
        this.titles = response.data.titles;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(()=> this.init());
    },
    init() {
      
      for (let x = 0; x < this.titles.length; x++) {
          let object = {
            "state": 'si',
            "extra": 'no',
            "description": null,
            "idTitle": this.titles[x].id,
            "file": "/"
            }
          this.data.push(object);
      }
      this.$emit('data', this.data);
    },
    send() {
      this.$emit('data', this.data);
    },
    // search(){
    //   var value = this.valueSearch.toLowerCase();
    //   var list = this.$refs.list;
    //   list.filter

    // }
  }
};
</script>
<style lang="scss" scoped>
.uk-input {
  border: none;
  border-bottom: 1px solid darkgray;
}
</style>
