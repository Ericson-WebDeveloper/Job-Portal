import csrf from '../axios/csrf';
import api from '../axios/axios';
import {handleResponse} from '@/helper/errorResponseHandler';
const state = {
    jobs: [],
    job: null,
    public_job: null,

    company_jobs: [],

    public_jobs: [],
    public_jobs_temp: [],

    vacancy_jobs: [],

    searchjobs: []
}

const getters = {
    GET_JOBS: (state) => state.jobs,
    GET_JOB: (state) => state.job,
    GET_JOB2: (state) => state.public_job,
    GET_COMPANY_JOBS: (state) => state.company_jobs,
    GET_VACANCY_JOBS: state => state.vacancy_jobs,
    GET_SEARCH_JOBS: state => state.searchjobs,
}

const mutations = {
    SET_JOBS: (state, payload) => state.jobs = payload,
    SET_JOB: (state, payload) => state.job = payload,
    SET_JOB2: (state, payload) => state.public_job = payload,
    SET_COMPANYJOB: (state, payload) => state.company_jobs = payload,

    UPDATING_JOBS: (state, payload) => {
        let index = state.jobs.data.findIndex((job) => job.id == payload.id);
        if(index <= -1) {
            console.log('Error index');
        }
        state.jobs.data.splice(index,1,payload.job);
    },

    SET_VACANCY_JOBS: (state, payload) => state.vacancy_jobs = payload,
    SET_SEARCH_JOBS: (state, payload) => state.searchjobs = payload
}

const actions = {
    async FETCH_VACANCY_JOBS({commit}, payload){
        try {
            console.log(payload.specialization)
            await csrf.Csrf();
            if(payload.page) {
                let {data} = await api.get(`/api/public/job-vacancy/list?page=${payload.page}&specialisation=${payload.specialization}`);
                commit('SET_VACANCY_JOBS',data.jobs);
            } else {
                let {data} = await api.get(`/api/public/job-vacancy/list?specialisation=${payload.specialization}`);
                commit('SET_VACANCY_JOBS',data.jobs);
            }
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

    async SEARCHING_JOB({commit}, payload) {
        try {
            await csrf.Csrf();
            // let url = payload.pageno ? `/api/public/searching-job?page=${payload.pageno}` : `/api/public/searching-job` ;
            let newData;
            let pageName = payload.datas.page;
            if(payload.pageno) {
                //console.log(payload.datas);
                let queryString = [];
                delete payload.datas.page;
                Object.keys(payload.datas).forEach(key => {
                    if(payload.datas[key] != '') {
                        // return key + '=' + payload.datas[key];
                        queryString.push( key + '=' + payload.datas[key]);
                    }
                });
                queryString = queryString.join("&");
                let {data} = await api.get(`/api/public/searching-job?page=${payload.pageno}&${queryString}`,);
                newData = data;
            } else {
                let {data} = await api.post(`/api/public/searching-job`,payload.datas);
                newData = data;
            }
            
            if(pageName == "searchjob") {
                // commit('SET_SEARCH_JOBS', data.jobs);
                commit('SET_SEARCH_JOBS', newData.jobs);
            } else {
               // commit('SET_VACANCY_JOBS',data.jobs);
                commit('SET_VACANCY_JOBS',newData.jobs);
            }
            // return data.jobs;
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

    async FETCH_JOBS({commit}, payload) {
        try {
            await csrf.Csrf();
            if(payload.page) {
                let {data} = await api.get(`/api/job/post/${payload.id}?page=${payload.page}`);
                commit('SET_JOBS',data.jobs);
            } else {
                let {data} = await api.get(`/api/job/post/${payload.id}`);
                commit('SET_JOBS',data.jobs); 
            }
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

    async FETCH_PUBLIC_COMPANYJOB({commit}, payload) {
        try {
            await csrf.Csrf();
            if(payload.page) {
                let {data} = await api.get(`/api/public/job-company/list/${payload.company_id}?page=${payload.page}`);
                commit('SET_COMPANYJOB',data.jobs);
            } else {
                let {data} = await api.get(`/api/public/job-company/list/${payload.company_id}`);
                commit('SET_COMPANYJOB',data.jobs);
            }
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

    async FETCH_PUBLIC_JOB({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/public/job/${payload}`);
            commit('SET_JOB2',data.job);
            return data.job; // new modify if have conflict
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

    async UPDATING_JOB({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.put(`/api/job/update/${payload.id}`, payload);
            commit('UPDATING_JOBS',{id: payload.id, job: data.job});
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

    async FETCH_JOB({commit}, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/job/get-data/${payload}`);
            commit('SET_JOB',data.job);
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
    async ADD_NEW_JOB(_, payload) {
        try {
            await csrf.Csrf();
            await api.post(`/api/job/post`, payload);
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

    async CHECKING_APPLICATION(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/job/post`, payload);
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
            //     let err = {message: error.response.data.error, status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },

    async TOTAL_ACTIVES(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get('/api/job/post-active/count/'+payload);
            return data.jobs_count
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: error.response.data.error, status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },
    async TOTAL_POST(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.get('/api/job/post-total/count/'+payload);
            return data.jobs_count
        } catch (error) {
            await handleResponse(error);
            // if(error.response.status && error.response.status ==  422){
            //     let err = {errors: error.response.data.errors}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  400){
            //     let err = {message: error.response.data.error}
            //     throw err;
            // } else if(error.response.status && error.response.status ==  401){
            //     let err = {message: error.response.data.error, status: error.response.status}
            //     throw err;
            // } else if(error.request){
            //     let err = {message: error.request}
            //     throw err;
            // } else{
            //     throw new Error('Something wrong in server');
            // }
        }
    },
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}