import csrf from '../axios/csrf';
import api from '../axios/axios';
import {handleResponse} from '@/helper/errorResponseHandler';

const state = {
    applications: [],
    application: {},
    job_applications: []
}

const getters = {
    GET_APPLICATIONS: state => state.applications,
    GET_APPLICATION: state => state.application,
    GET_JOB_APPLICATIONS: state => state.job_applications
}

const mutations = {
    SET_APPLICATIONS: (state, payload) => state.applications = payload,
    SET_APPLICATION: (state, payload) => state.application = payload,
    SET_JOB_APPLICATIONS: (state, payload) => state.job_applications = payload,
}

const actions = {

    async DOWNLOAD_CSV(_, payload) {
        try {
            await csrf.Csrf();
            // let res = await api.post(`/api/application/cv/download`, {application_id: payload});
            let res = await api.post(`/api/application/cv/download`, {application_id: payload}, {responseType: "blob"});
            return res.data;
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_NEW_APPLICATIOn(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/application/new/${payload}`);
            return data;
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_JOBS_APPLICATIONS({commit}, payload) {
        try {
            let url = !payload.page ? `/api/job/application/${payload.job_id}` : `/api/job/application/${payload.job_id}?page=${payload.page}`;
            let {data} = await api.get(url);
            commit('SET_JOB_APPLICATIONS', data.applications); 
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async SUBMIT_APPLICATION(_, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/user/application-submit`, payload)
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async CHANGE_STATUS(_, payload) {
        try {
            await csrf.Csrf();
            await api.put(`/api/application/update/status/${payload.id}`, payload);
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async GET_ALL_APPLICATION_HISTORY({commit}, payload) {
        try {
            await csrf.Csrf();
            if(payload) {
                let {data} = await api.get(`/api/user/user-application/list?page=${payload}`);
                commit('SET_APPLICATIONS', data.applications); 
            } else {
                let {data} = await api.get(`/api/user/user-application/list`);
                commit('SET_APPLICATIONS', data.applications); 
            }
            
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: 'You have no authorization for this action', status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request, status: error.response.status}
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