<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu />
      </div>
      <div class="cont uk-width-expand uk-background-default">
        <div
          class="uk-child-width-1-2@s uk-width-1-1 uk-padding uk-text-center"
          uk-grid
        >
          <div class="uk-width-1-1 uk-text-left">
            <button
              class=" uk-button uk-button-text uk-margin-large-left"
              @click="redi"
            >
              <span uk-icon="icon: plus-circle" /> Añadir recepción bien chilera digo yo.
            </button>
          </div>
          <div>
            <a
              href="customers"
              class="uk-box-shadow-small"
            >
              <div class="uk-inline">
                <img
                  src="../assets/cl.png"
                  alt=""
                  width=""
                  height="auto"
                >
                <div class="uk-overlay uk-overlay-default uk-position-bottom">
                  <p>Clientes</p>
                </div>
              </div>
            </a>
            <a
              href="employees"
              class="uk-box-shadow-small"
            >
              <div class="uk-inline">
                <img
                  src="../assets/cl.png"
                  alt=""
                  width=""
                  height="auto"
                >
                <div class="uk-overlay uk-overlay-default uk-position-bottom">
                  <p>Empleados</p>
                </div>
              </div>
            </a>
          </div>
          <div>
            <a
              href="tracing"
              class="uk-box-shadow-small"
            >
              <div class="uk-inline">
                <img
                  src="../assets/cl.png"
                  alt=""
                  width=""
                  height="auto"
                >
                <div class="uk-overlay uk-overlay-default uk-position-bottom">
                  <p>Seguimientos</p>
                </div>
              </div>
            </a>
            <a
              href="delivereds"
              class="uk-box-shadow-small"
            >
              <div class="uk-inline">
                <img
                  src="../assets/cl.png"
                  alt=""
                  width=""
                  height="auto"
                >
                <div class="uk-overlay uk-overlay-default uk-position-bottom">
                  <p>Entregas</p>
                </div>
              </div>
            </a>
          </div>
          <div>
            <a
              href="records"
              class="uk-box-shadow-small"
            >
              <div class="uk-inline">
                <img
                  src="../assets/cl.png"
                  alt=""
                  width=""
                  height="auto"
                >
                <div class="uk-overlay uk-overlay-default uk-position-bottom">
                  <p>Recepciones</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from '@/components/Menu';
import MyHeader from '@/components/Header';

export default {
  name: "Home",
  components: {
    MyHeader,
    Menu
  },
  mounted() {
  },
  methods: {
    redi() {
      this.$router.push('reception');
    }
  }
};
</script>
<style lang="scss" scoped>
  a{
    text-decoration: none;
    color: rgb(99, 97, 97)
  }

</style>
