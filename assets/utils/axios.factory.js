import axios from 'axios'

const instance = axios.create({
    baseURL: window.appApiUrl,
    responseType: 'json',
})

instance.interceptors.request.use(async (config) => {
    const shopQueries = window.shopQueries || {}

    config.headers = {
        ...shopQueries,
        ...config.headers,
    }

    return config
})

instance.interceptors.response.use(
    response => {
        return response.data
    },
    error => {
        Promise.reject(error.response ? error.response.data : error)
    }
)

export default instance
