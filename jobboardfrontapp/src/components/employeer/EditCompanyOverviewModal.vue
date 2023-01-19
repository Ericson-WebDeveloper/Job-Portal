<template>
    <div class="">
        <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[overview_info ? '' : 'hidden']">
            <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                <div class="overflow-y-auto max-h-screen">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit My Company Overview & Addional Data</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" @click.prevent="closeModal1()" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class=" p-3">
                        <div class="m-auto">
                            <div class="">
                                <div class="mt-2 bg-white rounded-lg shadow">
                                    <div class="flex">
                                        <div class="flex-1 py-5 pl-5 overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
            
                                            <h1 class="inline text-2xl font-semibold leading-none ml-2">Overview Data</h1>
                                        </div>
                                        <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                    </div>
                                    <div class="px-5 pb-5">
                                        <div class="overflow-x-hidden overflow-y-auto">
                                            <!-- <ckeditor :editor="editor.editor" v-model="comp.company_overview" :config="editor.editorConfig"></ckeditor> -->
                                       <QuillEditor v-model:content="comp.company_overview" height="1000" theme="snow" toolbar="full" contentType="html" 
                                         /> 
                                       </div>
                                    </div>
                                </div>

                                <div class="mt-2 bg-white rounded-lg shadow">
                                    <div class="flex">
                                        <div class="flex-1 py-5 pl-5 overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
            
                                            <h1 class="inline text-2xl font-semibold leading-none ml-2">Additional Data</h1>
                                        </div>
                                        <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                    </div>
                                    <div class="px-5 pb-5 ">
                                        <div class="overflow-x-hidden overflow-y-auto">
                                            <!-- <ckeditor :editor="editor.editor" v-model="comp.additional_info" :config="editor.editorConfig"></ckeditor> -->
                                            <button @click="AddNewField()" class="bg-green-500 p-2 rounded text-white hover:bg-green-600">Add Experience</button>
                                            <div class="flex flex-col md:flex-row" v-for="(info, index) in comp.additional_info" :key="index">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" @click.prevent="RemoveField(index)" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>
                                            <div id="errors2">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                        <button type="button" @click.prevent="closeModal1()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Cancel</button>
                        <button type="button" @click="UpdateorCreateOtherData()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { reactive } from '@vue/reactivity';
import Error from '@/helper/errorHandler';
import {useStore}  from 'vuex';
// import {watch } from '@vue/runtime-core';
export default {
    props: {
        overview_info: Boolean,
        company: Object,
        SwalAlert: Function
    },
    // components: {
    //     ClassicEditor
    // },
    setup(props, context) {
        const store = useStore();

        const comp = reactive({
            company_overview: props.company.detail && props.company.detail.company_overview ? props.company.detail.company_overview : '',
            additional_info: props.company.detail && props.company.detail.additional_info ? props.company.detail.additional_info : [],
        });

        const AddNewField = () => {
            comp.additional_info.push({name: '', value: ''})
        }

        const UpdateorCreateOtherData = async () => {
            let errorBox = document.getElementById("errors2");
            errorBox.innerHTML = '';
            try {
                store.commit("Loading", true);
                let data = {
                    id: props.company.id,
                    company_overview: comp.company_overview,
                    additional_info: comp.additional_info,
                }
                await store.dispatch('company/UPDATE_OTHER_DATA', data);
                store.commit("Loading", false);
                props.SwalAlert.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Update Additional Data Success',
                    showConfirmButton: true,
                }).then(() => {
                    closeModal1();
                });
            } catch (error) {
                store.commit("Loading", false);
                Error.ErrorShow(errorBox, error, props.SwalAlert);
            }
        }

        const RemoveField = (index) => {
            index = parseInt(index);
            comp.additional_info.splice(index, 1);
        }

        const editor = reactive({
                editor: ClassicEditor,
                consteditorData: '<p>Content of the editor.</p>',
                consteditorData2: '<p>Content of the editor.</p>',
                editorConfig: {
                    toolbar: {
                        // items: [
                        //     'bold',
                        //     'italic',
                        //     'link',
                        //     'undo',
                        //     'redo'
                        // ]
                    }
                }
        });

        const setData = (data) => {
            console.log(data)
        }

        const closeModal1 = () => {
            
            context.emit('closeModal1');
        }

        return {
            editor, closeModal1, comp, setData, AddNewField, RemoveField, UpdateorCreateOtherData
        }
    }
}
</script>