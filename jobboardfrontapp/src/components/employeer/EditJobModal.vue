<template>
     <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[jobEdit ? '' : 'hidden']">
        <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
            <div class="flex justify-between border-b px-4 py-2 ">
                <h1 class="text-2xl font-bold font-serif">Edit Job</h1>
                <svg  @click.prevent="CloseEditModal()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="p-3 ">
                <div class="mx-auto">
                    <div class="">
                
                        <div class="mt-2 bg-white rounded-lg shadow">
                    
                            <div class="px-5 pb-5">
                                <label for="email" class="block text-xl font-semibold text-gray-600">Title</label>
                                <input v-model="job_edit.title" placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                    <label for="email" class="block text-xl font-semibold text-gray-600">Position</label>
                                        <input v-model="job_edit.position"  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                    <div class="w-full md:flex-grow md:w-2/4">
                                        <label for="email" class="block text-xl font-semibold text-gray-600">Specialization</label>
                                        <!-- <input v-model="job_edit.specialization" placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                        focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                        focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"> -->
                                         <i class='absolute ml-3 mt-6 items-centerfill-current text-gray-400 text-xs z-10 fas fa-user-md'></i>
                                        <input class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400" id="grid-last-name" type="text" 
                                         readonly placeholder="   All Specialization" 
                                        @click.prevent="showSelection('keylist3')">
                                        
                                        <ul class="absolute mt-18 bg-white rounded-lg text-left overflow-y-auto h-52 border-2 z-10 hidden w-2/4 md:w-2/4" 
                                        id="keylist3" >
                                            
                                            <ul class="p-2">
                                                <li class="text-mono text-xl">
                                                    <input type="checkbox" class="" id="box-all"> <span class="text-value" > All Specialization</span> 
                                                </li><hr>
                                            </ul>
                                            <template v-if="spexialiaxations.length > 0">
                                                <ul class="p-2" v-for="(spec, index) in spexialiaxations" :key="index">
                                                    <li class="text-mono text-xl">
                                                        <!--  -->
                                                        <input type="checkbox" class="box" :checked="job_edit.specialize_ids.includes(`${spec.id}`)"  :data-name="spec.name" :data-id="spec.id" data-type="parent"> <span class="text-value ml-2"> {{ spec.name }} </span> 
                                                        <ul class="nested py-2 hidden" v-if="spec?.subspecializations"
                                                        :class="[( specialsMatch(spec) ? 'active' : ''), (job_edit.specialize_ids.includes(`${spec.id}`) ? 'active' : '')]">
                                                            <li class="ml-6" v-for="(specc, index) in spec.subspecializations" :key="index">
                                                                <!--  -->
                                                                <input type="checkbox" class="box-child" :checked="job_edit.specialize_ids.includes(`${specc.id}`)" :data-name="specc.name" :data-id="specc.id" data-type="child"> <span class="text-value"> {{specc.name}} </span> 
                                                            </li>
                                                            <hr>
                                                        </ul>  
                                                    </li>
                                                    <hr>
                                                </ul>
                                            </template>
                                        </ul>
                                    </div>

                                </div>
                                    <div class="flex flex-col my-2">
                                        <div class="block">
                                            <label for="email" class="block text-xl font-semibold text-gray-600">Status</label>
                                        <div class="mt-2">
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input
                                                type="radio"
                                                class="form-radio"
                                                name="radio"
                                                value="1"
                                                v-model="job_edit.open"
                                                />
                                                    <span class="ml-2">Close</span>
                                                </label>
                                            </div>
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" class="form-radio" name="radio" value="0" v-model="job_edit.open" />
                                                    <span class="ml-2">Open</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                
                                <label for="Salary" class="block text-xl font-semibold text-gray-600">Salary</label>
                                <input v-model="job_edit.detail.salary" placeholder="Salary" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                                <label for="job_details" class="block text-xl font-semibold text-gray-600">Job Details</label>
                                <QuillEditor v-model:content="job_edit.detail.job_details" height="1000" theme="snow" toolbar="full" contentType="html" /> 

                                <label for="additional_details" class="block text-xl font-semibold text-gray-600">Additional Details</label>
                                <button @click.prevent="AddNewField()" class="bg-green-500 p-2 rounded text-white hover:bg-green-600">Add Experience</button>
                                <div class="flex flex-col md:flex-row" v-for="(detail, index) in job.detail.additional_details" :key="index">
                                    <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <input  placeholder="Name" v-model="detail.name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                        focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                        ring-offset-2 ring-gray-400"></div>
                                    <div class="w-full md:flex-grow md:w-2/4">
                                        <input placeholder="Value" v-model="detail.value" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition 
                                        duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white 
                                        dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" @click.prevent="RemoveField(index)" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                
                            </div><div id="errors5">

                                </div>
                        </div>

                    
                        
                    </div>
                </div>
            </div>

            <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                <button type="button" @click.prevent="CloseEditModal()" class="bg-red-500 p-2 rounded text-white hover:bg-red-600">Close</button>
                <button type="button" @click.prevent="UpdatingJob()" class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from '@vue/reactivity';
