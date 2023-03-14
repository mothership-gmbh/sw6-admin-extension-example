import Vue from 'vue'
import DeviceHelper from './device.helper'

let pluginInstalled = false

export const initHelper = () => {
    if (pluginInstalled) {
        console.warn('DeviceHelper', 'This plugin is already installed')
        return false
    }

    const deviceHelper = new DeviceHelper()

    Object.defineProperties(Vue.prototype, {
        $device: {
            get() {
                return deviceHelper
            },
        },
    })

    Vue.mixin({
        destroyed() {
            this.$device.removeResizeListener(this)
        },
    })

    pluginInstalled = true

    return true
}
