<template>
    <sw-card title="Form" class="app-card">
      <div class="app-card-form">
        <!-- @See https://shopware.github.io/meteor-component-library/?path=/docs/components-form-sw-button--default -->
        <sw-button @click="onClickButton">Button</sw-button>
      </div>

      <div class="app-card-form">
        <sw-button @click="onEnableLoading">Enable loading</sw-button>
      </div>

      <div class="app-card-form">
        <!-- https://shopware.github.io/meteor-component-library/?path=/docs/components-form-sw-checkbox--default -->
        <sw-checkbox label="Active" @change="onChangeCheckbox" :checked="hasCheckedBox"/>
      </div>

      <div class="app-card-form">
        <!-- https://shopware.github.io/meteor-component-library/?path=/docs/components-form-sw-colorpicker--default -->
        <sw-colorpicker label="Color picker" value="#e20808"></sw-colorpicker>
      </div>

      <div class="app-card-form">
        <!-- https://shopware.github.io/meteor-component-library/?path=/docs/components-form-sw-text-field--default -->
        <sw-url-field value="https://mothership.de"/>
      </div>

      <div class="app-card-form">
        <!-- https://shopware.github.io/meteor-component-library/?path=/docs/components-form-sw-switch--default -->
        <sw-switch label="Switch"/>
      </div>

      <div class="app-card-form">
        <sw-loader v-if="isLoading"/>
      </div>
    </sw-card>
</template>

<script>
import {notification} from "@shopware-ag/admin-extension-sdk";
import {
  SwButton,
  SwCard,
  SwCheckbox,
  SwColorpicker,
  SwLoader,
  SwSwitch,
  SwUrlField
} from "@shopware-ag/meteor-component-library";

export default {
  components: {
    'sw-button': SwButton,
    'sw-card': SwCard,
    'sw-checkbox': SwCheckbox,
    'sw-colorpicker': SwColorpicker,
    'sw-url-field': SwUrlField,
    'sw-loader': SwLoader,
    'sw-switch': SwSwitch,
  },

  data() {
    return {
      isLoading: false,
      hasCheckedBox: false,
    }
  },

  methods: {
    onClickButton() {
      this.sendNotification('Clicked button')
    },

    onChangeCheckbox() {
      this.sendNotification('onChangeCheckbox')
    },

    onEnableLoading() {
      this.isLoading = true;
      setTimeout(function () { this.isLoading = false }.bind(this), 3000)
    },

    sendNotification(message) {
      notification.dispatch({
        title: 'Success',
        message: message,
      })
    }
  },
}
</script>

<style scoped>
.app-card {
  top: 50px;
}

.app-card-form {
  margin-top: 24px;
  margin-bottom: 24px;
}
</style>