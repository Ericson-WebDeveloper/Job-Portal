<template>
  <div class="home">
    <keep-alive include="search">
      <component :is="selectedComp" :search="search"></component>
    </keep-alive><!-- <search-input :is="view" ></search-input> -->
    <div class="container mx-auto">
      <div class="content">
          <div id="job-content-list">
          <p class="mb-2 ml-12 text-lg font-serif" v-if="vacancy.data && vacancy.data.length > 0">
            <b>{{ (vacancy.to - vacancy.data.length) + 1  }}-{{ vacancy.to }}</b> of <b>{{ vacancy.total }}</b> jobs</p>
            <div class="flex lg:flex-row gap-4 h-screen"> <!-- flex-col -->
              
              <div class="w-full lg:w-2/5 items-center overflow-y-auto">
                <div class="flex flex-col"> <!-- max-h-full -->
                  <div class="mb-2 cursor-pointer" v-for="(job, index) in vacancy.data" :key="index" @click="showDetails(job.id)">
                    <div class="max-w-auto mx-4 rounded overflow-hidden shadow-lg p-2 border-l-8 border-green-800">
                      <img class="w-48" :src="(job.company.detail && job.company.detail.image) ? job.company.detail.image : '../../public/images/download.png'" alt="Sunset in the mountains">
                      <div class="px-6 py-4">
                        <div class="mb-2">
                          <router-link :to="{name: 'Job',params: {job: job.id}}" class="font-bold text-xl text-blue-500">{{ job.title }}</router-link> <br>
                          <router-link :to="{name:'Company', params:{company:`${job.company.id}-${job.company.name}`}}" class="">
                            <p class="font-bold hover:underline">{{ job.company.name }}</p>
                          </router-link> 
                          <!-- link to show job Details -->
                        </div>
                        <p class="text-gray-700 text-base">
                          {{ job.company.address ?? '' }}
                        </p>
                        <p class="text-gray-700 text-base">
                          {{ (job.detail && job.detail.salary) ?? 'N/A' }}
                        </p>
                        <br><br>
                        <p class="text-gray-700 text-base">
                          {{ moment(job.created_at).startOf('hour').fromNow() }}
                        </p>
                      </div>
                      <div class="px-6 pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                      </div>
                    </div>
                  </div>

                <div class="flex justify-center space-x-1 mt-5 mb-10" v-if="vacancy?.data">
                    <a href="javascript:void(0);" class="px-4 py-2 font-bold text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white" 
                    v-if="vacancy.prev_page_url" @click.prevent="getAllVacancysJobs(parseInt(vacancy.current_page) - 1)">
                        Previous
                    </a>
                    <template v-if="page1.data > 0">
                      <a href="javascript:void(0);" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white" 
                        v-if="(page1[0]?.page == vacancy.current_page) && vacancy.prev_page_url && ![1,2,3].includes(vacancy.current_page)" >
                            ...
                      </a>
                    </template>
                    
                    <template v-for="(page, index) in page1" :key="index">
                      <a href="javascript:void(0);" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white" 
                      @click.prevent="getAllVacancysJobs(page.page)" :class="{'z-10 bg-indigo-400 border-indigo-300 text-indigo-600' : page.page == vacancy.current_page}" 
                      >
                          {{ page.page }}
                      </a>
                    </template>
                    <template v-if="page1.data > 0">
                      <a href="javascript:void(0);" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white" 
                      v-if="page1[page1.length - 1].page == vacancy.current_page && vacancy.next_page_url" >
                          ...
                      </a>
                    </template>
                    <!-- <a href="#" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white">
                        2
                    </a>
                    <a href="#" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white">
                        3
                    </a> -->
                    <a href="javascript:void(0);" class="px-4 py-2 font-bold text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white" 
                    v-if="vacancy.next_page_url" @click.prevent="getAllVacancysJobs(parseInt(vacancy.current_page) + 1)" >
                        Next
                    </a>
                </div>

                </div>
              </div>
                                                                              <!-- :class="{'w-full mx-auto': !searchjobs?.data}" -->
              <div class=" lg:block lg:w-3/5 bg-gray-100 hidden overflow-y-auto" > <!-- flex flex-col -->
                <div class="content p-2">
                  <template v-if="!showJobData">
                    <div class="mx-auto justify-items-center flex flex-col" >
                        <img class="w-3/4 h-full mx-auto" src="http://localhost:3000/images/job-searching-700x400.jpg" alt="">
                        <h1 class="mx-auto text-2xl font-serif">We have {{ vacancy.total }} jobs for you</h1>
                        <h3 class="mx-auto text-lg font-serif">Select a job to view details</h3>
                    </div>
                  </template>
                  <template v-else>
                    <div id="content-job-details" >
                        <show-job :job="showJobData" :moment="moment" @closeJob="closeJob"></show-job>
                    </div>
                  </template>
                    
                    
                </div>
              </div>

            </div>
          </div>

      </div>
    </div>
    
  </div>
</template>

<script>
// @ is an alias to /src
import SearchInput from '@/components/SearchInput';
import { onMounted, reactive, ref, inject, computed} from 'vue';
import {useStore} from 'vuex';
import ShowJob from '@/components/ShowJob';
import Paginations from '@/helper/Paginations';
import { useRoute } from 'vue-router';
export default {
  name: 'Home',
  components: {
    SearchInput,
    ShowJob
  },

  setup() {
    const store = useStore();
    const route = useRoute();
    const search = reactive({
      keyword: '',
      location: '',
      specialization: ''
    });
    const moment = inject('$moment');
    const SwalAlert = inject('$Swal');
    const showJobData = ref(null);

    const vacancy = ref(computed(() => store.getters['jobs/GET_VACANCY_JOBS']))
    const selectedComp = ref('search-input');
    const page1 = ref([]);

    onMounted(async() => {
      
      search.specialization = route.query.specialization ? route.query.specialization.replaceAll("&", "-") : '' ;
      try {
          store.commit("Loading", true);
          await getAllVacancysJobs();        
      } catch (error) {
          SwalAlert.fire({
              position: 'center',
              icon: 'error',
              title: 'Cannot Connect to Server',
              showConfirmButton: true,
          });
      } finally {
          store.commit("Loading", false);
      }
    });

    const getAllVacancysJobs = async (page = null) => {
        closeJob();
        await store.dispatch('jobs/FETCH_VACANCY_JOBS',{page, specialization: search.specialization});
        new Paginations(3, vacancy, page1);
    }

    const showDetails = async id => {
        try {
          showJobData.value = null;
          store.commit("Loading", true);
          let job = await store.dispatch('jobs/FETCH_PUBLIC_JOB', id);
          showJobData.value = job;
        } catch (error) {
          SwalAlert.fire({
              position: 'center',
              icon: 'error',
              title: 'Unable to Show Details',
              showConfirmButton: true,
          });
        } finally {
          store.commit("Loading", false);
        }
    }

    const closeJob = () => {
      showJobData.value = null
    }
 
    return  {
      search, selectedComp, vacancy, moment, showDetails, showJobData, closeJob, page1, getAllVacancysJobs
    }
  }
}
</script>

