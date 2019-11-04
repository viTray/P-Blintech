<template>
  <div class="uk-width-1-1 uk-height-1-1">
    <MyHeader />
    <div class="uk-flex uk-height-1-1">
      <div class="uk-widht-auto">
        <Menu who="tracing" />
      </div>
      <div class="cont uk-background-default uk-width-1-1">
        <div class="uk-clearfix uk-margin-left">
          <h3 class="uk-text-primary uk-text-normal uk-float-left uk-heading-bullet uk-margin-remove">
            Detalles de Recepción
          </h3>
          <a
            href=""
            class="uk-icon-button uk-float-right uk-margin-right"
            uk-icon="arrow-left"
            @click="redi()"
          />
        </div>
        <ul
          class="uk-flex-right"
          uk-tab
        >
          <li class="uk-active">
            <a href="#">General</a>
          </li>
          <li><a href="#">Accesorios</a></li>
          <li><a href="#">Exterior</a></li>
          <li><a href="#">Cliente</a></li>
        </ul>
        <ul class="uk-switcher uk-width-1-1 uk-float-left">
          <li><GeneralDetail /></li>
          <li><AccesoriesDetail /></li>
          <li><ExteriorDetail /></li>
          <li><ClientDetail /></li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script> 
import MyHeader from "@/components/Header";
import Menu from "@/components/Menu";
import GeneralDetail from "@/components/registrar_auto/GeneralDetail";
import AccesoriesDetail from "@/components/registrar_auto/AccesoriesDetail";
import ExteriorDetail from "@/components/registrar_auto/ExteriorDetail";
import ClientDetail from "@/components/registrar_auto/ClientDetail";

export default {
  name: "ReceptionDetail",
  components: {
    MyHeader,
    GeneralDetail,
    AccesoriesDetail,
    ExteriorDetail,
    ClientDetail,
    Menu
  },
  props:{
  },
  data() {
    return {
      id: 0
    };
  },
  computed: {},
  mounted(){
    this.id = this.$route.params.id;
  },
  methods: {
    redi() {
      this.$router.go(-1)
    },
  }
};
</script>
<style lang="scss">
</style>
