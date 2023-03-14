import {notification, ui} from '@shopware-ag/admin-extension-sdk';
import {orderService} from "../utils/api/order.service";

export const orderDetailAction = () => {
    ui.actionButton.add({
        action: 'mothership_order-detail-action',
        entity: 'order',
        view: 'detail',
        label: 'Send to demo app',
        callback: async (entity, entityIds) => {
            const configs = {
                orderIds: entityIds
            }

            await orderService.saveOrders(configs);
            await notification.dispatch({
                title: 'Success',
                message: 'Successful to send order',
                variant: 'success',
            })
        },
    })
}
