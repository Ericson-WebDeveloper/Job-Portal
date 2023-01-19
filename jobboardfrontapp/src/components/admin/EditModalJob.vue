<template>
    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[jobExpEdit ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Edit My Job Experience:</h1>
                <svg @click="closeModalJob()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <input  placeholder="Current Job" v-model="user.current_job" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                            focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 
                            ring-gray-400">
                            <button @click.prevent="AddNewField()" class="bg-green-500 p-2 rounded text-white hover:bg-green-600">Add Experience</button>
                            <div class="flex flex-col md:flex-row" v-for="(exp, index) in user.experience" :key="index">
                                <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                    <input  placeholder="Position" v-model="exp.position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400"></div>
                                <div class="w-full md:flex-grow md:w-2/4">
                                    <input placeholder="Company" v-model="exp.company" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition 
                                    duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white 
                                    dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                <svg xmlns="http://www.w3.org/2000/svg" @click.prevent="RemoveField(index)" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div id="errors1">

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
            <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="closeModalJob()">Cancel</button>
            <button type="button" @click.prevent="UpdatingJob()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
        </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref} from 'vue';
import {useStore} from 'vuex';
import Error from '@/helper/errorHandler';

export default {
    props: {
        jobExpEdit: Boolean,
        users: Object,
        Swal: Function
    },
    setup(props, context) {
        const jobExpEdits = ref(props.jobExpEdit);
        // let user = ref(props.users);
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

        const closeModalJob = () => {
            context.emit('closeModalJob');
        }

        const RemoveField = (index) => {
            index = parseInt(index);
            // user.value.detail.experience.splice(index, 1);
            user.experience.splice(index, 1);
        }

        const UpdatingJob = async () => {
            let errorBox = document.getElementById("errors1");
            errorBox.innerHTML = '';
            try {
                store.commit('Loading', true);
                const data = {
                    // current_job: user.value.detail.current_job,
                    // experience: user.value.detail.experience
                    current_job: user.current_job,
                    experience: user.experience
                }
                await store.dispatch('user/UPDATE_JOB_EXP', data);
                store.commit('Loading', false);
                props.Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success Updated Job Exp:',
                    showConfirmButton: true,
                }).then(() => {
                    closeModalJob();
                });
            } catch (error) {
                store.commit('Loading', false);
                Error.ErrorShow(errorBox, error, props.Swal);
            }
        }

        const AddNewField = () => {
            user.experience.push({position: '', company: ''})
        }

        return {
            jobExpEdits, closeModalJob, AddNewField, user, RemoveField, UpdatingJob
        }
    }
}
</script>