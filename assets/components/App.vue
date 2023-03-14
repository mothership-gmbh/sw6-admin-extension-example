<template>
  <div class="mothership-wrapper">
    <div>
      <sw-tabs ref="tabs" :items="tabs" default-item="api" />
    </div>

    <router-view />
  </div>
</template>

<script>
import {SwTabs} from '@shopware-ag/meteor-component-library';

export default {
  components: {
    'sw-tabs': SwTabs,
  },

  data() {
    return {
      tabs: [
        {
          label: 'API',
          name: 'api',
        },
        {
          label: 'Form',
          name: 'form',
        },
      ]
    }
  },

  mounted() {
    this.$watch(
        () => {
          return this.$refs.tabs.activeItemName
        },
        (routeName) => {
          this.$router.push({name: routeName})
        },
        {
          immediate: true,
          deep: true,
        }
    )
  },
}
</script>

<style>
.mothership-wrapper {
  max-width: 960px;
  margin: 0 auto 15px;
}

.sw-tabs {
  margin-bottom: 32px;
}
</style>