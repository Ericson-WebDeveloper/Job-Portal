<template>
    <div id="home-user" class="t-0">
        <div id="nav-bar"> 
            <nav class="flex items-center justify-between flex-wrap bg-green-400 p-6" ref="showTopNav">
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <svg @click="redirect" class="fill-current h-8 w-8 mr-2 cursor-pointer" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
                    <span @click="redirect" class="font-semibold text-xl tracking-tight cursor-pointer">Laravel Job Finder</span>
                </div>
                <div class="flex items-center space-x-2">
                    <UserDropDown :user="user" />
                    <div class="block lg:hidden">
                        <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 focus:outline-none focus:bg-gray-700 hover:text-white hover:border-white " 
                        ref="burgerbtn">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                            ><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                        </button>
                    </div>
                </div>
                
                    <!-- select navbar -->
                    <!-- <div>
                        <button id="dropdownButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                        focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">user Name
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="dropdown" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700">
                            <ul class="py-1" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="javascript:void(0);" class="block px-4 py-2 text-sm 
                                    text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 
                                    dark:hover:text-white">Sign out</a>
                                </li>
                            </ul>
                        </div> 
                    </div> --> 
                    <!-- end select navbar -->
            </nav>
            
        </div>
        <div class="relative h-auto flex">
            <!-- mobile -->
            <!-- sidebar -->
            <div ref="sidebarmenu" class="bg-green-700 tex-white w-80 space-y-6 py-5 px-4 
            absolute inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0  
              transition duration-300 ease-in-out">
                <a href="javascript:void(0);" class="flex space-x-2 items-center px-4">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-100" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                    </svg>
                    <span class="text-gray-100 text-2xl font-bold">Name of Employeer</span>
                </a>
                <nav class="text-gray-100">
                    <router-link :to="{name: 'Employeer-Dashboard'}" class="block py-2.5 px-4 text-2xl font-semibold font-mono rounded-lg
                     transition duration-200 hover:bg-yellow-300 hover:text-black">Home</router-link>
                    <router-link :to="{name: 'Employeer-Profile'}" class="block py-2.5 px-4 text-2xl font-semibold font-mono rounded-lg 
                    transition duration-200 hover:bg-yellow-300 hover:text-black">Profile</router-link>
                    <router-link :to="{name: 'Employeer-Company'}" class="block py-2.5 px-4 text-2xl font-semibold font-mono rounded-lg
                     transition duration-200 hover:bg-yellow-300 hover:text-black">Company</router-link>
                    <router-link :to="{name: 'Employeer-Jobs'}" class="block py-2.5 px-4 text-2xl font-semibold font-mono rounded-lg 
                    transition duration-200 hover:bg-yellow-300 hover:text-black">Job</router-link>

                    
                    <router-link :to="{name: 'Employeer-Subcription'}" class="block py-2.5 px-4 text-2xl font-semibold font-mono rounded-lg 
                    transition duration-200 hover:bg-yellow-300 hover:text-black">Subcription</router-link>
                </nav>
            </div>

            <!-- content -->
            <!-- max-h-screen -->
            <div class="flex-1 h-auto">
                <router-view></router-view>
            </div>

        </div>
    </div>
</template>

<script>
import {ref, onMounted, computed} from 'vue';
import UserDropDown from '@/components/UserDropDown'
import { useStore } from 'vuex';
export default {
    components: {
        UserDropDown
    },
    setup() {
        const burgerbtn = ref(null);
        const sidebarmenu = ref(null);
        const store = useStore();

        const user = ref(computed(() => {
            return store.getters['user/GET_USER_DATA'];
        }));

        onMounted(async () => {
            burgerbtn.value.addEventListener("click", (e) => {
                e.preventDefault();
                sidebarmenu.value.classList.toggle('-translate-x-full')
            });
        });

        const redirect = () => {
            window.location.href = '/'
        }

        return  {
            burgerbtn, sidebarmenu, user, redirect
        }
    }
}
</script>

<style scoped>
.router-link-exact-active {
  background-color: #FCD34D;
  color: black;
}
</style>