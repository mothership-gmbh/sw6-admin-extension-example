/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import {orderDetailAction} from './ui/order-detail-action'
import {initHelper} from "./init/helper.init";
import { location, ui } from '@shopware-ag/admin-extension-sdk';
import Vue from 'vue';
import App from './components/App';
import router from './utils/router'
import '@shopware-ag/meteor-component-library/dist/style.css';


initHelper()

const locationId = 'mothership-main-app'
const createUI = () => {
    ui.menu.addMenuItem({
        label: 'Mothership demo app',
        locationId,
    })

    orderDetailAction()
}


if (location.isIframe() && location.is(location.MAIN_HIDDEN)) {
    createUI();
}

if (location.isIframe() && !location.is(location.MAIN_HIDDEN)) {
    location.startAutoResizer()

    new Vue({
        render: h => h(App),
        router,
    }).$mount('#root')
}