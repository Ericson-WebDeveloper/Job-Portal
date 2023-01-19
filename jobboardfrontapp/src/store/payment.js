import api from "../axios/axios";
import csrf from "../axios/csrf";
import { handleResponse } from "@/helper/errorResponseHandler";
const state = {
    
    subcription: {},
    // isSubcribedValid: false,
    
    UntilWhen: '', 
    UntilWhenTime: '',

    DueDate: true, // invalid -> true
    DuedateToday: true, // invalid -> true
    isSubcribed: false, 
    haveSubcription: null,
}

const getters = {
    GET_SUBCRIPTION : (state) => state.subcription,
    GET_UntilWhen: (state) => state.UntilWhen,
    GET_DuedateToday: (state) => state.DuedateToday,
    GET_Duedate: (state) => state.DueDate,
    GET_isSubcribed: (state) => state.isSubcribed,
    GET_haveSubcription: (state) => state.haveSubcription,
    GET_UntilWhenTime: (state) => state.UntilWhenTime,
    // GET_isSubcribedValid: (state) => state.isSubcribedValid
}

const mutations = {
    SET_SUBCRIPTION: (state, payload) => state.subcription = payload,
    SET_SUBCRIPTION_DETAILS: (state, payload) => {
        ({subcription: state.subcription, 
        isSubcribed: state.isSubcribed,
        haveSubcription: state.haveSubcription,
        // isSubcribedValid: state.isSubcribedValid,

        UntilWhenTime: state.UntilWhenTime,
        
        DueDate: state.DueDate,
        DuedateToday: state.DuedateToday,
        UntilWhen: state.UntilWhen} = payload)
    } 
}

const actions = {
    async STRIPE_PAYMENT(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/subcription/stripe-payment/option`, payload);
            return data
        } catch (error) {
            await handleResponse(error);
        }
    },

    async STRIPE_AUTH_3D(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/subcription/stripe-payment/option/authenticate`, payload);
            return data
        } catch (error) {
            await handleResponse(error);
        }
    },

    async GET_SUBCRIPTION({commit}) {
        try {
            await csrf.Csrf();
            let {data} = await api.get(`/api/employeer_subcription/checking-details`);
            commit('SET_SUBCRIPTION_DETAILS',data);
        } catch (error) {
            await handleResponse(error);
        }
    },

    async MAKE_PAYPAL_PAYMENT(_, payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/subcription/paypal-payment/option`, payload);
            return data;
        } catch (error) {
            await handleResponse(error);
        }
    },

    async CONFIRM_PAYMENT_DATA(_,payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/subcription/paypal-payment/confirmData`, payload);
            return data;
        } catch (error) {
            await handleResponse(error);
        }
    },
    async COMPLETE_PAYMENT_PAYPAL(_,payload) {
        try {
            await csrf.Csrf();
            let {data} = await api.post(`/api/subcription/paypal-payment/complete`, payload);
            return data;
        } catch (error) {
            await handleResponse(error);
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