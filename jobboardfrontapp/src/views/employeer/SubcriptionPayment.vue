<template>
    <div>
        <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[props.PaymentModal ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Make Subcription Payment</h1>
                <svg @click.prevent="CloseModal('PaymentModal')" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 ">
                <div class="mx-auto">
                    <div class="">
                
                        <div class="mt-2 bg-white rounded-lg shadow">
                    
                            <div class="px-5 pb-5">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <div class="flex flex-col mb-3 space-y-4">
                                            <div class="px-2">
                                                <label for="type1" class="flex items-center cursor-pointer">
                                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500 paymenttype" name="type" id="type1" checked>
                                                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                                                </label>
                                            </div>
                                            <div class="px-2">
                                                <label for="type2" class="flex items-center cursor-pointer">
                                                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500 paymenttype" name="type" id="type2">
                                                    <img src="https://www.sketchappsources.com/resources/source-image/PayPalCard.png" class="h-8 ml-3">
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Stripe Payment -->
                                        <div class="stripe-card" id="stripe-oi9o9is">
                                            <div class="mb-3">
                                                <label class="font-bold text-lg mb-2 ml-1">Name on Card</label>
                                                <div>
                                                    <input v-model="card.name" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="font-bold text-lg mb-2 ml-1">Email</label>
                                                <div>
                                                    <input v-model="card.email" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md 
                                                    focus:outline-none focus:border-indigo-500 transition-colors" placeholder="example@gmail.com" type="email"/>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <!-- <input type="hidden" name="paymentMethod" id="paymentMethod"> -->
                                                <label for="card-element" class="font-bold text-lg mb-2 ml-1">Card Details</label>
                                                <div id="card-element"></div>
                                                <span id="card-errors" class="text-red-500"></span><br>
                                            </div>

                                            <div class="mb-3">
                                                <button @click.prevent="makePay" class="block w-full max-w-xs mx-auto bg-indigo-500 
                                                hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg 
                                                px-3 py-3 font-semibold"><i class="fas fa-lock"></i> PAY NOW</button>
                                            </div>

                                            <div>
                                                <label class="font-bold text-lg mb-2 ml-1">$ {{props.price.amount}}</label> - 
                                                <label class="font-bold text-lg mb-2 ml-1">{{props.price.type}}</label>
                                            </div>
                                        </div>
                                        <!-- End Stripe Payment -->
                                        <!-- Paypal Payment -->
                                        <div class="stripe-card mt-5 hidden" id="paypal-09iksjhy">
                                            <div class="mb-3"> 
                                                <label class="text-center font-bold text-2xl mb-5 ml-1">Pay with Paypal</label>
                                            </div>
                                            <div class="mt-5">
                                               
                                                <button class="block w-full max-w-xs mx-auto bg-blue-500 
                                                hover:bg-blue-700 focus:bg-blue-700 text-white rounded-lg 
                                                px-3 py-3 font-semibold" id="stripebtnpayment" 
                                                @click="makePaypalPayment">
                                                <i class="fas fa-lock"></i> PAY NOW</button>
                                            </div>
                                            <div>
                                                <label class="font-bold text-lg mb-2 ml-1">$ {{props.price.amount}}</label> - 
                                                <label class="font-bold text-lg mb-2 ml-1">{{props.price.type}}</label>
                                            </div>
                                        </div>
                                        <!-- End Paypal Payment -->
                                    </div>
                                </div>
                                
                            </div>

                            <div id="errors4">

                            </div>
                        </div>

                    
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click.prevent="CloseModal('PaymentModal')" class="bg-red-500 p-2 rounded text-white hover:bg-red-600" >Cancel</button>
                <!-- <button type="button" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Subcribe Now</button> -->
            </div>
        </div>
    </div>
    </div>
</template>

<script setup>
import {defineProps, defineEmits, onMounted, ref, reactive, inject} from 'vue';
import StripeClass from '@/helper/Stripe.js';
import { useStore } from 'vuex';
    const props = defineProps({
        PaymentModal: Boolean,
        price: Object // amount, type = 1 mothn, 6 months
    });
    const SwalAlert = inject("$Swal");
    const store = useStore();
    const card = reactive({
        name: '',
        email: '',
        payment_type: 'stripe'
    });
    
    let stripe = ref(null);

    onMounted(async () => {
        document.querySelectorAll(".paymenttype").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                if(e.target.id == "type1") {
                    document.querySelector("#stripe-oi9o9is").classList.remove("hidden");
                    card.payment_type = "stripe";
                    document.querySelector("#paypal-09iksjhy").classList.add("hidden");
                } else {
                    document.querySelector("#paypal-09iksjhy").classList.remove("hidden");
                    card.payment_type = "paypal";
                    document.querySelector("#stripe-oi9o9is").classList.add("hidden");
                }
            });
        });
        stripe.value = new StripeClass();
        await stripe.value.loadStripe('card-element');
    });

    const makePaypalPayment = async () => {
        try {
            store.commit("Loading", true);
            const data = {
                amount: 1,
                subcription_type: props.price.type,
                payment_type: 'paypal'
            }
            let response = await store.dispatch('payment/MAKE_PAYPAL_PAYMENT', data);
            sessionStorage.setItem('paypal_data', JSON.stringify(response));
            if(sessionStorage.getItem('paypal_data')) {
                window.location.href = response.paymenturl;
            } else {
               SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Process your Payment. try it later',
                    showConfirmButton: true,
                }); 
            }
        } catch {
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

    const emit = defineEmits("closingModal");

    const CloseModal = (modalName) => {
        emit('closingModal', modalName)
    }

    const backendApi = async (paymentMethod) => {
        const data = {
            paymentMethod: paymentMethod,
            payment_type: card.payment_type,
            amount: props.price.amount,
            subcription_type: props.price.type,
        }
        try {
            return await store.dispatch('payment/STRIPE_PAYMENT', data);
        } catch (error) {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Confirming Payment Failed. please contact us for clarification.',
                showConfirmButton: true,
            });
        }
    }

    const makePay = async () => {
        if(stripe.value.isErrorCard || card.name.trim() == "" || card.email.trim() == "") {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Card Details Invalid',
                showConfirmButton: true,
            });
        }
        try {
            store.commit("Loading", true);
            let res = await stripe.value.paymentSubmit(card);
            if(res) {
                // get payment method
                let paymentMethod = sessionStorage.getItem("paymentMethod");
                // make a submit request to backend for payment api stripe
                let response = await backendApi(paymentMethod);
                if(!response.action) {
                    SwalAlert.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Subcription Payment Success',
                        showConfirmButton: true,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    let response2 = await stripe.value.auth_3d(response.clientSecret);

                    if(response2.response) {
                        const dataauth = {
                            payment_id: response.payment_id,
                            payment_type: response.payment_type,
                            payment_intents_id: response.payment_intents_id,
                            company_id: response.company_id,
                            subcription_type: response.subcription_type
                        }
                        await store.dispatch('payment/STRIPE_AUTH_3D', dataauth);
                        SwalAlert.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Subcription Payment Success',
                            showConfirmButton: true,
                        }).then(() => {
                            window.location.reload();
                        });

                    } else {
                        SwalAlert.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Rejected Payment Authenticate',
                            showConfirmButton: true,
                        });
                    }
                }
            } else {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Process your Payment. try it later',
                    showConfirmButton: true,
                });
            }
        } catch (error) {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Cannot Process your Payment. try it later',
                showConfirmButton: true,
            }).then(() => {
                window.location.reload();
            });
        } finally {
            store.commit("Loading", false);
        }
    }
</script>

<style scoped>
.InputElement {
    border-color: blue;
}
</style>