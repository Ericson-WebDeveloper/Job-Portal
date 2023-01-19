<template>
    <div id="application-user" class="" v-if="applications.data">
         <div class="main-content bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Application</h3>
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
                                            Company
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job
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
                                        <template v-for="(application, index) in applications.data" :key="index">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <template v-if="application.job.company.detail && application.job.company.detail.image">
                                                           <img class="h-10 w-10 rounded-full" 
                                                        :src="application.job.company.detail.image" alt=""> 
                                                        </template>
                                                        
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                        {{ application.job.company.name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                        {{ application.job.company.address.substring(1, 20) }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ application.job.title }}</div>
                                                    <div class="text-sm text-gray-500">{{ application.job.position }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">

                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-lg p-1" 
                                                    :class="{ 'bg-indigo-100 text-indigo-800': application.status == 'review', 
                                                    'bg-green-100 text-green-800': application.status == 'accept',
                                                    'bg-blue-100 text-blue-800': application.status == 'select', 
                                                    'bg-red-100 text-red-800': application.status == 'reject',
                                                    'bg-yellow-100 text-yellow-800': application.status == null}">
                                                        {{ application.status == null ? 'standby' : application.status }}
                                                    </span>
                                                </td>
                                        
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                    <!-- <a href="javascript:void(0);" class="bg-indigo-600 p-2 rounded text-indigo-200 hover:text-indigo-900">Edit</a> -->
                                                    <a href="javascript:void(0);" @click="showDetails(application)" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
                                                    <!-- <a href="javascript:void(0);" class="bg-red-600 p-2 rounded text-red-200 hover:text-red-900">Delete</a> -->
                                                </td>
                                            </tr>
                                        </template>
                                        
          
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination This example requires Tailwind CSS v2.0+ -->
                                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" 
                                v-if="applications.data && applications.data.length > 0">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                        </a>
                                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Next
                                        </a>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                        <p class="text-sm text-gray-700" >
                                            Showing
                                            <span class="font-medium">
                                                {{ (applications.to - applications.data.length) + 1 }}</span>
                                            to
                                            <span class="font-medium">{{ applications.to }}</span>
                                            of
                                            <span class="font-medium">{{ applications.total }}</span>
                                            results
                                        </p>
                                        </div>
                                        <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                            <!-- Heroicon name: solid/chevron-left -->
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                                                aria-hidden="true" v-if="applications.prev_page_url" @click.prevent="getApplications(parseInt(applications.current_page) - 1)">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                                            <template v-for="(p, index) in page1" :key="index">
                                                <a href="javascript:void(0);" @click.prevent="getApplications(p.page)" aria-current="page" class=" relative inline-flex items-center 
                                                px-4 py-2 border text-sm font-medium" :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : p.page == applications.current_page}">
                                                    {{ p.page }}
                                                </a>
                                            </template>
                                           
                                            <span class="relative inline-flex items-center px-4 py-2 border 
                                            border-gray-300 bg-white text-sm font-medium text-gray-700" v-if="page2.length > 0">
                                            ...
                                            </span>
                                             <template v-for="(p, index) in page2" :key="index">
                                                <a href="javascript:void(0);" @click.prevent="getApplications(p.page)" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden 
                                                md:inline-flex relative items-center px-4 py-2 border text-sm font-medium" 
                                                :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : p.page == applications.current_page}">
                                                   {{ p.page }}
                                                </a>
                                            </template>
                                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Next</span>
                                            <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5" v-if="applications.next_page_url" @click.prevent="getApplications(parseInt(applications.current_page) + 1)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </nav>
                                        </div>
                                    </div>
                                </div>
                                <!-- Pagination This example requires Tailwind CSS v2.0+ -->
                        </div>
                    </div>
                </div> 
            </div>
            


            <!-- Modal View Form -->
           <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[modalView ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Job Application</h1>
                        <svg @click="modalView = !modalView" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 overflow-y-auto">
                    <div class="m-auto">
                        <div>
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                                <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class=" inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>

                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Company</h1>
                                    </div>
                                </div>
                                <div class="px-5 pb-5">
                                    <img src="../../../public/images/download.png" class="mx-auto w-64 h-64" alt="">
                                    <input  placeholder="Name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                    <input  placeholder="Address" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                    <div class="w-full md:flex-grow md:w-2/4">
                                    <input placeholder="Industry" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Job Details</h1>
                                    </div>
                                    <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                </div>
                                <div class="px-5 pb-5">
                                    <input  placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                       
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Application Status</h1>
                                    </div>
                                    <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                </div>
                                <div class="px-5 pb-5">
                                    <input placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                                
                            </div>
                           
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="modalView = !modalView">Cancel</button>
                </div>
             </div>
           </div> -->
            <view-application :modalView="modalView" @closeModal="closeModalComp" :application="application"></view-application>
        </div>
    </div>
</template>


<script>
import {ref, onMounted, computed, inject} from 'vue'
import { useStore } from 'vuex';
import ViewApplication from '@/components/user/ViewApplication.vue';
import Pagination from '@/helper/Pagination'
import { useRoute, useRouter } from 'vue-router';
export default {
  components: { ViewApplication },
    setup() {
        let modalView = ref(false);
        
        const store = useStore();
        const SwalAlert = inject('$Swal');
        const router = useRouter();
        const route = useRoute();

        const applications = ref(computed(() => store.getters['application/GET_APPLICATIONS']));
        const application = ref(null);

        // const pages = ref([]);
        // const paginates = ref([]);
        const page1 = ref([]);
        const page2 = ref([]);

        onMounted(async() => {
            try {
                store.commit("Loading", true);
                let page = route.query.page ? route.query.page : null;
                await getApplications(page);
            } catch (error) {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Get Applications History data',
                    showConfirmButton: true,
                });
            } finally {
                store.commit("Loading", false);
            }
        });

        // const refreshPages = () => {
        //     applications.value.links.shift();
        //     applications.value.links.pop();
        //     pages.value = getPages(applications.value.links);
        //     paginates.value = grouping(pages.value);
        //     returnPages();
        // }

        const getApplications = async (page = null) => {
            await store.dispatch('application/GET_ALL_APPLICATION_HISTORY', page);
            if(page) {
                router.push({query: {page}});
            }
            // pages.value = [];
            // paginates.value = [];
            // page1.value = [];
            // page2.value = [];
            new Pagination(3, applications, page1, page2);
           // refreshPages();
        }

        // const returnPages = () => {
        //     let p = null;
        //     paginates.value.forEach((arr, index) => {
        //         if(arr.includes(applications.value.current_page)) {
        //             p = index;
        //         }
        //     });

        //     Array.from(paginates.value[p]).forEach((pa) => {
        //         page1.value.push({page:pa})
        //     });

        //     if(paginates.value[p + 2]) {
        //         // Array.from(paginates.value[p + 2]).forEach((pa) => {
        //         //     page2.value.push({page:pa})
        //         // });
        //         returnFormattedPage(paginates.value[p + 2], page2);
        //     } else {
        //         // Array.from(paginates.value[p + 1]).forEach((pa) => {
        //         //     page2.value.push({page:pa})
        //         // });
        //         if(paginates.value[p + 1]) {
        //            returnFormattedPage(paginates.value[p + 1], page2); 
        //         } else {
        //             page1.value = [];
        //             returnFormattedPage(paginates.value[p], page2);
        //             returnFormattedPage(paginates.value[p-1], page1); 
        //         }
        //     }
        // }   

        // const returnFormattedPage = (arrayData, pushdata) => {
        //     Array.from(arrayData).forEach((pa) => {
        //         pushdata.value.push({page:pa})
        //     });
        // }

        // const getPages = (datas) => {
        //     let pages = [];
        //     datas.forEach((element, index) => {
        //         pages.push(index+1);
        //     });
        //     return pages;
        // }

        // const grouping = (arr) => {
        //     const n = 3;
        //     let pagination = arr.reduce((r, e, i) =>
        //         (i % n ? r[r.length - 1].push(e) : r.push([e])) && r
        //     , []);
        //     return pagination;
        // }

        const closeModalComp = (modal) => {
            if(modal == "modalView") {
                modalView.value = false
                application.value = null;
            }
        }

        const showDetails = (appli) => {
            modalView.value = true;
            application.value = appli;
        }

        return { 
            modalView, applications, closeModalComp, application, showDetails, page1, page2, getApplications
        }
    }
}
</script>