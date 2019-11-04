<template>
  <div class="uk-flex uk-flex-center uk-flex-middle uk-width-1-1 uk-height-1-1 uk-background-default">
    <div>
      <img
        src="../assets/logo.svg"
        width="220px"
        alt=""
      >
    </div>
    <div class="uk-text-right uk-padding-small">
      <h5 class="uk-margin-remove">
        No hemos encontrado tu página.
      </h5>
      <a @click="redi">Regresar al inicio.</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "404",
  props:{
  },
  data() {
    return {
    };
  },
  methods: {
    redi() {
      this.$router.push({ name: 'Home', params: { id: this.id }});
    },
  },
};
</script>
<style lang="scss" scoped>

</style>
