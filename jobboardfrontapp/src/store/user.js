import csrf from '../axios/csrf';
import api from '../axios/axios';
import { handleResponse } from '@/helper/errorResponseHandler';

const state = {
    user: localStorage.getItem("user_data") ? JSON.parse(localStorage.getItem("user_data")) : {},
    users: [],
    employeer: [],
    jobs: []
}

const getters = {
    GET_ROLES: (state) => state.user.roles,
    GET_USER_DATA: (state) => state.user,
    GET_USERS_DATA: (state) => state.users,
    GET_EMPLOYEERS_DATA: (state) => state.employeer,
    GET_JOBS_DATA: (state) => state.jobs,
}

const mutations = {
    SET_USER: (state, payload) => state.user = payload,
    SET_USERS: (state, payload) => state.users = payload,
    SET_EMPLOYEERS: (state, payload) => state.employeer = payload,
    SET_JOBS: (state, payload) => state.jobs = payload,
}

const actions = {
    async FETCH_EMPLOYEERS({commit}, payload) {
        try {
            let url = payload.url == null ? `/api/get-employeers` : `/api/get-employeers?page=${payload.url}`;
            await csrf.Csrf();
            let {data} = await api.get(url);
            await commit('SET_EMPLOYEERS',data.employeers);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async ACTIVATE_DEACTIVATE(_, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/admin/activate-deactivate/employeer?_method=PUT`, payload);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async FETCH_USER(_,{email}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/get-user?email=${email}`);
            return data.user;
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_ALL_USERS2({commit}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/get-users`);
            await commit('SET_USERS', data.users);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_ALL_JOBS({commit}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/get-jobs`);
            await commit('SET_JOBS', data.jobs);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_ALL_USERS({commit}, payload) {
        try {
            let url = payload.url == null ? `/api/admin/users` : `/api/admin/users?page=${payload.url}`;
            await csrf.Csrf();
            let {data} = await api.get(url);
            await commit('SET_USERS',data.users);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async UPDATE_PROFILE({dispatch}, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/user/update-details/?_method=PUT`, payload);
            await dispatch('auth/GET_USER', null, { root: true });
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async UPDATE_JOB_EXP({dispatch}, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/user/update-job-exp/?_method=PUT`, payload);
            await dispatch('auth/GET_USER', null, { root: true });
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async UPDATE_IMAGE({dispatch}, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/user/update-image/?_method=PUT`, payload);
            await dispatch('auth/GET_USER', null, { root: true });
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },
    
    async UPDATE_PASSWORD (_, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/user/update-password/?_method=PUT`, payload);
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
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_DASHBOARD_DATA() {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/user/user-application/dashboard-count`);
            return data;
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
            //     throw new Error('Something wrong in server');
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