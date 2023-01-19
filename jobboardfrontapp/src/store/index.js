import { createStore } from 'vuex'
import auth from './auth.js';
import user from './user.js';
import company from './company.js';
import jobs from './jobs.js';
import application from './application.js';
import payment from './payment.js';
import csrf from '../axios/csrf';
import api from '../axios/axios';
// const store = useStore();
export default createStore({
  state: {
    EditModal: false,
    AddModal: false,
    ViewModal: false,
    DeleteModal: false,
    isLoading: false,
    fullPage: true,

    ApplyJobModal: false,

    top_jobs: [],
    top_applicants: [],

    specialization: [
      'Accounting/Finance All',
      'Audit & Taxation',
      'General/Cost Accounting',
      'Corporate Finance/Investment',
      'Banking/Financial',

      'Admin/Human Resources All',
      'Clerical/Adminsitrative Support',
      'Human Resources',
      'Secretarial/Executive Personal Assistant',
      'Top Management',

      'Sales/Marketing All',
      'Marketing/Business Dev',
      'Sales - Corporate',
      'Sales - Eng/Tech/IT',
      'Sales - Financial Services',
      'Retail Services',
      'Merchandising',
      'Telesales/Telemarketing',
      'E-commerce',
      'Digital Marketing',

      'Arts/Media/Communication All',
      'Advertising',
      'Arts/Creative Design',
      'Entertainment',
      'Public Relations',

      'Services All',
      'Personal Care',
      'Armed Forces',
      'Social Service',
      'Customer Service',
      'Lawyer/Legal Asst',
      'Logistics/Supply Chain',
      'Tech & Helpdesk Support',

      'Hotel/Restaurant All',
      'Food/Beverage/Restaurant',
      'Hotel/Tourism',

      'Education/Training All',
      'Education',
      'Training Dev',

      'Computer/Information Technology All',
      'IT-Software',
      'IT-Hardware',
      'IT-Network/Sys/DB Admin',

      'Engineering All',
      'Chemical Engineering',
      'Electronics',
      'Electrical',
      'other Engineering',
      'Environmental',
      'Oil/Gas',
      'Mechanical',
      'Industrial Engineering',

      'Manufactoring All',
      'Maintenance',
      'Purchasing/Material Mgnt',
      'Manufacturing',
      'Process Control',
      'Quality Assurance',

      'Building/Construction All',
      'Property/Real State',
      'Architect/Interior Design',
      'Civil/Construction',
      'Quantity Surveying',

      'Sciences All',
      'Agriculture',
      'Actuarial/Statics',
      'Food Tech/Nutritionist',
      'Geology/Geophysics',
      'Aviation',
      'Biotechnology',
      'Chemistry',
      'Science & Technology',
      'Biomedical',

      'Healthcare All',
      'Practitioner/Medical Asst',
      'Pharmacy',
      'Diagnostic/Others',

      'Others All',
      'Journalist/Editors',
      'General Work',
      'Others',
      'Publishing'
    ]
  },
  getters: {
      GET_TOP_JOBS: state =>  state.top_jobs,
      GET_TOP_APPLICANTS: state =>  state.top_applicants,
  },
  mutations: {
    Loading: (state, payload) => state.isLoading = payload,
    Open_Close_Modal: (state, payload) => state[payload] = !state[payload],
    SET_TOP_JOBS: (state, payload) => state.top_jobs = payload,
    SET_TOP_APPLICANTS: (state, payload) => state.top_applicants = payload,
  },
  actions: {
    async SEARCH_AUTO(_,payload) {
      try {
        await csrf.Csrf();
        let response = await api.post('/api/public/searching-keyword/auto', payload);
        return response;
      } catch (error) {
        if(error.response.status && error.response.status ==  422){
            let err = {errors: error.response.data.errors}
            throw err;
        } else if(error.response.status && error.response.status ==  400){
            let err = {message: error.response.data.error}
            throw err;
        } else if(error.request){
            
            let err = {message: error.request}
            throw err;
        } else{
            throw new Error('something wrong in server');
        }
      }
    },
    async SEARCH_AUTO_2(_,payload) {
      try {
        await csrf.Csrf();
        let response = await api.post('/api/public/searching-location/auto', payload);
        return response;
      } catch (error) {
        if(error.response.status && error.response.status ==  422){
            let err = {errors: error.response.data.errors}
            throw err;
        } else if(error.response.status && error.response.status ==  400){
            let err = {message: error.response.data.error}
            throw err;
        } else if(error.request){
            
            let err = {message: error.request}
            throw err;
        } else{
            throw new Error('something wrong in server');
        }
      }
    },
    async TOP_JOBS({commit}) {
      try {
          await csrf.Csrf();
          let {data} = await api.get('/api/public/top/jobs');
          commit('SET_TOP_JOBS', data.jobs)
      } catch (error) {
        if(error.response.status && error.response.status ==  422){
            let err = {errors: error.response.data.errors}
            throw err;
        } else if(error.response.status && error.response.status ==  400){
            let err = {message: error.response.data.error}
            throw err;
        } else if(error.request){
            
            let err = {message: error.request}
            throw err;
        } else{
            throw new Error('something wrong in server');
        }
      }
    },
    async TOP_APPLICATION({commit}) {
      try {
          await csrf.Csrf();
          let {data} = await api.get('/api/public/top/applicants');
          commit('SET_TOP_APPLICANTS', data.applicants);
      } catch (error) {
        if(error.response.status && error.response.status ==  422){
            let err = {errors: error.response.data.errors}
            throw err;
        } else if(error.response.status && error.response.status ==  400){
            let err = {message: error.response.data.error}
            throw err;
        } else if(error.request){
            
            let err = {message: error.request}
            throw err;
        } else{
            throw new Error('something wrong in server');
        }
      }
    },
    async GET_SPECIALIZATIONS() {
      try { 
        await csrf.Csrf();
        let {data} = await api.get(`/api/specialization/categories`);
        return data;
      } catch (error) {
        throw new Error('something wrong in server');
      }
    },

    async POST_VERIFY_ACCOUNT(_,payload) {
      try { 
        await csrf.Csrf();
        let {data} = await api.get(`/verified/account/${payload.email}/${payload.token}`);
        return data;
      } catch (error) {
        console.log(error);
        throw new Error('something wrong in server');
      }
    },

   async RESET_PASS({commit}, data) {
    try {
      commit('Loading', true)
      await csrf.Csrf();
      return await api.post(`/user/reset-pass`, data);
    } catch (error) {
      console.log(error.response.data)
      if(error.response.status && error.response.status ==  422){
        let err = {errors: error.response.data.errors}
        throw err;
    } else if(error.response.status && error.response.status ==  400){
        let err = {error: error.response.data.error}
        throw err;
    } else if(error.request){
        let err = {error: error.request}
        throw err;
    } else{
        throw new Error('something wrong in server');
    }
    } finally {
      commit('Loading', false)
    }
   },

   async RESET_UPDATE_PASS({commit}, data) {
    try {
      commit('Loading', true)
      await csrf.Csrf();
      return await api.post(`/user/update-pass`, data);
    } catch (error) {
      console.log(error.response.data)
      if(error.response.status && error.response.status ==  422){
          let err = {errors: error.response.data.errors}
          throw err;
      } else if(error.response.status && error.response.status ==  400){
          let err = {error: error.response.data.error}
          throw err;
      } else if(error.request){
          let err = {error: error.request}
          throw err;
      } else{
          throw new Error('something wrong in server');
      }
    } finally {
      commit('Loading', false)
    }
   }

  },
  modules: {
    auth,
    user,
    company, 
    jobs,
    application,
    payment
  }
})
