<template>
  <div>
    <div
      id="offcanvas-nav"
      uk-offcanvas="overlay: true;"
    >
      <div
        class="uk-offcanvas-bar uk-background-primary uk-width-auto uk-padding-small"
        style="width:250px"
      >
        <ul class="uk-nav uk-nav-default uk-margin-small-left uk-text-secondary uk-tab-right">
          <li class="uk-text-bolder uk-heading-bullet">
            BlindTech S.A
          </li>
          <li class="uk-nav-divider uk-margin-bottom" />
          <li><a @click="redi('Home')"><span uk-icon="home" /> Inicio</a></li>
          <li><a @click="redi('Reception')"><span uk-icon="file-text" /> Recepción</a></li>
          <li><a @click="redi('Records')"><span uk-icon="file-text" /> Recepciones</a></li>
          <li><a @click="redi('Tracing')"><span uk-icon="chevron-double-right" /> Seguimientos</a></li>
          <li><a @click="redi('Delivereds')"><span uk-icon="cart" /> Entregas</a></li>
          <li><a @click="redi('Customers')"><span uk-icon="users" /> Clientes</a></li>
          <li>
            <a
              href=""
              class="uk-text-secondary"
            ><span class="uk-text-secundary uk-text-small uk-position-z-index uk-position-bottom-left uk-position-fixed uk-margin-small-bottom uk-margin-left">Contactato <span uk-icon="comment" /></span></a>
          </li>
        </ul>
      </div>
    </div>
    <nav
      class="uk-navbar-container uk-position-fixed uk-width-1-1 uk-position-z-index"
      uk-navbar
      style="height:60px"
    >
      <div class="uk-navbar-left uk-hidden@l">
        <a
          class="uk-text-muted uk-padding-small"
          uk-toggle="target: #offcanvas-nav"
          href="#"
        >
          <span uk-navbar-toggle-icon /> 
        </a>
      </div>
      <div class="uk-navbar-left uk-margin-left">
        <a href="home"><img
          src="../assets/logo.svg"
          width="130px"
          height="auto"
          alt=""
        ></a>
      </div>
      <div class="uk-navbar-right uk-margin-right">
        <a
          href="#"
          class="uk-text-muted"
        ><span
           class="uk-text-small"
           uk-icon="chevron-down"
         />
          <img
            class="uk-border-circle"
            src="./../assets/cl.png"
            width="40"
            height="40"
            alt="Border circle"
          >
        </a>
        <div uk-dropdown="pos: left-center">
          <ul class="uk-nav uk-dropdown-nav uk-text-left uk-text-small">
            <li class="uk-text-left">
              <span class="uk-text-small">Administrador</span>
            </li>
            <li class="uk-nav-divider" />
            <li>
              <a
                href=""
                class="uk-text-default uk-text-small uk-text-center uk-background-default"
                @click="out"
              ><span uk-icon="sign-out" /> Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Myheader",
  props:{
  },
  data() {
    return {
    };
  },
  methods: {
    out() {
      localStorage.removeItem('token');
      this.$router.push({ name: 'Login'})
    },
    redi(e){
      this.$router.push({ name: e});
    }
  },
};
</script>
<style lang="scss" scoped>

</style>
