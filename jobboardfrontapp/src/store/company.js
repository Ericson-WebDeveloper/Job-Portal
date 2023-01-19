import api from "../axios/axios"
import csrf from "../axios/csrf"
import {handleResponse} from '@/helper/errorResponseHandler';

const state = {
    companies: [],
    company: {},
    company_public: {},
    top_companies: []
}

const getters = {
    GET_COMPANIES: (state) => {
        return state.companies;
    },
    GET_COMPANY: (state) => state.company,
    GET_COMPANY2: (state) => state.company_public,
    GET_TOP_COMPANY: (state) => state.top_companies,
}

const mutations = {
    SET_COMPANIES: (state,payload) => state.companies = payload,
    SET_COMPANY: (state,payload) => state.company = payload,
    SET_COMPANY2: (state,payload) => state.company_public = payload,
    SET_TOP_COMPANIES: (state,payload) => state.top_companies = payload,
}

const actions = {
    async TOP_COMPANIES({commit}) {
       try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/public/top/companies-list`);
            let newCompanies = data.companies.map((company) => {
                // return company.map((comp) => {
                    let res = Array.from(company.jobs).some((job) => {
                        return job.open == 0;
                    });
                    if(res) {
                        return {...company, hiring: true}
                    } else {
                        return {...company, hiring: false}
                    }
                //})
            });
            commit('SET_TOP_COMPANIES', newCompanies);
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

    async FETCH_COMPANY_DATA({commit}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/company/details`);
            commit('SET_COMPANY', data.company);
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

    async FETCH_ALL_COMPANIES({commit}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/public/companies-list`);
            commit('SET_COMPANIES', data.companies);
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
    async FETCH_PUBLIC_COMPANY({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/public/company/${payload}`);
            commit('SET_COMPANY2', data.company);
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

    async UPDATE_COMPANY_IMAGE({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/company/update/company-image/${payload.id}/?_method=PUT`, payload.data);
            commit('SET_COMPANY', data.company);
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

    async UPDATE_OTHER_DATA({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.put(`/api/company/update/other-data/${payload.id}`, payload);
            commit('SET_COMPANY', data.company);
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

    async UPDATE_PROFILE_DATA({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.put(`/api/company/update-details/${payload.id}/?_method=PUT`, payload);
            commit('SET_COMPANY', data.company);
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