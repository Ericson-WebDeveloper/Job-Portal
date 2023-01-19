<template>
    <div class="w-full h-screen flex items-center justify-center bg-gray-200">
        <form class="w-full mx-5 md:w-2/5 lg:w-1/3 bg-white rounded-lg">
            <div class="flex font-bold justify-center mt-6">
                <img class="h-20 w-20"
                    src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
            </div>
            <h2 class="text-3xl text-center text-gray-700 mb-4">Login Form</h2>
            <div class="px-12 pb-10">
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                        <input type='email' placeholder="Email" v-model="user.email"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-lock'></i>
                        <input type='password' placeholder="Password" v-model="user.password"
                            class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div id="errors">

                </div>
                
                <!-- <ckeditor :editor="editor.editor" v-model="editor.editorData" :config="editor.editorConfig"></ckeditor> -->
                <router-link :to="{name: 'Reset-Password'}" class="text-sm text-green-500 float-right mb-4">Forgot Password?</router-link>
                
                <button type="button" @click.prevent="login"
                    class="w-full py-2 rounded-full bg-green-600 text-gray-100 focus:outline-none hover:bg-green-500">Login</button>
                    <router-link :to="{ name: 'SignUp' }" class="text-sm text-green-500 float-right mb-4 mt-2">Don't Have Account?</router-link>
            </div>

            
        </form>
    </div>
</template>


<script>
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {reactive, onMounted, inject} from 'vue'
import {useStore} from 'vuex';
//import {useRouter} from 'vue-router';
export default {
    
    setup() {
        const store = useStore();
        const Swal = inject('$Swal');
        //const router = useRouter();
        // const {state} = store;
        
        const editor = reactive({
                // editor: ClassicEditor,
                consteditorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                }
        });

        const user = reactive({
            email: '',
            password: ''
        });
        
        onMounted(async () => {
            
        });
    
        const login = async () => {
            try {
                store.commit('Loading', true);
                await store.dispatch('auth/LOGIN_USER', user);
                store.commit('Loading', false);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Login Success',
                    showConfirmButton: true,
                }).then(() => {
                    if(localStorage.getItem('routeBack')) {
                        let routeName = localStorage.getItem('routeBack');
                        localStorage.removeItem('routeBack');
                        window.location.href = routeName;
                    } else {
                       window.location.href = '/'; 
                    }
                });
            } catch (error) {
                document.getElementById("errors").innerHTML = '';
                store.commit('Loading', false);
                // console.log(error.message)
                if(error.message) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.message,
                        showConfirmButton: true,
                    });
                } else if(error.errors) {
                    let keys = Object.keys(error.errors);
                    let html = keys.map((key) => {
                        return `<div class="flex items-center bg-red-500 mt-1 text-white text-sm font-bold px-4 py-3" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path 
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 
                            1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 
                            0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 
                            5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>${error.errors[key]}</p>
                        </div>`;
                    }).join("");
                    document.getElementById("errors").innerHTML = html
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Server cannot process you request. please try again later.',
                        showConfirmButton: true,
                    });
                }
            }
        }
        return {
            editor, user, login
        }
    }
}
</script>
