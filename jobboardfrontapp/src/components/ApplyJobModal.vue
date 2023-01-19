<template>
     <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[ApplyJob ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Add New Job</h1>
                <svg @click.prevent="closeModalAdd()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 ">
                <div class="mx-auto">
                    <div class="">
                
                        <div class="mt-2 bg-white rounded-lg shadow">
                    
                            <div class="px-5 pb-5">
                                <label for="name" class="block text-xl font-semibold text-gray-600">Full Name</label>
                                <input name="name" v-model="user.name" placeholder="Full Name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                <!-- <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                    <label for="email" class="block text-xl font-semibold text-gray-600">Position</label>
                                        <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                </div> -->
                                <label for="resume" class="block text-xl font-semibold text-gray-600">Resume *PDF only*</label>
                                <input type="file" ref="pdfRef" @change.prevent="pdfCapture()" accept="application/pdf" name="resume" placeholder="Resume" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                
                                <label for="message" class="block text-xl font-semibold text-gray-600">Message</label>
                                <textarea v-model="data.message" placeholder="Message" rows="5" name="message" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></textarea>
                            </div>

                            <div id="errors4">

                            </div>
                        </div>

                    
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click.prevent="closeModalAdd()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600" >Close</button>
                <button type="button" @click.prevent="submitApplication()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, reactive, ref } from '@vue/reactivity';
import { useStore } from 'vuex';
import Error from '@/helper/errorHandler';
export default {
    props: {
        ApplyJob: Boolean,
        jobData: Object,
        SwalAlert: Function
    },
    setup(props, context) {
        const store = useStore();
        const user = ref(computed(() => store.getters['user/GET_USER_DATA']));
        let pdfFile = ref(null);
        const pdfRef = ref(null);

        const data = reactive({
            message: '',   
        });

        const submitApplication = async () => {
            let errorBox = document.getElementById("errors4");
            errorBox.innerHTML = '';
            try {
                store.commit('Loading', true);
                let formdata = new FormData();
                formdata.append('csv', pdfFile.value);
                formdata.append('message', data.message);
                formdata.append('job_id', props.jobData.id);
                await store.dispatch('application/SUBMIT_APPLICATION', formdata);
                props.SwalAlert.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success Application Submition',
                    showConfirmButton: true,
                }).then(() => {
                    closeModalAdd();
                });
            } catch (error) {
                console.log(error)
                if(error.status == 401) {
                    props.SwalAlert.fire({
                        position: 'center',
                        icon: 'error',
                        title: error.message,
                        showConfirmButton: true,
                    });
                } else {
                   Error.ErrorShow(errorBox, error, props.SwalAlert); 
                }
                
            } finally {
                store.commit('Loading', false);
            }
        }

        const pdfCapture = () => {
            pdfFile.value = pdfRef.value.files[0];
        }

        const closeModalAdd = () => {
            store.commit('Open_Close_Modal', 'ApplyJobModal');
            context.emit('successApply')
        }

        return {
            closeModalAdd, user, pdfRef, pdfCapture, submitApplication, data
        }
    },
}
</script>