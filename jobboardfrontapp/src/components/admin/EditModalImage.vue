<template>
    <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[imageEdit ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Edit My Image Profile:</h1>
                <svg @click.prevent="CloseImageModal()"  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    
                                <h1 class="inline text-2xl font-semibold leading-none ml-2">Image</h1>
                            </div>
                            <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                        </div>
                        <div class="px-5 pb-5">
                            <input placeholder="Image" @change.prevent="ImageCapture()" ref="imageProfile" type="file" class=" 
                            text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 
                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                        </div>
                        <div id="errors4">

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
            <button @click.prevent="CloseImageModal()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Cancel</button>
            <button type="button" @click.prevent="UpdateImage()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
        </div>
    </div>
</div>
</template>

<script>
import { ref } from '@vue/reactivity';
import { useStore } from 'vuex';
import Error from '@/helper/errorHandler';
export default {
    props: {
        imageEdit: Boolean,
        Swal: Function
    },
    setup(props, context) {

        const userImage = ref(null);
        const imageProfile = ref(null);
        const store = useStore();

        const ImageCapture = () => {
            userImage.value = imageProfile.value.files[0];
        }

        const UpdateImage = async () => {
            let errorBox = document.getElementById("errors4");
            errorBox.innerHTML = '';
            try {
                store.commit('Loading', true);
                let data = new FormData();
                data.append('file', userImage.value);

                await store.dispatch('user/UPDATE_IMAGE', data);
                await store.dispatch('auth/GET_USER');
                store.commit('Loading', false);
                props.Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success Updated Image Profile',
                    showConfirmButton: true,
                }).then(() => {
                    window.location.reload();
                });
            } catch (error) {
                store.commit('Loading', false);
                Error.ErrorShow(errorBox, error, props.Swal);
            }
        }

        const CloseImageModal = () => {
            context.emit("closeimagemodal")
        }

        return {
            CloseImageModal, ImageCapture, imageProfile, UpdateImage
        }
    }
}
</script>