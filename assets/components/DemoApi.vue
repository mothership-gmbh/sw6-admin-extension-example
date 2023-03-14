<template>
    <sw-card title="Orders" class="app-card">
      <div v-if="orders">
        <div>
          <h3>Last {{ orders.length }} orders: </h3>
        </div>
        <div>
          <ul>
            <li v-for="order in orders">Order Number: {{ order.orderNumber }}</li>
          </ul>
        </div>
      </div>

      <sw-button
          @click="saveOrders"
          :isLoading="isLoading"
          :disabled="isLoading"
          variant="primary"
      >
        Send the orders to App
      </sw-button>
    </sw-card>
</template>

<script>
import {data, notification} from "@shopware-ag/admin-extension-sdk";
import {orderService} from "../utils/api/order.service";
import {SwButton, SwCard} from "@shopware-ag/meteor-component-library";

export default {
  components: {
    'sw-button': SwButton,
    'sw-card': SwCard,
  },

  data() {
    return {
      orders: null,
      isLoading: false,
    }
  },

  mounted() {
    this.createdComponent()
  },

  methods: {
    async createdComponent() {
      await this.loadOrders()
    },

    /**
     * Using Shopware 6 admin extension to get the order data
     * @returns {Promise<void>}
     */
    async loadOrders() {
      const criteria = new data.Classes.Criteria();
      criteria.setPage(1)
      criteria.setLimit(10)
      const orderRepository = data.repository('order')
      this.orders = await orderRepository.search(criteria);
    },

    /**
     * Using axios to send the data to the app server
     * @returns {Promise<void>}
     */
    async saveOrders() {
      this.isLoading = true
      try {
        const orderIds = []
        this.orders.forEach((order) => {
          orderIds.push(order.id)
        })

        const configs = {
          orderIds: orderIds
        }

        await orderService.saveOrders(configs);
        await notification.dispatch({
          title: 'Success',
          message: 'Successful to save orders',
          variant: 'success',
        })

      } catch (e) {
        await notification.dispatch({
          title: 'Error',
          message: e.response.data.error,
          variant: 'error',
        })

        console.log(e.response.data.error)
      } finally {
        this.isLoading = false
      }
    },
  },
}
</script>

<style scoped>
.app-card {
  top: 50px;
}

.app-card li {
  list-style-type: none;
}

.app-card .sw-button {
  margin-top: 12px;
}
</style>