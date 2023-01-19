<template> 
  <div id="subcription-main" class="h-screen">
        <header class="flex flex-col items-center mb-12 mt-6">
            <h2 class="text-3xl text-primary-white font-bold font-mono" 
            v-if="DueDate && DuedateToday">Usage Pricing</h2>
        </header>
        <section class="flex flex-col lg:flex-row items-start lg:justify-center w-full lg:px-10 py-12" 
        v-if="DueDate && DuedateToday">
            <article class="w-4/5 lg:w-custom mb-10 lg:px-4 py-10 text-center text-white bg-gray-500 mx-auto">
                <h5 class="font-bold text-base">1 Month</h5>
                <h2 class="pb-4 flex justify-center font-bold border-b border-gray-300">
                    <span class="text-6xl mr-1">$</span>
                    <span class="text-6xl"> 10</span>
                </h2>
                <ul class="text-sm font-bold">
                    <li class="pt-4 pb-4 border-b border-gray-300">1 month 24/7 support</li>
                    <li class="pt-3 pb-4 border-b border-gray-300">4 contributors</li>
                    <li class="pt-4 pb-4 border-b border-gray-300">Up to 3 GB storage space</li>
                </ul>
                <button
                class=" uppercase text-center text-sm mt-12 xl:px-24 px-12 sm:px-16 py-2 font-bold text-primary-very-light rounded-md border-2 border-white 
                hover:bg-gray-300 hover:text-black" @click.prevent="makeSubcribed(10, '1 Month')"
                >
                Subscribe
                </button>
            </article>
            <article class="lg:w-custom w-4/5 mb-10 py-16 lg:-mt-6 text-white bg-primary-blue text-center bg-gray-700 mx-auto">
                <h5 class="font-bold text-base ">1 Year</h5>
                <h2 class="font-bold pb-4 mt-2 border-b border-gray-100 flex justify-center">
                    <span class="text-6xl mr-1">$</span>
                    <span class="text-6xl "> 100</span>
                </h2>
                <ul class=" text-sm font-bold">
                    <li class="pt-4 pb-4 border-b border-gray-200">1 year 24/7 support</li>
                    <li class="pt-4 pb-4 border-b border-gray-200">7 contributors</li>
                    <li class="pt-4 pb-4 border-b border-gray-200">Up to 6 GB storage space</li>
                </ul>
                <button
                class="uppercase text-center text-sm mt-10 xl:px-24 px-12 sm:px-16 py-2 rounded-md font-bold bg-primary-very-light text-primary-white border-2 border-white 
                hover:bg-gray-300 hover:text-black" @click.prevent="makeSubcribed(100, '1 Year')"
                >
                Subscribe
                </button>
            </article>
            <article class="w-4/5 lg:w-custom mb-10 lg:px-4 py-10 text-center text-white bg-gray-500 mx-auto">
                    <h5 class="font-bold text-base">6 Month</h5>
                    <h2 class="flex justify-center pb-4 font-bold border-b border-gray-200">
                <span class="text-6xl mr-1">$</span
                    ><span class="text-6xl">55</span>
                </h2>
                <ul class="text-sm font-bold">
                    <li class="pt-4 pb-4 border-b border-gray-200">6 month's 24/7 support</li>
                    <li class="pt-4 pb-4 border-b border-gray-200">11 contributors</li>
                    <li class="pt-4 pb-4 border-b border-gray-200">Up to 10 GB storage space</li>
                </ul>
                <button
                class="uppercase text-center text-sm mt-12 xl:px-24 px-12 sm:px-16 py-2 rounded-md font-bold text-primary-very-light border-2 border-white 
                hover:bg-gray-300 hover:text-black" @click.prevent="makeSubcribed(55, '6 Months')"
                >
                Subscribe
                </button>
            </article>
        </section>

        <section class="w-full">
            <div class="flex flex-col items-center mb-12 mt-6">
                <h1 class="font-bold text-3xl font-mono mb-2">Status of Your Subcription</h1>
                    <div class="content-2 flex space-x-2  items-center">
                       <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b- rounded-lg shadow-xl p-5 w-full" 
                       :class="{'border-blue-500': DueDate == false,  
                       'border-red-500': DueDate == true}" >
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600" 
                                    v-if="DueDate == false">
                                        <i class="fas fa-check fa-2x fa-inverse" 
                                        ></i>
                                    </div>
                                    <div class="rounded-full p-5 bg-red-600" v-else>
                                        <i class="fas fa-thumbs-down fa-2x fa-inverse" 
                                        ></i>
                                    </div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h5 class="font-bold uppercase text-gray-600" 
                                    v-if="DueDate == false"
                                    >Subcribed</h5>
                                    <h5 class="font-bold uppercase text-gray-600" 
                                    v-else>Expired/Will Expired Subcribed</h5>
                                    <h3 class="font-bold text-3xl"></h3>
                                </div>
                            </div>
                        </div> 

                        <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5 w-full">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600" v-if="DueDate == false">
                                        <i class="fas fa-hourglass-end fa-2x fa-inverse"></i>
                                        </div>
                                    <div class="rounded-full p-5 bg-red-600" v-else>
                                        <i class="fas fa-hourglass-end fa-2x fa-inverse"></i>
                                    </div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h5 class="font-bold uppercase text-gray-600">Until</h5>
                                    <h5 class="font-bold text-gray-600" v-if="UntilWhenTime">{{ moment(UntilWhenTime).format('MMMM Do YYYY, h:mm:ss a') }}</h5>
                                    <h5 class="font-bold text-gray-600" v-else>-- --</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <button type="button" class="mt-5 p-2 bg-red-700 text-white rounded-lg text-lg font-mono hover:bg-red-600" 
                v-if="DueDate == false">Cancel Subcription</button>
                <label class="font-mono mt-2 text-lg">*Note: Cancelation of Subcription will not Refund. No Refund Policy Here.</label>
            </div>
        </section>
        <subcription-payment :PaymentModal="modal.PaymentModal" @closingModal="closingModal" :price="price"></subcription-payment>
    </div>
</template>

<script setup>
import { computed, reactive, ref } from "@vue/reactivity";
import { inject, onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
import SubcriptionPayment from "./SubcriptionPayment.vue";

    const store = useStore();
    const moment = inject("$moment");

    // const untilwhen = ref(computed(() => store.getters['payment/GET_UntilWhen']));
    const DuedateToday = ref(computed(() => store.getters['payment/GET_DuedateToday']));
    //const isSubcribed = ref(computed(() => store.getters['payment/GET_isSubcribed']));
    const DueDate = ref(computed(() => store.getters['payment/GET_Duedate']));
    const UntilWhenTime = ref(computed(() => store.getters['payment/GET_UntilWhenTime']));

    onMounted(() => {
        if(DueDate.value) {
            let Script = document.createElement("script");
            let Script2 = document.createElement("script");
            Script.setAttribute("src", "https://js.stripe.com/v3/");
            Script2.setAttribute("src", "https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch");
            document.head.appendChild(Script);
            document.head.appendChild(Script2); 
        } 
    });


    const modal = reactive({
        PaymentModal: false
    });

    const price = reactive({
        amount: 0.00,
        type: ''
    });

    const setAmount = (amount, type) => {
        price.amount = amount
        price.type = type
    }

    const makeSubcribed = (amount, type) => {
        modal.PaymentModal = true;
        setAmount(amount, type)
        
    }
    
    const closingModal = (modalname) => {
        modal[modalname] = false;
    }

</script>