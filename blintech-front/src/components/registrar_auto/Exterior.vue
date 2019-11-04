<template>
  <div>
    <header class="uk-background-primary ">
      <h3 class="uk-text-secondary uk-padding-small uk-heading-bullet">
        Exterior
      </h3>
    </header>
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
          <li>
            <MyCanvas
              title="Vista Lateral Izquierda"
              no="1"
              @print="send($event, 0)"
              @init="data.push($event)"
            />
          </li>
          <li>
            <MyCanvas
              title="Vista Lateral Derecha"
              no="2"
              @print="send($event, 1)"
              @init="data.push($event)"
            />
          </li>
          <li>
            <MyCanvas
              title="Vista Frontal y Trasera"
              no="3"
              @print="send($event, 2)"
              @init="data.push($event)"
            />
          </li>
          <li>
            <MyCanvas
              title="Vista Superior"
              no="4"
              @print="send($event, 3)"
              @init="data.push($event)"
            />
          </li>                
        </ul>
      </div>
      <div class="uk-width-1-1">
        <button
          class="uk-button uk-button-primary uk-float-right"
          uk-switcher-item="next"
        >
          <span class="uk-text-small">Siguiente</span>
        </button>
        <button
          class="uk-button uk-button-success uk-float-right uk-margin-small-right"
          uk-switcher-item="previous"
        >
          <span class="uk-text-small">Anterior</span>
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import MyCanvas from "@/components/my_canvas/MeCanvas";

export default {
  name: "Exterior",
  components: {
    MyCanvas
  },
  props:{
  },
  data() {
    return {
      titles: ['Vista Lateral Izquierda', 'Vista Lateral Derecha', 'Vista Frontal y Trasera', 'Vista Superior'],
      tipo: 0,
      data: [],
    };
  },
  computed: {},
  mounted(){
  },
  methods: {
    send(e, x) {
      this.data[x] = e;
      this.$emit('data', this.data);
    }
  }
};
</script>
<style lang="scss">
</style>
