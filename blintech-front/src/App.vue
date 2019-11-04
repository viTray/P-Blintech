<template>
  <div id="app">
    <router-view />
  </div>
</template>
<style lang="scss">
$global-primary-background: #3f4458 !default; 
$global-default-background: white;
$global-success-background: #1e87f0;
//nav
$navbar-background: white;
$dropdown-background: white;
//Formulario
$text-secondary-color: whitesmoke;
$form-focus-background: transparent !default;
$form-background: transparent !default;
$form-radio-border: darkgrey;
//Inputs Radio
$form-radio-checked-background: rgb(47, 64, 82);
$form-radio-checked-focus-background: #1e87f0;
$form-radio-background: white;
//Buttom
$button-text-transform: none;
$tab-item-text-transform: none;
//card
$card-hover-background: white;
$card-default-background: white;
$card-default-hover-background: darken(white, 23%) !default;
//table
$table-header-cell-font-size: 12px;
$table-header-cell-font-weight: none;
$table-row-active-background: #f8f8f8;

//ofcanvas
$offcanvas-bar-color-mode: dark;

@import "uikit/src/scss/variables.scss";
@import "uikit/src/scss/variables-theme.scss";
@import "uikit/src/scss/mixins.scss";
@import "uikit/src/scss/mixins-theme.scss";
@import "uikit/src/scss/uikit.scss";

html {
  width: 100%;
  height: 100%;
  background-color: white;
}
body {
  width: 100%;
  background-color: #e6e7eb;
  height: 100%;
}
#app {
  width: 100%;
  height: 100%;
}
.uk-checkbox {
  border-radius: 3px;
}
.uk-button {
  border-radius: 5px;
}

.c {
  border-radius: 5px;
}
.cont {
  padding-left: 200px;
  padding-top: 80px;
  padding-right: 0px;
  padding-bottom: 0px
}
@media (max-width: 1200px) {
  .cont {
  padding-left: 0px;
  padding-top: 80px;
  padding-right: 0px;
  padding-bottom: 20px;
  }
}
footer{
  border-top: 1px solid darkgray;
}
</style>