import { useStore } from 'vuex';
import Error from '@/helper/errorHandler';
import { onMounted, watch } from '@vue/runtime-core';
export default {
    props: {
        jobEdit: Boolean,
        job: Object, 
        SwalAlert: Function,
        spexial: Array
    },
    setup(props, context) {
        const store = useStore();
        const job_edit = ref(props.job);
        const spexialiaxations = ref(props.spexial);
        const state2 = reactive({ spexialiaxation2: [] });

        const CloseEditModal = (reload = false) => {
            context.emit('CloseEditModal', reload);
        }

        const RemoveField = (index) => {
            index = parseInt(index);
            job_edit.value.detail.additional_details.splice(index, 1);
        }
        
        watch(state2.spexialiaxation2, (prevVal, newVal) => {
            // console.log(prevVal, newVal)
            if(!prevVal && !newVal) {
                document.querySelector("#box-all").checked = true;
                document.querySelectorAll(".nested").forEach((box) => {
                    box.classList.remove("active");
                });
            }
            // if(newVal) {
            //     document.querySelector("#box-all").checked = false;
            // }
            if(state2.spexialiaxation2.length > 0) {
                document.querySelector("#box-all").checked = false;
            }

            if(state2.spexialiaxation2.length == 3) {
                document.querySelectorAll(".box").forEach((check) => {
                    if(!check.checked) {
                        check.setAttribute("disabled", "");
                    }
                });
                document.querySelectorAll(".box-child").forEach((check) => {
                    if(!check.checked) {
                        check.setAttribute("disabled", "");
                    }
                });
            } else {
                document.querySelectorAll(".box").forEach((check) => {
                    check.removeAttribute("disabled");
                });
                document.querySelectorAll(".box-child").forEach((check) => {
                    check.removeAttribute("disabled");
                });
            }

            if(state2.spexialiaxation2.length == 0) {
                document.querySelector("#box-all").checked = true;
                document.querySelectorAll(".nested").forEach((box) => {
                    box.classList.remove("active");
                });
            }
        });

        onMounted(() => {
            if(job_edit.value.specialize_ids.length == 0) {
                document.querySelector("#box-all").checked = true;
            } else {
                let data = job_edit.value.specialization;
                data = JSON.parse(data);
                data.forEach((d) => {
                    state2.spexialiaxation2.push({...d});
                });
            }
            
            setTimeout(() => {
                var toggler = document.querySelectorAll(".box");

                Array.from(toggler).forEach((btncheck) => {
                    
                    btncheck.addEventListener("click", function() {console.log('Parent check')
                        if(!this.parentElement.querySelector(".nested").classList.contains("active")) {
                            this.parentElement.querySelector(".nested").classList.toggle("active");
                        }
                        let urlParent = this.nextSibling.nextSibling.nextSibling;
                        let siblings = urlParent.getElementsByTagName("input");

                        if(btncheck.checked == true) {
                            Array.from(siblings).forEach((btn) => {
                                if(btn.checked) {
                                    let index = state2.spexialiaxation2.findIndex((spec) => spec.id == btn.dataset.id && spec.type == btn.dataset.type);
                                    state2.spexialiaxation2.splice(index, 1);
                                }
                            });
                            state2.spexialiaxation2.push({
                                id: btncheck.dataset.id,
                                name: btncheck.dataset.name,
                                type: btncheck.dataset.type,
                            });
                            document.querySelector("#box-all").checked = false;
                        } else {
                            let index = state2.spexialiaxation2.findIndex((spec) => spec.id == btncheck.dataset.id && spec.type == btncheck.dataset.type)
                            state2.spexialiaxation2.splice(index, 1);
                        }

                        Array.from(siblings).forEach((btn) => {
                            btn.checked = false;
                        });
                        // console.log(state2.spexialiaxation2)
                    });
                });

                let inputCHild = document.querySelectorAll(".box-child");
             
                inputCHild.forEach((btn) => {
                    btn.addEventListener("click", () => {
                        // console.log('Childd check')
                        let { id,
                            name,
                            type } = btn.dataset;
                        let parentCheck = btn.parentElement.parentElement.parentElement.getElementsByClassName("box")[0];
                        
                        if(parentCheck.checked == true) {
                            let index = state2.spexialiaxation2.findIndex((spec) => spec.id == parentCheck.dataset.id && spec.type == parentCheck.dataset.type)
                            state2.spexialiaxation2.splice(index, 1);
                        }

                        parentCheck.checked = false;
                        if(btn.checked == true) {
                            state2.spexialiaxation2.push({
                                id,
                                name,
                                type,
                            });
                            // console.log('Childd check add')
                        } else {
                            let index = state2.spexialiaxation2.findIndex((spec) => spec.id == id && spec.type == type)
                            state2.spexialiaxation2.splice(index, 1);
                            // console.log('Childd check remove', state2.spexialiaxation2);
                        }

                        let response = Array.from(parentCheck.nextSibling.nextSibling.nextSibling.querySelectorAll(".box-child")).every((checkbox) => {
                            return checkbox.checked == false;
                        });
                        
                        if(response) {
                            parentCheck.nextSibling.nextSibling.nextSibling.classList.remove("active");
                        }
                        // console.log(state2.spexialiaxation2)
                    });
                });


                document.getElementById("box-all").addEventListener("click", (e) => {
                    if(e.target.checked == true) {
                        document.querySelectorAll(".box").forEach((check) => {
                            check.removeAttribute("disabled");
                            check.checked = false;
                        });
                        document.querySelectorAll(".box-child").forEach((check) => {
                            check.checked = false;
                            check.removeAttribute("disabled");
                        });

                        document.querySelectorAll(".nested").forEach((nested) => {
                            nested.classList.remove("active")
                        });
                        state2.spexialiaxation2 = [];
                    } else {
                        e.target.checked = true;
                        state2.spexialiaxation2 = [];
                    }
                    
                });

            }, 1000)

            // if(state2.spexialiaxation2.length > 0) {
            //     document.querySelector("#box-all").checked = false;
            // }

            // if(state2.spexialiaxation2.length == 3) {
            //     document.querySelectorAll(".box").forEach((check) => {
            //         if(!check.checked) {
            //             check.setAttribute("disabled", "");
            //         }
            //     });
            //     document.querySelectorAll(".box-child").forEach((check) => {
            //         if(!check.checked) {
            //             check.setAttribute("disabled", "");
            //         }
            //     });
            // }
        })

        const showSelection = (id) => {
            document.getElementById(id).classList.toggle("hidden");
        }

        const AddNewField = () => {
            job_edit.value.detail.additional_details.push({name: '', value: ''});
        }
        const UpdatingJob = async () => {
            let errorBox = document.getElementById("errors5");
            errorBox.innerHTML = '';
            try {
                store.commit("Loading", true);
                job_edit.value.specialization = state2.spexialiaxation2;
                let data = {
                    id:job_edit.value.id,
                    title: job_edit.value.title, 
                    position: job_edit.value.position, 
                    specialization: job_edit.value.specialization, 
                    open:job_edit.value.open,
                    salary: job_edit.value.detail.salary, 
                    job_details: job_edit.value.detail.job_details, 
                    additional_details: job_edit.value.detail.additional_details,
                }
                await store.dispatch('jobs/UPDATING_JOB', data);
                store.commit("Loading", false);
                props.SwalAlert.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success Updating Job',
                    showConfirmButton: true,
                }).then(() => {
                    CloseEditModal(true);
                });
            } catch (error) {
                store.commit('Loading', false);
                Error.ErrorShow(errorBox, error, props.SwalAlert);
            }
        }

        const specialsMatch = (datas) => {
            let response =  datas.subspecializations.some((specials) => {
                return job_edit.value.specialize_ids.includes(`${specials.id}`);
            });
            return response;
        }

        

        return {
            job_edit, CloseEditModal, RemoveField, AddNewField, UpdatingJob, 
            spexialiaxations, showSelection, specialsMatch
        }
    },
}
</script>


<style scoped>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>