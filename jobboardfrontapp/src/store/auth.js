import csrf from '../axios/csrf';
import api from '../axios/axios';
import {handleResponse} from '@/helper/errorResponseHandler';
const state = {
    // user: {
    //     name: 'Ericson'
    // },

    token: localStorage.getItem('V3AiA32jCTjVlDEvx6QF') || null,
    loggedin: localStorage.getItem('V3AiA32jCTjVlDEvx6QF') ? true : false
    // loggedin: csrf.getCookie() ? true : false
}

const getters = {
    GET_LOGGED_STATUS: (state) => state.loggedin
}

const mutations = {
    LOGGED_IN: (state) => state.loggedin = true,
    SET_TOKEN: (state, payload) => state.token = payload,
}

const actions = {
    async VERIFY_USER() {
        try {
            await csrf.Csrf(); // new added code Jan 13
            let {data} = await api.get('/api/user-verify');
            return data;
        } catch (error) {
            if(error.response.status && error.response.status ==  422)
            {
                let err = {errors: error.response.data.errors}
                throw err;
            } else if(error.response.status && error.response.status ==  400){
                let err = {message: error.response.data.error}
                throw err;
            } else if(error.request){
                let err = {message: error.request, status: error.response.status}
                throw err;
            } else{
                throw new Error('Something wrong in server');
            }
        }
    },

    async AUTH_VERIFY_USER() {
        try {
            await csrf.Csrf();
            let {data} = await api.get('/api/user-verify');
            data?.user ?? localStorage.setItem('user_data', JSON.stringify(data.user));
            return data.authenticate;
        } catch {
            return false;
        }
    },

    async GET_USER({commit}) {
        try {
            await csrf.Csrf();
            let response = await api.get('/api/user');
            localStorage.setItem('user_data', JSON.stringify(response.data.data));
            commit('user/SET_USER', response.data.data, {root: true});
        } catch (error) {
            console.log('Something wrong');
        }
    },

    async LOGOUT({commit}) {    
        try {
            await csrf.Csrf();
            await api.post('/api/logout');
            commit('SET_TOKEN', null);
            localStorage.removeItem('user_data');
            csrf.deleteToken();
        } catch (error) {
            if(error.response.status && error.response.status ==  400){
                let err = {message: error.response.data.error}
                throw err;
            } else if(error.request){
                let err = {message: error.request}
                throw err;
            } else {
                commit('SET_TOKEN', null);
                csrf.deleteToken();
                throw new Error('something wrong in server');
            }
        }
    },

    async LOGIN_USER({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post('/login', payload);
            localStorage.setItem('V3AiA32jCTjVlDEvx6QF', true);
            commit('SET_TOKEN', localStorage.getItem('V3AiA32jCTjVlDEvx6QF'));
            // let response = await api.get('/api/user');
            // commit('user/SET_USER', response.data.data, {root: true});
            // localStorage.setItem('user_data', JSON.stringify(response.data.data));
            commit('user/SET_USER', data.user, {root: true});
            localStorage.setItem('user_data', JSON.stringify(data.user));
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.request){
                
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('something wrong in server');
            // }
        }
    },

    async REGISTER_EMPLOYEER(_, payload) {
        try {
            await csrf.Csrf();
            await api.post('/signup-employeer', payload);
            return {message: 'Register Success. Please wait for activation account. we email you.'};
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('something wrong in server');
            // }
        }
    },

    async REGISTER_USER(_, payload) {
        try {
            await csrf.Csrf();
            await api.post('/register-user', payload);
            return {message: 'Register Success. Please verify your account. link was sent via email'};
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.request){
                
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('something wrong in server');
            // }
        }
    }
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}