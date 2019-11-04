<template>
  <li>
    <span class="uk-float-left uk-text-small">{{ title }}</span>
    <div class="uk-float-right">
      <button
        v-if="extra == 'si'"
        class="uk-button uk-button-text uk-margin-left"
        uk-icon="link"
      />
      <div uk-drop="mode: hover">
        <div
          class="uk-card uk-card-body uk-card-default uk-padding-remove uk-background-default"
          style="width:250px"
        >
          <div
            class="uk-padding-small uk-width-1-1 uk-box-shadow-small"
          >
            <p>Observación: <br>{{ description }}</p>
            <div>
              <ul
                uk-accordion
                class="uk-padding-remove"
              >
                <li>
                  <a class="uk-accordion-title"><span uk-icon="icon: image" /></a>
                  <div class="uk-accordion-content uk-text-center">
                    <img
                      ref="img"
                      :src="file"
                      width="200px"
                      height="100px"
                      alt=""
                    >
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <input
        v-model="state"
        class="uk-radio uk-margin-left"
        type="radio"
        :name="code"
        value="si"
        disabled
      >
      <input
        v-model="state"
        class="uk-radio uk-margin-left"
        type="radio"
        :name="code"
        value="no"
        disabled
      >
    </div>
  </li>
</template>

<script>

export default {
  name: 'Meli',
    props:{
      title: {
        type: String,
        default: 'Undefined'
      },
      code: {
        type: Number,
        default: 0
      },
      state: {
        type: String,
        default: 'Undefined'
      },
      extra: {
        type: String,
        default: 'Undefined'
      },
      description: {
        type: String,
        default: 'Undefined'
      },
      file: {
        type: String,
        default: 'Undefined'
      },
    },
    data () {
      return {
      }
    },
    mounted(){    
    },
  methods:{
  }
}
</script>
<style lang="scss" scoped>
  .uk-button{
    border-radius: 0px;
  }
</style>
