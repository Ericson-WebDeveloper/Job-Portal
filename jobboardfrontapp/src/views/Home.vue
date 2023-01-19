<template>
  <div class="home">
      <search-input :search="search"></search-input>
    <div class="container mx-auto mt-4">
      <div class="content">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 p-2 h-auto md:col-span-2">
              <h1 class="font-bold text-2xl ml-3">Top employeers</h1>
                <div class="p-5">
                  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                    <div class="hover:shadow-lg" v-for="(company, index) in companies.data" :key="index">
                      <div class="max-w-sm rounded overflow-hidden shadow-lg cursor-pointer" @click.prevent="viewCompany(company)">
                        <img class="object-cover w-full max-h-32" :src="company.detail.image" :alt="company.name">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="space-x-2">
              <div class="flex flex-col">
                <div class="bg-gray-50 mb-3 h-56 overflow-y-auto lg:overflow-hidden">
                  <div class="p-5">
                    <h1 class="font-bold text-2xl ml-3">Top Jobs</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <template v-for="(job, index) in jobs" :key="index">
                        <div class="mx-4 mt-2 shadow-md p-2" @click="viewJobs(job.title)">
                          <h3 class="text-sm font-serif text-green-400">{{job.title}}</h3>
                        </div>
                      </template>
                      
                    </div>
                  </div>
                  
                </div>
                <div class="bg-gray-50 mb-3 h-56 overflow-y-auto lg:overflow-hidden">
                  <div class="p-5">
                    <h1 class="font-bold text-2xl ml-3">Top Applicants</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <template v-for="(applicant, index) in applicants" :key="index">
                        <div class="mx-4 mt-2 shadow-md p-2">
                          <h3 class="text-sm font-serif text-blue-400">{{applicant.course}}</h3>
                        </div>
                      </template>                     
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- pagination -->
          <div class="flex justify-center mt-3">
            <a href="javascript:void(0);" v-if="companies.prev_page_url" class="flex items-center px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white" 
            disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </a>
            <div class="justify-items-center space-x-2 ml-3 mr-3">
              <select name="" id="" class="p-1 border-2 rounded-lg border-black w-20">
                <template v-for="(list, index) in companies.links" :key="index">
                  <option value="1" v-if="parseInt(list.label)">{{list.label}}</option>
                </template>
              </select>
              <span class=""> of {{ companies.last_page }}</span> 
            </div>
            <a href="javascript:void(0);" v-if="companies.next_page_url" class="px-4 py-2 text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
          </div>
          <!-- pagination -->

          <div class="bg-gray-50 mb-3 h-56 mt-5">

          </div>
      </div>
    </div>

  </div>
</template>

<script>
// @ is an alias to /src
import SearchInput from '@/components/SearchInput'
import {useRouter} from 'vue-router'
import { computed, reactive, ref} from '@vue/reactivity';
import {inject} from 'vue'
import { useStore } from 'vuex';
import { onBeforeMount, onMounted, onUnmounted } from '@vue/runtime-core';

export default {
  name: 'Home',
  components: {
    SearchInput
  },

  setup() {
    const router = useRouter();
    const SwalAlert = inject('$Swal');
    const store = useStore();
    const companies = ref(computed(() => store.getters['company/GET_COMPANIES']));
    const jobs = ref(computed(() => store.getters['GET_TOP_JOBS']));
    const applicants = ref(computed(() => store.getters['GET_TOP_APPLICANTS']));
    const search = reactive({
      keyword: '',
      location: '',
      specialization: ''
    });

    const selectedComp = ref('search-input');

    onBeforeMount(async () =>  {
      store.commit("Loading", true);
      await Promise.allSettled([store.dispatch('company/FETCH_ALL_COMPANIES'), store.dispatch('TOP_JOBS'),
      store.dispatch('TOP_APPLICATION')]).then((res) => {
        if(res[0].status != "fulfilled") {
          SwalAlert.fire({
            position: 'center',
            icon: 'error',
            title: 'Cannot Connect to Server to Fetch Top Companies'
          });
        } 
        if(res[1].status !== "fulfilled") {
          SwalAlert.fire({
            position: 'center',
            icon: 'error',
            title: 'Cannot Connect to Server to Fetch Top Jobs'
          });
        } 
        if(res[2].status !== "fulfilled") {
          SwalAlert.fire({
            position: 'center',
            icon: 'error',
            title: 'Cannot Connect to Server to Fetch Top Applicants'
          });
        } 
      }).catch(() => {
        SwalAlert.fire({
          position: 'center',
          icon: 'error',
          title: 'Cannot Connect to Server',
          showConfirmButton: true,
        });
      });
      store.commit("Loading", false);
    });

    onUnmounted(() => {
      companies.value = [];
      jobs.value = [];
      applicants.value = [];
       
      search.keyword = '',
      search.location = '',
      search.specialization = ''
    });
    
    onMounted(async () => {
     
      // try {
      //   store.commit("Loading", true);
      //   await store.dispatch('company/FETCH_ALL_COMPANIES');
      // } catch (error) {
      //   SwalAlert.fire({
      //     position: 'center',
      //     icon: 'error',
      //     title: 'Companies Data Not Found',
      //     showConfirmButton: true,
      //   }).then(() => {
      //     console.log('Cannot Connect to Server');
      //   });
      // } finally {
      //   store.commit("Loading", false);
      // }
    });


    const newLinks = () => {
      companies.value.links.shift();
      companies.value.links.pop();
      return companies.value;
    }

    const viewJobs = (title) => {
      let routeName = `${title.replace(/\s/g, '-')}-jobs`;
      console.log(routeName);
      router.push({name:'searchjob', params: {key: routeName} });
    }

    const viewCompany = (company_data) => {
      router.push({name: 'Company', params: {company: `${company_data.id}-${company_data.name}` }});
    } 

    const newList = (links) => {
      links.shift();
      links.pop();
      return links;
    }

    return { viewCompany, companies, newList, newLinks, search, selectedComp, jobs, applicants, viewJobs}
  }
}
</script>
