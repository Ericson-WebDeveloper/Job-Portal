<template>
    <div id="home" class="flex">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Users</h3>
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
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Course
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
                                        <!-- <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">BSHR</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                User
                                                </span>
                                            </td>
                                     
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="javascript:void(0);" @click="modalView = !modalView" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">BSCS</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Employeer
                                                </span>
                                            </td>
                                     
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="javascript:void(0);" @click="modalView = !modalView" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
                                            </td>
                                        </tr> -->

                                        <user v-for="(user, index) in users.data" :key="index" :user="user"></user>

                                        <!-- <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">BSIT</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                User
                                                </span>
                                            </td>
                                     
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <router-link :to="{name: 'User-View', params: {userid: 1}}" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</router-link>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                
                            </div>
                                <div class="container flex justify-center mx-auto mt-3">
                                    <!-- <ul class="flex">
                                        <li v-for="(link, index) in users.users.links" :key="index">
                                            <span v-if="link.label.includes('Previous')">
                                                <button :disabled="!users.prev_page_url" class="h-10 px-5 text-gray-600 bg-white border border-r-0 
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
                                                <button :disabled="!users.next_page_url" class="h-10 px-5 text-gray-600 bg-white border border-gray-600 
                                                hover:bg-gray-100" >
                                                    Next
                                                </button>
                                            </span>
                                            
                                        </li>
                                    </ul> -->
                                </div>
                                <paginate :Datas="users" :page1="page1" :page2="page2" @nextPage="getusers"></paginate>
                                
                        </div>
                    </div>
                </div> 
            </div>

        </div>

    </div>
</template>

<script>
import { computed, onMounted, inject, ref } from 'vue';
import User from '@/components/admin/User'
import { useStore } from 'vuex';
import Paginate from '@/components/Paginate.vue';
import Pagination from '@/helper/Pagination';
import { useRoute, useRouter } from 'vue-router';
export default {

    components: {
        User,
        Paginate
    },

    setup() {
        const store = useStore();
        const Swal = inject('$Swal');
        const users = ref(computed(() => store.getters['user/GET_USERS_DATA']));

        const page1 = ref([]);
        const page2 = ref([]);

        const route = useRoute();
        const router = useRouter();

        const next = async (url) => {
            await getusers(url);
        }

        const getusers = async(url = null) => {
            try {
                store.commit("Loading",  true);
                await store.dispatch('user/GET_ALL_USERS', {url});
                if(url) {
                    router.push({query: {page: url}});
                }
                new Pagination(3, users, page1, page2);
            } catch (error) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Get Users Data',
                });
            } finally {
                store.commit("Loading",  false);
            }
        }

        onMounted( async () => {
            let page = route.query.page ? route.query.page : null;
            await getusers(page);
        });

        return { 
        users, next, page1, page2, getusers
        }
    }
}
</script>