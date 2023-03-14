import ApiService from './api.service'

class OrderService extends ApiService {
    saveOrders(configs) {
        return this.api.post(this.appApiUrl() + '/save', {
            configs
        })
    }
}

export const orderService = new OrderService('orders')
