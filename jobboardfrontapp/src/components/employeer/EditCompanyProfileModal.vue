<template>
     <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[profileEdits ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Edit My Profile</h1>
                <svg xmlns="http://www.w3.org/2000/svg"  @click.prevent="closeModal2()" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                <img :src="(company.detail && company.detail.image) ? company.detail.image : 'http://localhost:3000/images/useravatar.png'" 
                                class="mx-auto w-64 h-64" >
                                <input  placeholder="Name" v-model="companys.name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                ring-offset-2 ring-gray-400">
                                <input placeholder="Address" v-model="companys.address" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            
                                <input placeholder="Industry" v-model="companys.industry" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            </div>
                            <div id="errors1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click.prevent="closeModal2()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Cancel</button>
                <button type="button" @click.prevent="UpdatingProfile()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, reactive, ref } from '@vue/reactivity';
import { onMounted } from '@vue/runtime-core';
import Error from '@/helper/errorHandler';
import {useStore}  from 'vuex'
export default {
    props: {
        profileEdit: Boolean,
        company: Object,
        SwalAlert: Function
    },

    setup(props, context) {
        const store = useStore();

        const companys = reactive({
            name: props.company.name,
            address:  props.company.address,
            industry: props.company.industry
        });

        const profileEdits = ref(computed(() => props.profileEdit ));

        const UpdatingProfile = async () => {
            let errorBox = document.getElementById("errors1");
            errorBox.innerHTML = '';
            try {
                store.commit("Loading", true);
                let data = {
                    id: props.company.id,
                    name: companys.name,
                    address: companys.address,
                    industry: companys.industry,
                }
                await store.dispatch('company/UPDATE_PROFILE_DATA', data);
                store.commit("Loading", false);
                props.SwalAlert.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Update Profile Success',
                    showConfirmButton: true,
                }).then(() => {
                    closeModal2();
                });
            } catch (error) {
                store.commit("Loading", false);
                Error.ErrorShow(errorBox, error, props.SwalAlert);
            }
        }

        onMounted(() => {
            // console.log(props.company)
        })
        const closeModal2 = () => {
            context.emit('closeModal2');
        }

        return {
            closeModal2, companys, UpdatingProfile, profileEdits
        }
    }
}
</script>