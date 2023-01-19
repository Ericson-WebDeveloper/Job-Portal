<template>
    <div id="home" class="flex">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Employeers</h3>
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
                                            Person
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subcription
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <employeer-comp v-for="(employeer, index) in employeers.data" :key="index" :employeer="employeer"
                                        @viewEmployeer="viewEmployeer" @changeStatus="updateAccount"></employeer-comp>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Old Pagination -->
                            <!-- <div class="container flex justify-center mx-auto mt-3">
                                <ul class="flex">
                                    <li v-for="(link, index) in employeers.links" :key="index">
                                        <span v-if="link.label.includes('Previous')">
                                            <button :disabled="!employeers.prev_page_url" class="h-10 px-5 text-gray-600 bg-white border border-r-0 
                                            border-gray-600 hover:bg-gray-100" >
                                                Previous
                                            </button> 
                                        </span>
                                        <span v-if="!link.label.includes('Next') && !link.label.includes('Previous')">
                                            <button @click="next(link.label)" class="h-10 px-5 text-gray-600 bg-white border border-r-0 border-gray-600">
                                                {{ link.label }}
                                            </button>
                                        </span>
                                        <span v-if="link.label.includes('Next')">
                                            <button :disabled="!employeers.next_page_url" class="h-10 px-5 text-gray-600 bg-white border border-gray-600 
                                            hover:bg-gray-100" >
                                                Next
                                            </button>
                                        </span>
                                        
                                    </li>
                                </ul>
                            </div> -->
                            <paginate :Datas="employeers" :page1="page1" :page2="page2" @nextPage="getemployeers"></paginate>
                        </div>
                    </div>
                </div> 
            </div>

        </div>



            <!-- View Employeer -->
            <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
                :class="[employeerView ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Employeer Profile</h1>
                        <svg @click="employeerView = !employeerView" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 " v-if="user">
                    <div class="mx-auto">
                        <div class="">
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                                <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Profile</h1>
                                    </div>
                                </div>
                                <div class="px-5 pb-5">
                                    <img :src="(user.detail && user.detail.image) ? user.detail.image : 'http://localhost:3000/images/useravatar.png'" class="mx-auto w-64 h-64" alt="">
                                    <input  placeholder="Name" v-model="user.name" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 
                                    focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none 
                                    focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                            <input placeholder="Email" v-model="user.email" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="age" :value="(user.detail && user.detail.age) ? user.detail.age : 0 " class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 
                                            focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                            ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                            <input  placeholder="Course" :value="(user.detail && user.detail.course) ? user.detail.course : 'N/A' " class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="College" :value="(user.detail && user.detail.college) ? user.detail.college : 'N/A' " class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>
                            
                                    <button @click.prevent="viewProfile()" class="bg-blue-500 p-2 rounded  w-full px-4 py-2.5 mt-2 text-white 
                                    hover:bg-blue-600">View Full Information</button>
                                </div>
                            </div>

                            <div class="mt-2 bg-white rounded-lg shadow" v-if="user.company"> 
                                <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Company</h1>
                                    </div>
                                </div>
                                <div class="px-5 pb-5">
                                     <img :src="(user.company && user.company.detail && user.company.detail.image) ? user.company.detail.image : 'http://localhost:3000/images/download.png'" class="mx-auto w-64 h-64" alt="">
                                    <input  placeholder="Company Name" :value="user.company.name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400">
                                    <input  placeholder="Address" :value="user.company.address" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400">

                                    <input  placeholder="Industry" :value="user.company.industry" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400">
                                    
                                    <div class="mt-2" v-if="user.company.detail && user.company.detail.company_overview">
                                        <QuillEditor v-model:content="user.company.
                                    detail.company_overview" height="1000" theme="snow" toolbar="full" contentType="html" 
                                         /> 
                                    </div>

                                    <template v-if="user.company.detail && user.company.detail.additional_info">
                                    <div class="flex flex-col md:flex-row mt-3" v-for="(info, index) in user.company.
                                    detail.additional_info" :key="index">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2" >
                                            <input  placeholder="Name"  v-model="info.name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                            focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                            ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="Value"  v-model="info.value" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                            focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                            ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>
                                    </template>
                                    
                                </div>
                            </div> 
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="employeerView = !employeerView">Cancel</button>
                    <!-- <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button> -->
                </div>
             </div>
           </div>


           <!-- Activate/Deactive Employeer -->
            <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[activateView ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Activate/Deactivate Employeer Account</h1>
                        <svg @click="activateView = !activateView" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="p-3 ">
                        <div class="mx-auto">
                            <div class="">
                                <div class="mt-2 bg-white rounded-lg shadow">
                                    <div class="flex">
                                        <div class="flex-1 py-5 pl-5 text-center overflow-hidden">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg> -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" 
                                            viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 
                                                2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 
                                                0 0118 0z" />
                                            </svg>
                                            <h1 class="inline text-2xl font-semibold leading-none ml-2">
                                                are you sure to {{ statusType }} this account? with an email of {{ selectedEmployee }} </h1>
                                        </div>
                                    </div>
                                    <div id="errors1"></div>
                                    <!-- <div class="px-5 pb-5">
                                        <label for="">are you sure?</label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                        <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="activateView = !activateView">Cancel</button>
                        <button @click="updatingStatus()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                    </div>
                </div>
           </div>




    </div>
</template>

<script>
import {ref, onMounted, inject, computed} from 'vue';
import {useRoute, useRouter} from 'vue-router';
import EmployeerComp from '@/components/admin/EmployeerComp';
import {useStore} from 'vuex'
import Paginate from '../../components/Paginate.vue';
import Pagination from '@/helper/Pagination';
export default {
    components: {
        EmployeerComp,
        Paginate
    },
    setup() {
        const employeerView = ref(false);
        const activateView = ref(false);
        const router = useRouter();
        const route = useRoute();
        const store = useStore();
        const Swal = inject("$Swal");

        const employeers = ref(computed(() => {
            return store.getters['user/GET_EMPLOYEERS_DATA']
        }));

        const page1 = ref([]);
        const page2 = ref([]);

        let selectedEmployee = ref(null);

        const user = ref({});
        const statusType = ref('activate/deactivate');

        const getemployeers = async(url = null) => {
            try {
                store.commit("Loading",  true);
                await store.dispatch('user/FETCH_EMPLOYEERS', {url});
                if(url) {
                    router.push({query: {page: url}});
                }
                new Pagination(3, employeers, page1, page2);
            } catch (error) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Get Employeers Data',
                });
            }finally {
                store.commit("Loading",  false);
            }
        }

        onMounted( async() => {
            let page = route.query.page ? route.query.page : null;
            await getemployeers(page);
        });


        const updatingStatus = async() => {
            let errorBox = document.getElementById("errors1");
            errorBox.innerHTML = '';
            try {
                if(!statusType.value && !selectedEmployee.value) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Employeer Select Failed',
                    });
                }
                store.commit("Loading", true);
                const data = {
                    email: selectedEmployee.value,
                    type: statusType.value
                };

                await store.dispatch('user/ACTIVATE_DEACTIVATE', data);
                store.commit("Loading", false);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Employeer Account '+ statusType.value,
                });
                selectedEmployee.value = null;
                activateView.value = !activateView.value;
                statusType.value = 'activate/deactivate';
                await getemployeers(null);
            } catch (error) {
                store.commit('Loading', false);
                Error.ErrorShow(errorBox, error, Swal);
            }
        }

        const updateAccount = ({type, email}) => {
            statusType.value = type;
            selectedEmployee.value = email;
            
            activateView.value = !activateView.value;
        }

        const viewEmployeer = async (email) => {
            selectedEmployee.value = email;
            try {
                store.commit("Loading", true);
                user.value = await store.dispatch('user/FETCH_USER', {email});
                
                employeerView.value = !employeerView.value
            } catch (error) {
               
                store.commit("Loading", false);
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Found Employeer Data',
                });
            } finally {
                store.commit("Loading", false);
            }
        }

        const viewProfile = () => {
            if(employeerView.value && selectedEmployee.value) {
                router.push({name: 'User-View', params: {email: selectedEmployee.value} }); 
            }
        }

        return { 
            employeerView, viewEmployeer, activateView, updateAccount, viewProfile, 
            employeers, user, statusType, updatingStatus, selectedEmployee,
            page1, page2, getemployeers
        }
  }
}
</script>