import Cookies from 'js-cookie';
import api from './axios.js'

export default {
    Csrf() {
        let token = Cookies.get("XSRF-TOKEN");
        if (token) {
            return new Promise((resolve) => {
                resolve(token);
            });
        }
        // try {
            return api.get(`/sanctum/csrf-cookie`);
        // } catch (error) {
        //     console.log(error.request)
        // }
        
    },

    deleteToken() {
        Cookies.remove('token');
        Cookies.remove('XSRF-TOKEN');
        Cookies.remove('laravel_session');
        localStorage.removeItem('V3AiA32jCTjVlDEvx6QF');
        // document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        // document.cookie = "XSRF-TOKEN= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        // document.cookie = "laravel_session= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    },

    getCookie() {
        return Cookies.get("XSRF-TOKEN") || null
        // if(document.cookie && document.cookie == 'token'){
        //     const token = document.cookie.split('; ').find((c) => c.startsWith('token')).split('=')[1];
        //     return token; 
        // }
    }
}