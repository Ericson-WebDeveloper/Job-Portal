<template>
     <div class="w-full h-screen flex items-center justify-center bg-gray-200">
        <form class="w-full mx-5 md:w-2/5 lg:w-1/3 bg-white rounded-lg">
            <div class="flex font-bold justify-center mt-6">
                <img class="h-20 w-20"
                    src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
            </div>
            <h2 class="text-3xl text-center text-gray-700 mb-4">Reset Password Form</h2>
            <div class="px-12 pb-10">
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                        <input type='email' placeholder="Email" v-model="user.email"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div id="errors">
                </div>
                <a href="#" class="text-sm text-green-500 float-right mb-4">Send Request</a>
                
                <button type="button" @click.prevent="submitRequest"
                    class="w-full py-2 rounded-full bg-green-600 text-gray-100 focus:outline-none hover:bg-green-500">Login</button>
                    <router-link :to="{ name: 'SignUp' }" class="text-sm text-green-500 float-right mb-4 mt-2">Don't Have Account?</router-link>
            </div>

            
        </form>
      
    </div>
</template>

<script>
import {reactive, inject} from 'vue'
import {useStore} from 'vuex';
    export default {
        setup() {
            const store = useStore();
            const Swal = inject('$Swal');

            const user = reactive({
                email: ''
            });
            
            const submitRequest = async () => {
                const datas = {
                    email: user.email
                }
                try {
                    let {data} = await store.dispatch('RESET_PASS', datas);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: true,
                    });
                    user.email = '';
                } catch (error) {
                    if(error.error) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: error.error,
                            showConfirmButton: true,
                        });
                    }
                }
                
            }

            return {
                user, submitRequest
            }
        }
    }
</script>