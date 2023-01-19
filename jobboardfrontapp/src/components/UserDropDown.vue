<template>
     <div class="flex w-full content-center justify-between md:w-1/3 md:justify-end">
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
            <li class="flex-1 md:flex-none md:mr-3">
                <div class="relative inline-block justify-items-end">
                    <button @click="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2">
                        <i class="em em-robot_face"></i></span> Hi, {{ user.name }} 
                        <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                    <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white sm:right-0 mt-3 p-3 overflow-auto z-30 invisible">
                        <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" 
                        onkeyup="filterDD('myDropdown','myInput')">
                        <a href="#" class="p-2 hover:bg-gray-500 text-white text-sm no-underline hover:no-underline block">
                            <i class="fa fa-user fa-fw"></i> Profile</a>
                        <a href="#" class="p-2 hover:bg-gray-500 text-white text-sm no-underline hover:no-underline block">
                            <i class="fa fa-cog fa-fw"></i> Settings</a>
                        <div class="border border-gray-500"></div>
                        <a href="javascript:void(0);" class="p-2
                        text-white text-sm no-underline hover:no-underline block hover:bg-gray-500" 
                        @click.prevent="Logout"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
// import { defineProps, defineEmit, useContext } from 'vue'
import { inject, defineProps, ref } from "vue";
import { useStore } from "vuex";
    const props = defineProps({
        user: Object
    });

    const user = ref(props.user);
    
    const store = useStore();
    
    const Swal = inject("$Swal");

    const toggleDD = (myDropMenu) => {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }

    const Logout = async () => {
        store.commit('Loading', true);
        try {
            await store.dispatch('auth/LOGOUT');
            store.commit('Loading', false);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: `Logout Success`,
                showConfirmButton: true,
            }).then(() => {
                window.location.href = '/'; 
            });
            
        } catch (error) {
            store.commit('Loading', false);
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: `Sorry we cannot logout you now. forcing logout you now.`,
                showConfirmButton: true,
            });
        }
    }
       
</script>