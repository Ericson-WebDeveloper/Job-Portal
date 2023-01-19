<template>
    <div class="bg-gray-100 h-screen">
      <div class="bg-white p-6  md:mx-auto h-full">
        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6" v-if="successPayment != null && successPayment">
            <path fill="currentColor"
                d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
            </path>
        </svg>
        <div v-if="successPayment == null" class="text-center">
            <label class="text-2xl font-mono font-semibold">Wait Payment Process........</label>
        </div>
        <div class="text-center" v-if="successPayment != null && successPayment">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!</h3>
            <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
            <p> Have a great day!  </p>
            <div class="py-10 text-center">
                <router-link :to="{name: 'Employeer-Dashboard'}" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                    GO BACK DASHBOARD
               </router-link>
            </div>
        </div>
        <div class="text-center" v-if="successPayment != null && !successPayment">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Cancel or Failed!</h3>
            <div class="py-10 text-center">
                <router-link :to="{name: 'Employeer-Subcription'}" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                    GO BACK PAYMENT PAGE
               </router-link>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
// ?token=2PR68978P3036423S&PayerID=UV462D3L4AMUN
// approvalId

import { inject, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";

    const successPayment = ref(null);
    const store = useStore();

    const route = useRoute();
    const router = useRouter();
    const SwalAlert = inject("$Swal");

    onMounted(async() => {
        if(!sessionStorage.getItem("paypal_data") || !route.query.token || !route.query.PayerID) {
            router.push({name: 'Employeer-Subcription'});
        }

        let data = JSON.parse(sessionStorage.getItem("paypal_data"));
        await confirmPaymentExist(data);

        const paramData = {
            ...data,
            token: route.query.token,
            PayerID: route.query.PayerID
        }
        await completingPayment(paramData);
    });

    const confirmPaymentExist = async ({reference_id}) => {
        try {
            store.commit("Loading", true);
            let data = await store.dispatch('payment/CONFIRM_PAYMENT_DATA', {reference_id});
            if(!data) {
                sessionStorage.removeItem("paypal_data");
                router.push({name: 'Employeer-Subcription'});
            }
        } catch (error) {
            router.push({name: 'Employeer-Subcription'});
        } finally {
            store.commit("Loading", false);
        }
    }

    const completingPayment = async(datas) => {
        try {
            store.commit("Loading", true);
            let data = await store.dispatch('payment/COMPLETE_PAYMENT_PAYPAL', datas);
            console.log(data);
            sessionStorage.removeItem("paypal_data");
            successPayment.value = true;
            SwalAlert.fire({
                position: 'center',
                icon: 'success',
                title: 'Payment Success',
                showConfirmButton: true,
            }); 
        } catch (error) {
            successPayment.value = false;
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Cannot Process your Payment. try it later',
                showConfirmButton: true,
            }); 
        } finally {
            store.commit("Loading", false);
        }
    }

</script>