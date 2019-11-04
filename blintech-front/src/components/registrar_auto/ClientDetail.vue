<template>
  <div class="uk-padding-small">
    <header class="uk-background-default ">
      <h3 class="uk-text-primary uk-padding-small uk-heading-bullet">
        Cliente
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
      <div class="uk-margin">
        <p>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: user" /> {{ reception.customer.name }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: mail" /> {{ reception.customer.email }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: receiver" /> {{ reception.customer.phone }}</span><br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: file-text" /> {{ reception.customer.nit }}</span><br> <br>
          <span class="uk-text-small uk-text-muted"><span uk-icon="icon: file-text" /> {{ reception.description }}</span><br>
        </p>
      </div>
      <div class="uk-width-1-1">
        <a
          href="#modal-firm"
          class="uk-float-right"
          uk-toggle
        >Firma</a>

        <!-- This is the modal -->
        <div
          id="modal-firm"
          uk-modal
        >
          <div
            class="uk-modal-dialog uk-modal-body"
            style="border-radius:3px"
          >
            <h4 class="">
              Firma:
            </h4>
            <img
              :src="reception.file"
            >
          </div>
        </div>
      </div>
      <div class="uk-margin uk-width-1-1">
        <label
          class="uk-form-label"
          for="form-horizontal-text"
        >Estatus del Carro:</label>
        <ul uk-accordion>
          <li>
            <a
              class="uk-accordion-title"
              href="#"
            > <span uk-icon="icon: image" /></a>
            <div class="uk-accordion-content">
              <div
                class="uk-child-width-1-6@s uk-text-center"
                uk-grid
              >
                <div
                  v-for="x in receptionImages" 
                  :key="x.id"
                >
                  <img
                    :src="x.file"
                    class="cimg uk-box-shadow-medium"
                  >
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
  name: "ClientDetail",
  components: {
  },
  props:{
  },
  data() {
    return {
      spinAll: false,
      id: 0,
      reception: {
        description: '',
        file: '',
        customer: {
          name: '',
          email: '',
          nit: '',
          phone: '',
        },
      },
      receptionImages: []
    };
  },
  computed: {},
  mounted(){
    this.id = sessionStorage.getItem('idReception');
    this.init();
    this.images();
  },
  methods: {
    init() {
      this.spinAll = true;
      api.init('receptions');
      api.find(this.id)
      .then(response => {
        this.reception = response.data.reception;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(() => this.spinAll = false);
    },
    images() {
      this.spinAll = true;
      api.init('receptionImages');
      api.all('none', this.id)
      .then(response => {
        this.receptionImages = response.data.receptionImages;
      })
      .catch(() => {
        this.error = true ;
      })
      .finally(()=> this.spinAll = false);
    }
  }
};
</script>
<style lang="scss">
a{
    text-decoration: none;
}
</style>
