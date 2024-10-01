import axios from 'axios'
import NProgress from 'nprogress'
import { keysToSnake, keysToCamel } from '@core/utils/helper'

const csrfToken = document.head.querySelector('meta[name="csrf-token"]')
const calculatePercentage = (loaded, total) => (Math.floor(loaded * 1.0) / total)

if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content
} else {
    console.error('CSRF token not found')
}

const axiosInstance = axios.create({
    baseURL: '/api/v1'
});

axiosInstance.defaults.onDownloadProgress = e => {
    const percentage = calculatePercentage(e.loaded, e.total)
    NProgress.set(percentage)
}

axiosInstance.interceptors.request.use(
    config => {
        config.headers['X-Requested-With'] = 'XMLHttpRequest'

        if (config.upload) {
            config.headers['Content-Type'] = 'multipart/form-data; charset=utf-8; boundary=' + Math.random().toString().substr(2)
        }

        if(config.params) {
            config.params = keysToSnake(config.params)
        }
        if(! config.upload && config.data) {
            config.data = keysToSnake(config.data)
        }

        return config
    },
    error => {
        NProgress.done(true)
        return Promise.reject(error)
    })

axiosInstance.interceptors.response.use(
    response => {
        NProgress.done(true)

        let data = response.data
        if((typeof data === 'object' || data.isArray) && data !== null) {
            data = keysToCamel(data)
        }

        return Promise.resolve(data)
    },
    error => {
        NProgress.done(true)

        let data = error.response?.data
        let status = error.response?.status;

        if (typeof status == 'number' && status == 419) {
        }

        if((typeof data === 'object' || data?.isArray) && data !== null) {
            data = keysToCamel(data)
            data['response_status'] = status
        }

        return Promise.reject(data)
    })

export default axiosInstance
export { axios }
