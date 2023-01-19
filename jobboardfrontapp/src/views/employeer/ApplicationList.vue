<template>
    <div id="home" class="flex">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Jobs Apllications List</h3>
                </div>
            </div>

           <!-- This example requires Tailwind CSS v2.0+ https://tailwindui.com/components/application-ui/lists/tables -->
            <div class="min-h-screen">
                <div class=" p-5"> 
                    <div class="-my-2 overflow-x-auto lg:overflow-x-hidden sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User/Applicant
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Message
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <template v-if="applications.data">
                                           <application v-for="(application, index) in applications.data" :key="index" :application="application"
                                        @ShowChangeModal="ShowChangeModal" @ShowViewModal="ShowViewModal" @ShowCVModal="ShowCVModal"></application> 
                                        </template>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Paginations -->
                             <paginate :Datas="applications" :page1="page1" :page2="page2" @nextPage="nextPages"></paginate>
                        <!-- End Paginations -->
                    </div>
                </div> 
                <!-- Change Modal Status -->    
                <template v-if="applicationChange">
                    <change-status :changingStatus="modal.changingStatus" :data="applicationChange" @closeModal="closeModal"></change-status>
                    <view-application :ShowApplication="modal.ShowApplication" :application="applicationChange" @closeModal="closeModal"></view-application>
                </template>
                <template v-if="modal.ShowCV">
                    <view-user-cv :ShowCV="modal.ShowCV" :application="applicationChange" @closeModal="closeModal"></view-user-cv>
                </template>
                <!-- Change Modal Status -->
            </div>
        </div>
        </div>
</template>

<script>
import { ref, inject, computed} from 'vue';
import Application from './Application.vue';
import { useStore } from 'vuex';
import {useRoute, useRouter} from 'vue-router';
import { onMounted, reactive } from '@vue/runtime-core';
import Pagination from '@/helper/Pagination';
import Paginate from '@/components/Paginate.vue';
import ChangeStatus from '../../components/employeer/ChangeStatus.vue';
import ViewApplication from '../../components/employeer/ViewApplication.vue';
import ViewUserCv from '../../components/employeer/ViewUserCv.vue';
export default {
  components: { Application, Paginate, ChangeStatus, ViewApplication, ViewUserCv },

  setup() {
        const store = useStore();
        const route = useRoute();
        const router = useRouter();

        const modal = reactive(({
            changingStatus: false,
            ShowApplication: false,
            ShowCV: false
        }))
    
        const applicationChange = ref(null);

        const page1 = ref([]);
        const page2 = ref([]);
        const applications = ref(computed(() => store.getters['application/GET_JOB_APPLICATIONS']));

        const SwalAlert = inject('$Swal');

        onMounted(async () => {
            let page = route.query.page ? route.query.page : null;
            await FetchAllApplications(page);
        });

        const nextPages = async (page) => {
            await FetchAllApplications(page);
            if(page) {
                router.push({query: {page}});
            }
        }

        const FetchAllApplications = async (page = null) => {
            try {
                store.commit("Loading", true);
                await store.dispatch('application/GET_JOBS_APPLICATIONS', {page, job_id: route.params.job_id});
                if(page) {
                    router.push({query: {page}});
                }
                new Pagination(3, applications, page1, page2);
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
        }       

        const ShowChangeModal = (app) => {
            modal.changingStatus = true
            applicationChange.value = app;
        }

        const ShowViewModal = (app) => {
            modal.ShowApplication = true
            applicationChange.value = app;
        }

        const ShowCVModal = (app) => {
            modal.ShowCV = true
            applicationChange.value = app;
        }

        const closeModal = (modalName) => {
            modal[modalName] = false;
            applicationChange.value = null;
        }

      return {
            applications, page1, page2, ShowChangeModal, 
            applicationChange, closeModal, modal, ShowViewModal, ShowCVModal, nextPages
      }
  }
    
}
</script>