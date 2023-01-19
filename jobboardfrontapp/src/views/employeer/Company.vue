<template>
    <div id="home" class="flex h-auto">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5" v-if="company">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Company Profile</h3>
                </div>
            </div>

        <!-- https://tailwindcomponents.com/component/profile-page -->
            <div class="container mx-auto my-5 p-5 h-auto">
                <div class="md:flex no-wrap md:-mx-2">
                    <!-- Left Side -->
                    <div class="w-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div class="image overflow-hidden">
                                <img class="h-auto w-full mx-auto" @click.prevent="EditImageProfile()"
                                    :src="(company.detail && company.detail.image) ? company.detail.image : 'http://localhost:3000/images/download.png'"
                                    alt="">
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">Company Name: {{company.name}}</h1>
    
                            <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                            class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Since</span>
                                    <span class="ml-auto">{{moment(company.created_at).format('MMMM Do YYYY')}}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- End of profile card -->
                        <div class="my-4"></div>

                    </div>
                    <!-- Right Side -->
                    <div class="w-full md:w-9/12 mx-2">
                        <!-- Profile tab -->
                        <div class="flex flex-col">

                            <!-- About Section -->
                            <div class="bg-white p-3 shadow-sm rounded-sm w-full">
                                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide">About</span>
                                </div>
                                <div class="text-gray-700">
                                    <div class="grid md:grid-cols-2 text-sm">
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Name</div>
                                            <div class="px-4 py-2">{{company.name}}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">address</div>
                                            <div class="px-4 py-2">{{company.address}}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Industry</div>
                                            <div class="px-4 py-2">{{company.industry}}</div>
                                        </div>
                                    </div>
                                </div>
                                <button @click.prevent="editProfile()"
                                    class="block w-full text-blue-800 text-sm font-semibold rounded-lg 
                                    hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">
                                    Edit About Data</button>
                            </div>
                            <!-- End of about section -->

                            <div class="my-4"></div>
                            <!-- Experience and education -->
                            <div class="mt-4 bg-white p-3 shadow-sm rounded-sm w-full h-auto">
                                <div class="flex flex-col">
                                    <!-- <div> -->
                                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Company Overview</span>
                                    </div>
                                    <div id="overview h-96"  v-if="company.detail && company.detail.company_overview">
                                        <span v-html="company.detail.company_overview"></span>
                                    </div>
                                    <hr>
                                    <!-- </div> -->
                                    <div class="mt-4">
                                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                            <span clas="text-green-500">
                                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path fill="#fff"
                                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                </svg>
                                            </span>
                                            <span class="tracking-wide">Additional Info</span>
                                        </div>
                                        <div id="additional_info" v-if="company.detail && company.detail.additional_info">
                                            <ul class="list-inside space-y-2" v-for="(info, index) in company.detail.additional_info" :key="index">
                                                <li>
                                                    <div class="text-teal-600">{{ info.name }}</div>
                                                    <div class="text-gray-500 text-xs">{{ info.value }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <button @click.prevent="EditOverviewInfo()"
                                            class="block w-full text-blue-800 text-sm font-semibold rounded-lg
                                            hover:bg-gray-100 focus:outline-none focus:shadow-outline 
                                            focus:bg-gray-100 hover:shadow-xs p-3 my-4">
                                            Edit Additional Data</button>
                                    </div>
                                </div>
                                <!-- End of Experience and education grid -->
                            </div>
                            <!-- End of profile tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Edit Profile Form -->
           <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[profileEdit ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit My Profile</h1>
                        <svg @click="profileEdit = !profileEdit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="p-3 overflow-y-auto">
                        <div class="m-auto">
                            <div>
                        
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
                                        <img src="../../../public/images/download.png" class="mx-auto w-64 h-64" alt="">
                                        <input  placeholder="Name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        <div class="flex flex-col md:flex-row">
                                            <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                                <input  placeholder="Email" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                            <div class="w-full md:flex-grow md:w-2/4">
                                                <input placeholder="age" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                                <input  placeholder="Course" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                            <div class="w-full md:flex-grow md:w-2/4">
                                                <input placeholder="College" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                        </div>
                                        <input  placeholder="Job" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                        <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="profileEdit = !profileEdit">Cancel</button>
                        <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                    </div>
                </div>
           </div> -->

        
           <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[jobExpEdit ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit My Job Experience:</h1>
                        <svg @click="jobExpEdit = !jobExpEdit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 overflow-y-auto">
                    <div class="m-auto">
                        <div>
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                                 <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
          
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Job Experience</h1>
                                    </div>
                                    <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                </div>
                                <div class="px-5 pb-5">
                                    <input  placeholder="Current Job" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                            <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="Company" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="jobExpEdit = !jobExpEdit">Cancel</button>
                    <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                </div>
             </div>
           </div> -->

            <!-- <span v-if="company">  -->
                <edit-company-profile-modal v-if="profileEdit"
                :profileEdit="profileEdit" @closeModal2="editProfile" :company="company" :SwalAlert="SwalAlert">
                </edit-company-profile-modal>
                <edit-company-overview-modal v-if="overview_info" :overview_info="overview_info" @closeModal1="EditOverviewInfo" :company="company" 
                :SwalAlert="SwalAlert"></edit-company-overview-modal>
                <edit-company-image v-if="imageEdit" :imageEdit="imageEdit" @closeimagemodal="EditImageProfile" 
                :company="company" :SwalAlert="SwalAlert"></edit-company-image>
            <!-- </span> -->
            
    </div>
</template>


<script>
import {computed, onMounted, ref, inject} from 'vue';
import {useStore} from 'vuex';
import EditCompanyOverviewModal from '@/components/employeer/EditCompanyOverviewModal';
import EditCompanyProfileModal from '@/components/employeer/EditCompanyProfileModal';
import EditCompanyImage from '../../components/employeer/EditCompanyImage';
export default {
    components: {
        EditCompanyOverviewModal,
        EditCompanyProfileModal,
        EditCompanyImage
    },
    setup() {
        const profileEdit = ref(false);
        const overview_info = ref(false);
        const imageEdit = ref(false);

        const store = useStore();
        const SwalAlert = inject('$Swal');
        const moment = inject('$moment');

        const company = ref(computed(() => {
            return store.getters['company/GET_COMPANY'];
        }));

        onMounted(async() => {
            try {
                store.commit("Loading", true);
                await store.dispatch('company/FETCH_COMPANY_DATA');
            } catch (error) {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Company Data Fetch Failed',
                    showConfirmButton: true,
                });
            } finally {
                store.commit("Loading", false);
            }
            
        });

        const editProfile = () => {
            profileEdit.value = !profileEdit.value
        }

        const EditOverviewInfo = () => {
            overview_info.value = !overview_info.value
        }

        const EditImageProfile = () => {
            imageEdit.value = !imageEdit.value
        }

        return {
            profileEdit, editProfile, overview_info, EditOverviewInfo, company, moment, SwalAlert, imageEdit, EditImageProfile
        }
    }
}
</script>

