<template>
  <div
    class="uk-text-center uk-height-1-1"
    uk-grid
  >
    <div class="uk-width-1-2@s uk-padding-remove">
      <div class="uk-card uk-card-default uk-height-1-1  uk-card-body uk-flex uk-flex-center uk-flex-middle">
        <div class="uk-card-badge uk-label ">
          @2019
        </div>
        <img
          src="./../assets/logox.png"
          width="300px"
          height="200px"
          alt=""
        >     
      </div>
    </div>
    <div class="uk-width-1-2@s uk-padding-remove">
      <div class="uk-padding uk-height-1-1 uk-card-body uk-card-primary uk-flex uk-flex-center uk-flex-middle">
        <form
          class="uk-form-stacked uk-light"
          @submit.prevent="onSubmit($event)"
        >
          <legend class="uk-legend">
            Recepción de Vehículos
          </legend>
          <h5>Ingrese Email y Contraseña</h5>
          <br>
          <div class="uk-margin">
            <label class="uk-form-label">Email</label>
            <div class="uk-form-controls">
              <div class="uk-inline">
                <span
                  class="uk-form-icon"
                  uk-icon="icon: mail"
                />
                <input
                  id="user.username"
                  v-model="user.username"
                  class="uk-input"
                  type="email"
                >
              </div>                    
            </div>
          </div>
          <div class="uk-margin">
            <label class="uk-form-label">Contraseña</label>
            <div class="uk-form-controls">
              <div class="uk-inline">
                <span
                  class="uk-form-icon"
                  uk-icon="icon: lock"
                />
                <input
                  id="user.password"
                  v-model="user.password"
                  class="uk-input"
                  type="password"
                >
              </div>                    
            </div>
            <br>
            <button
              class="uk-button uk-button-default uk-width-expand@m"
              type="submit"
              :disabled="saving"
            >
              {{ saving ? 'Verificando...' : 'Login' }}
            </button>
          </div>
          <div class="uk-margin">
            <span
              v-if="error"
              class="uk-text-danger uk-text-small"
            >{{ message }}</span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'Home',
    components:{
    },
    data() {
        return{
            url: 'http://127.0.0.1:8000/oauth/token',
            saving: false,
            error: false,
            message: '',
            token: '',
            user: {
                grant_type : 'password',
                client_id : 1,
                client_secret : 'mMEcV6gEGbfs8h8dZoEsOED6rPFJ8b1yW924wQ7W',
                username: '',
                password: ''
            }
        }
    },
    methods: {
        onSubmit() {
            this.saving = true;
            axios
            .post(this.url, this.user, { headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }})
            .then(response => {
                this.token =response.data.access_token;
                if(this.token.length <=0){
                    this.error = true;
                    this.message = 'Error al recibir datos';
                    setTimeout(() => {
                        this.error = false;
                    }, 3000);
                }else{
                    localStorage.setItem('token', this.token);
                    this.$router.push({ name: 'Home', params: { id: 0 }});
                }
            })
            .catch(error => {
                console.log(error)
                this.error = true;
                this.message = 'Email o Contraseña no Valido';
                setTimeout(() => {
                    this.error = false;
                }, 3000);
            })
            .finally(() => this.saving = false);
        },      
    }
}
</script>
<style>
</style>