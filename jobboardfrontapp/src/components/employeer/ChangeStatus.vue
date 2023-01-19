<template>
     <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[changingStatus ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Changing Status</h1>
                <svg @click.prevent="closeModal()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 ">
                <div class="mx-auto">
                    <div class="">
                
                        <div class="mt-2 bg-white rounded-lg shadow">
                    
                            <div class="px-5 pb-5">
                                <h1 class="text-center text-2xl mb-3 font-serif font-bold">Changing Status of Application will notify the user. are you sure?</h1>
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4">
                                        <label for="email" class="block text-xl font-semibold text-gray-600">Specialization</label>
                                        <select v-model="statusApp" name="" id="" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                        focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                        focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            <option class="p-2 font-bold font-serif text-xl" value="" disabled>Select Status</option>
                                            <template v-for="(status, index) in status" :key="index">
                                                <option class="p-2 font-bold font-serif text-xl" :value="status">{{ status }}</option>
                                            </template>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="errors">

                            </div>
                        </div>

                    
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click.prevent="closeModal()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600" >Close</button>
                <button type="button" @click.prevent="submitChangeStatus" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { useStore } from 'vuex';
import { inject } from '@vue/runtime-core';
export default {
    props: {
        changingStatus: Boolean,
        data: Object
    },

    setup(props, {emit}) {
        const store = useStore();
        const SwalAlert = inject('$Swal');

        const status = ref(['review', 'select', 'accept', 'reject']);
        const appliData = ref(props.data);
        const statusApp = ref(props.data.value.status ?? '');

        const submitChangeStatus = async() => {
            try {

                if(statusApp.value == '' || statusApp.value.trim() == '') {
                    SwalAlert.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Select Status Please',
                        showConfirmButton: true,
                    });
                    return false
                }

                const data = {
                    status: statusApp.value,
                    email: appliData.value.user.email,
                    id: appliData.value.id,
                    job_id: appliData.value.job_id
                }

                store.commit("Loading", true);
                await store.dispatch('application/CHANGE_STATUS', data);
                SwalAlert.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updating Status Success',
                    showConfirmButton: true,
                }).then(() => {
                    closeModal();
                    window.location.reload(); 
                });
            } catch (error) {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Updating Status Failed',
                    showConfirmButton: true,
                });
            } finally {
                store.commit("Loading", false);
            }
        }

        const closeModal = () => {
            emit('closeModal', 'changingStatus')
        }

        return {
            status, closeModal, statusApp, submitChangeStatus
        }
    }
}
</script>