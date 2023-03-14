import axios from '../axios.factory'
import { AxiosInstance } from 'axios'

class ApiService {
    /**
     * @type {AxiosInstance}
     */
    api = axios

    /**
     *
     * @type {string|null}
     */
    apiEndpoint = null

    /**
     * @param {string|null} apiEndpoint
     */
    constructor(apiEndpoint = null) {
        this.apiEndpoint = apiEndpoint
    }

    /**
     * @param {string|null} prefix
     * @returns {string}
     */
    appApiUrl(prefix = null) {
        let url = ''

        if (prefix) {
            url += `${prefix}/`
        }

        return `${url}${this.apiEndpoint}`
    }
}

export default ApiService
