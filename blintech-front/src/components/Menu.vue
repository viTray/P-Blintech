<template>
  <div
    class="uk-card uk-card-default uk-card-body uk-height-1-1 uk-padding-remove uk-position-fixed uk-visible@l"
    style="width:200px; margin-top: 60px; border:none"
  >
    <div>
      <ul
        class="uk-tab-right uk-margin-top"
        uk-tab
      >
        <li :class="home">
          <a @click="redi('Home')"><span uk-icon="home" /> Home</a>
        </li>
        <li :class="reception">
          <a @click="redi('Reception')"><span uk-icon="file-text" /> Recepción</a>
        </li>
        <li :class="records">
          <a @click="redi('Records')"><span uk-icon="file-text" /> Recepciones</a>
        </li>
        <li :class="tracings">
          <a @click="redi('Tracing')"><span uk-icon="chevron-double-right" /> Seguimientos</a>
        </li>
        <li :class="delivereds">
          <a @click="redi('Delivereds')"><span uk-icon="cart" /> Entregas</a>
        </li>
        <li :class="customers">
          <a @click="redi('Customers')"><span uk-icon="users" /> Clientes</a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "Menux",
  components: {

  },
  props:{
    who: {
      type: String,
      default: 'home'
    },
  },
  data(){
    return{
      home: '',
      reception: '',
      records: '',
      tracings: '',
      delivereds: '',
      customers: ''
    }
  },
  mounted() {
    switch (this.who) {
      case 'home':
        this.home='uk-active '
        break;
      case 'reception':
        this.reception='uk-active'
        break;
      case 'tracing':
        this.tracings='uk-active'
        break;
      case 'delivereds':
        this.delivereds='uk-active'
        break;
      case 'customers':
        this.customers='uk-active'
        break;
      case 'records':
        this.records='uk-active'
        break;
      default:
        break;
    }
  },
  methods: {
    redi(e, param='') {
      this.$router.push({ name: e, params: { id: param } })
    }
  }
};
</script>
<style lang="scss" scoped>
a {
  height: 30px;
  padding-top: 10px;
}
.uk-active {
  color: white;
  border-left: 3px solid rgb(89, 94, 100);;
  background-color: #3f4458;
}
.uk-active a{
  color: white;
}
</style>
