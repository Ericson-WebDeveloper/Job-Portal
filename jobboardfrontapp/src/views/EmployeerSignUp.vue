<template>
    <div class="w-full h-screen flex items-center justify-center bg-gray-200">
        <form class="w-full h-auto mx-5 md:w-2/5 lg:w-1/3 bg-white rounded-lg">
            <h1 class="text-4xl text-center text-gray-700 mb-4 mt-3">Start Hiring with Us!</h1>
            <h3 class="text-1xl text-center text-gray-700 mb-2 mt-2">
             <i class='text-gray-400 text-xs  fas fa-check'></i> 1st choice among Filipino job seekers*
             </h3>
             <h3 class="text-1xl text-center text-gray-700 mb-2 mt-2">
             <i class='text-gray-400 text-xs  fas fa-check'></i> Access more than 12 million talents in the Philippines*
             </h3>
             <h3 class="text-1xl text-center text-gray-700 mb-2 mt-2">
             <i class='text-gray-400 text-xs  fas fa-check'></i> Most searched for career partner*
             </h3>
            <div class="flex font-bold justify-center mt-6">
                <img class="h-20 w-20"
                    src="https://raw.githubusercontent.com/sefyudem/Responsive-Login-Form/master/img/avatar.svg">
            </div>
            <h2 class="text-3xl text-center text-gray-700 mb-4">Employeer Register Form</h2>

            <div class="px-12 pb-10">

                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-building'></i>
                        <input type='text' placeholder="Register Bussiness Name" v-model="employeer.business"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>

                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                        <input type='text' placeholder="Business Address" v-model="employeer.address"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>

                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                        <input type='text' placeholder="Business Industry" v-model="employeer.industry"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>

                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-user'></i>
                        <input type='text' placeholder="Full Name" v-model="employeer.name"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-envelope'></i>
                        <input type='email' placeholder="Email" v-model="employeer.email"
                            class="-mx-6 px-8  w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
        
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-lock'></i>
                        <input type='password' placeholder="Password" v-model="employeer.password"
                            class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div class="w-full mb-2">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-lock'></i>
                        <input type='password' placeholder="Password Confirmation" v-model="employeer.password_confirmation"
                            class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none focus:border-green-500" />
                    </div>
                </div>
                <div id="errors">

                </div>
                <button type="button" @click.prevent="Signup()"
                    class="w-full py-2 rounded-full bg-green-600 text-gray-100 focus:outline-none hover:bg-green-500">Register Company</button>
                    <router-link :to="{ name: 'Login' }" class="text-sm text-green-500 float-right mb-4 mt-2">Already Have Account?</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import {reactive, inject} from 'vue';
import {useStore} from 'vuex';
import {useRouter} from 'vue-router'
export default {
    setup() {
        const employeer = reactive({
            business: '',
            address: '',
            industry: '',
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        });
        const router = useRouter();

        const Swal = inject('$Swal');

        const store = useStore();


        const Signup = async () => {
            try {
                store.commit('Loading', true);
                let response = await store.dispatch('auth/REGISTER_EMPLOYEER', employeer);
                store.commit('Loading', false);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: true,
                }).then(() => {
                    router.push({name: 'Home'});
                });
                
            } catch (error) {
                document.getElementById("errors").innerHTML = '';
                store.commit('Loading',false);
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

        return {employeer, Signup}
    }
}
</script>