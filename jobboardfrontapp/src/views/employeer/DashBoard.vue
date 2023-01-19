<template>
    <div id="home" class="flex h-screen">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">DashBoard</h3>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                     <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-file fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Total New Application</h5>
                                <h3 class="font-bold text-3xl">{{ new_appli }} <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-briefcase fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Total Job Post Active</h5>
                                <h3 class="font-bold text-3xl">{{ active_jobs }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-briefcase fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Total Job Post</h5>
                                <h3 class="font-bold text-3xl">{{ total_jobs }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-thumbs-up fa-2x fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-600">Subcription</h5>
                                <h3 class="font-bold text-3xl">{{ untilwhen ? moment(untilwhen).format('MMMM Do YYYY') : 'Not Subcribed' }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
             
            </div>
        </div>
    </div>
</template>

<script>
import { computed, inject, onMounted, ref} from 'vue'
import { useStore } from 'vuex';
import Error from '@/helper/errorHandler';
export default {
  setup() {
    const store = useStore();
    const company = ref(computed(() => {
            return store.getters['company/GET_COMPANY'];
    }));
    const SwalAlert = inject('$Swal');
    const moment = inject("$moment");
    const active_jobs = ref(0);
    const total_jobs = ref(0);
    const new_appli = ref(0);

    const untilwhen = ref(computed(() => store.getters['payment/GET_UntilWhen']));

    onMounted(async () => {
        try {
            store.commit("Loading", true);
            await store.dispatch('company/FETCH_COMPANY_DATA');
            await Promise.allSettled([store.dispatch('jobs/TOTAL_ACTIVES', company.value.id), store.dispatch('jobs/TOTAL_POST', company.value.id), 
            store.dispatch('application/GET_NEW_APPLICATIOn', company.value.id)])
            .then((res) => {
                if(res[0].status == "fulfilled") {
                    active_jobs.value = res[0].value
                } 

                if(res[1].status == "fulfilled") {
                    total_jobs.value = res[1].value
                } 

                 if(res[2].status == "fulfilled") {
                    new_appli.value = res[2].value.applications_count
                } 

            }).catch(() => console.log('Error'));
        } catch (error) {
            Error.ErrorShow('', error, SwalAlert);
        } finally {
            store.commit("Loading", false);
        }
        
    });

    
    return { 
      active_jobs, total_jobs, new_appli, untilwhen, moment
    }
  }
}
</script>