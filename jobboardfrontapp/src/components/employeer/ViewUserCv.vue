<template>
     <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[ShowCV ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">DownLoading Resume Of Applicants</h1>
                <svg @click.prevent="closemodalview()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 ">
                <div class="mx-auto">
                    <div class="">
                        <div class="mt-2 bg-white rounded-lg shadow" v-if="application">
                            <vue-pdf-embed :source="url">
                                <!-- <template slot="loading">
                                    loading content here...
                                </template> -->
                            </vue-pdf-embed>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click="download" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Download</button>
                <button type="button" @click.prevent="closemodalview()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Close</button>
                
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from '@vue/reactivity';
import {inject} from 'vue'
// import pdf from 'vue-pdf';
// import pdf from 'pdfvuer'
// import 'pdfjs-dist/build/pdf.worker.entry' // not needed since v1.9.1
import VuePdfEmbed from 'vue-pdf-embed'
import { useStore } from 'vuex';
export default {
    props: {
        ShowCV: Boolean,
        application: Object
    },
    components: {
        VuePdfEmbed
    },

    setup(props, {emit}) {
        const SwalAlert = inject("$Swal");
        const store = useStore();
        const app = ref(props.application);
        const url = ref('');
        // const url = `http://localhost:3000/${app.value.cv}`;
        //window.open(url, "_blank");
        const closemodalview = () => {
            emit("closeModal", 'ShowCV')
        }

        const download = async () => {
            try {
                let data = await store.dispatch('application/DOWNLOAD_CSV',app.value.id);
                const url = window.URL.createObjectURL(new Blob([data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'Resume.pdf'); //or any other extension
                document.body.appendChild(link);
                link.click();
                link.remove();
                // url.value = data;
            } catch (error) {
                console.log(error);
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Connect to Server',
                    showConfirmButton: true,
                });
            }
        }
        return {
            closemodalview, app, url, download
        }
    }
}
</script>