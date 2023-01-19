<template>
    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[profileEdit ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Edit My Profile</h1>
                <svg @click="closeModal()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer 
                hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 overflow-y-auto">
                <div class="m-auto">
                    <div>
                        <div class="mt-2 bg-white rounded-lg shadow">
                            <div class="flex">
                                <div class="flex-1 py-5 pl-5 overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" 
                                    viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 
                                        0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <h1 class="inline text-2xl font-semibold leading-none ml-2">Profile</h1>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <img :src="user.detail && user.detail.image ? user.image : 'http://localhost:3000/images/useravatar.png'" class="mx-auto w-64 h-64" alt="">
                                <input  placeholder="Name" v-model="user.name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 
                                ring-gray-400">
                                <!-- <input  placeholder="Address" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">  -->
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <input  placeholder="Email" v-model="user.email" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                        focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                        ring-offset-2 ring-gray-400">
                                    </div>
                                    <div class="w-full md:flex-grow md:w-2/4">
                                        <input placeholder="age" v-model="user.age" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                        focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                        ring-offset-2 ring-gray-400">
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <input  placeholder="Course" v-model="user.course" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                        focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                    <div class="w-full md:flex-grow md:w-2/4">
                                        <input placeholder="College" v-model="user.college" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                        focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                        ring-offset-2 ring-gray-400">
                                    </div>
                                </div>
                                <input placeholder="Address" v-model="user.address" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition 
                                    duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white 
                                    dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    
                                <div id="errors">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="closeModal()">Cancel</button>
                <button type="button" @click.prevent="UpdateProfile()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import {onMounted, reactive, ref} from 'vue';
import {useStore}  from 'vuex';
import Error from '@/helper/errorHandler';
export default {
    props: {
        profileEdit: Boolean,
        users: Object,
        Swal: Function
    },

    setup(props, context) {
        const profileEdits = ref(props.profileEdit);

        const user = reactive({
            name: props.users.name,
            email: props.users.email,
            age: props.users.detail && props.users.detail.age ? props.users.detail.age : 0,
            address: props.users.detail && props.users.detail.address ? props.users.detail.address : '',
            course: props.users.detail && props.users.detail.course ? props.users.detail.course : '',
            college: props.users.detail && props.users.detail.college ? props.users.detail.college : '',
            image: props.users.detail && props.users.detail.image ? props.users.detail.image : '',
            experience: props.users.detail && props.users.detail.experience ? props.users.detail.experience : [],
            current_job: props.users.detail && props.users.detail.current_job ? props.users.detail.current_job : '',
        });
        
        // const SwalAlert = ref(props.Swal);
        const store = useStore();

        onMounted(() => {
            
        });

        const closeModal = () => {
            context.emit('closeProfileEditModal')
        }

        const UpdateProfile = async () => {
            let errorBox = document.getElementById("errors");
            errorBox.innerHTML = '';
            try {
                store.commit("Loading", true);
                const data = {
                    name: user.name,
                    email: user.email,
                    age: user.age,
                    address: user.address,
                    college: user.college,
                    course: user.course,
                }
                await store.dispatch('user/UPDATE_PROFILE', data);
                await store.dispatch('auth/GET_USER');
                store.commit('Loading', false);
                props.Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Update Profile Success',
                    showConfirmButton: true,
                }).then(() => {
                    closeModal();
                });
            } catch (error) {
                store.commit("Loading", false);
                Error.ErrorShow(errorBox, error, props.Swal)
            }
        }

        return {
            profileEdits, closeModal, user, UpdateProfile
        }
    }
}
</script>