<template>
    <div id="search-input" class="bg-gray-100">
        <form class="w-full">
            <div class="flex flex-wrap justify-center -mx-3 mb-6 p-10 text-center">
                <div class="flex items-center w-full md:w-1/4 px-3 mb-6 md:mb-0 relative">
                    <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-search'></i>
                   
                    <input class="-mx-6 px-8 appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3
                        leading-tight focus:outline-none focus:bg-white " id="grid-first-name" type="text" placeholder="Job, Keyword or Company" 
                        v-model="searching.keyword" @keyup.prevent="searchAuto('keyword')" @blur.prevent="closeList($event)" autocomplete="off"  >
                        <!-- @blur.prevent="searchAuto('keyword')" -->
                    <!-- <p class="text-red-500 text-xs italic"></p> -->
                    <ul class="absolute w-full bg-white rounded-lg text-left overflow-y-auto top-12 max-h-80 border-2 z-20 hidden" id="keylist"  
                    v-if="keyResult">
                    <!-- v-if="keyResult" -->
                    <!-- style="width: 437px;" -->
                        <template v-for="(result, index) in keyResult" :key="index">
                            <li class="p-2 font-serif text-lg cursor-pointer hover:bg-gray-100"  @mousedown.prevent="searchsjob('keyword',result.search)">
                                {{ result.search }}</li>
                            <hr>
                        </template>
                    </ul>
                   
                </div>
                <div class="flex items-center w-full md:w-1/4 px-3 mb-6 md:mb-0 relative">
                    <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-map-marker-alt'></i>
                    <input class="-mx-6 px-8 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" 
                    placeholder="Area, City or Town" v-model="searching.location" @keyup.prevent="searchAuto('location')" @blur.prevent="closeList($event)" 
                    autocomplete="off">
                    <!-- @blur.prevent="searchAuto('location')" -->
                    <p class="text-red-500 text-xs italic"></p>
                    <ul class="absolute w-full bg-white rounded-lg text-left overflow-y-auto top-12 max-h-80 border-2 z-20 hidden" id="keylist2"
                    v-if="keyResult2">
                        <template v-for="(result, index) in keyResult2" :key="index">
                            <li class="p-2 font-serif text-lg cursor-pointer hover:bg-gray-100"  @mousedown.prevent="searchsjob('location',result.search)">
                                {{ result.search }}</li>
                            <hr>
                        </template>
                    </ul>
                </div>

                <div class="flex items-center w-full md:w-1/4 px-3">
                    <i class='ml-3 items-centerfill-current text-gray-400 text-xs z-10 fas fa-user-md'></i>
                    <input class="-mx-6 px-8 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3
                    leading-tight focus:outline-none focus:bg-white focus:border-gray-500 cursor-pointer" id="grid-last-name" type="text" 
                    v-model="specializeNames" readonly placeholder="All Specialization" 
                    @click.prevent="showSelection('keylist3')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                     @click.prevent="showSelection('keylist3')">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_treeview2 -->
                    <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_treeview -->
                    <!-- https://ant.design/components/tree-select/#components-tree-select-demo-checkable -->
                    <ul class="absolute mt-64 bg-white rounded-lg text-left overflow-y-auto h-52 border-2 hidden" id="keylist3" style="width: 437px;"
                    >
                        
                        <!-- <ul id="myUL">
                            <li><span class="box">Beverages</span>
                                <ul class="nested">
                                <li class="ml-6">Water</li>
                                <li class="ml-6">Coffee</li>
                                 
                                </ul>
                            </li>
                        </ul> -->
                        <ul class="p-2">
                            <li class="text-mono text-xl">
                                <input type="checkbox" class="" id="box-all"> <span class="text-value" > All Specialization</span> 
                                
                            </li><hr>
                        </ul>
                        <template v-if="spexialiaxations.length > 0">
                            <ul class="p-2" v-for="(spec, index) in spexialiaxations" :key="index">
                                <li class="text-mono text-xl">
                                    <input type="checkbox" class="box" 
                                    :data-name="spec.name" :data-id="spec.id" data-type="parent"> <span class="text-value ml-2"> {{ spec.name }} </span> 
                                
                                    <ul class="nested py-2 hidden" v-if="spec?.subspecializations">
                                        <li class="ml-6" v-for="(specc, index) in spec.subspecializations" :key="index">
                                            <input type="checkbox" class="box-child" :data-name="specc.name" :data-id="specc.id" data-type="child"
                                            > <span class="text-value"> {{specc.name}} </span> 
                                        </li>
                                        <hr>
                                    </ul>
                                </li><hr>
                            </ul>
                        </template>
                        <!-- <ul class="p-1">
                            <li class="text-serif text-xl ">
                                <input type="checkbox" class="box"> <span class="text-value">IT</span> 
                            <hr>
                                <ul class="nested hidden">
                                    <li class="ml-6"><input type="checkbox" class="box-child"> <span class="text-value"> Water</span> </li>
                                    <hr>
                                    <li class="ml-6"><input type="checkbox" class="box-child"> <span class="text-value"> Coffee</span> </li>
                                    <hr>
                                </ul>
                            </li>
                        </ul>
                      

                        <ul class="p-1">
                            <li class="text-serif text-xl"><input type="checkbox" class="box"> <span class="text-value">IT</span> 
                            <hr>
                                <ul class="nested hidden">
                                    <li class="ml-6"><input type="checkbox" class="box-child">  <span class="text-value">Water</span> </li>
                                    <hr>
                                    <li class="ml-6"><input type="checkbox" class="box-child">  <span class="text-value">Coffee</span> </li>
                                    <hr>
                                </ul>
                            </li>
                        </ul> -->
                        
                        <!-- <ul>
                            <li><span class="box">Tea</span>
                                    <ul class="nested">
                                    <li>Black Tea</li>
                                    <li>White Tea</li>
                                    <li><span class="box">Green Tea</span>
                                        <ul class="nested">
                                        <li>Sencha</li>
                                        <li>Gyokuro</li>
                                        <li>Matcha</li>
                                        <li>Pi Lo Chun</li>
                                        </ul>
                                    </li>
                                    </ul>
                                </li> 
                        </ul> -->
     
                    </ul>
                    <!-- v-model="searching.specialization" -->
                </div>  
            
                <div class="w-full md:w-24 px-2">
                   <button type="button" @click.prevent="SearchJob" class="inline-block text-sm leading-none border rounded text-white 
                   bg-green-500 border-green-400 hover:border-transparent hover:text-white hover:bg-green-300 
                   lg:mt-0 py-4 px-4 mt-4 md:mt-0">Search</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { computed, reactive, ref } from '@vue/reactivity';
import { useRouter } from 'vue-router';
import { onMounted, onUnmounted, watch } from '@vue/runtime-core';
import {inject} from 'vue';
import { useStore } from 'vuex';
export default {
    props: {
        search: Object
    },
    setup(props) {
        const searching = ref(props.search);
        const router = useRouter();
        // const route = useRoute();
        const SwalAlert = inject('$Swal');
        const store = useStore();
       
        const state = reactive({ spexialiaxation: [] }); 
        const specializeNames = ref(computed(() => {
            return state.spexialiaxation.map((s) => {
                return s.name
            }).join(",");
        }));

        const routingTemp = reactive({
            keyword: '',
            final: ''
        });

        const specializeName = ref('All Specialization')
        const currentRouteName = ref('');

        const keyResult = ref([]);
        const keyResult2 = ref([]);
        
        const routingTemp2 = reactive({
            keyword: '',
            final: ''
        });

        const closeList = (e) => {
            e.target.nextElementSibling.nextElementSibling.classList.add('hidden');
        }

        const searchsjob = async (field, key) => {
            document.getElementById("keylist").classList.add('hidden');
            document.getElementById("keylist2").classList.add('hidden');
            document.getElementById("keylist3").classList.add('hidden'); 
            if(field == "keyword") {
                searching.value.keyword = key
            } 

            if(field == "location") {
                searching.value.location = key
            }

            if(field == "specialization") {
                searching.value.specialization = key
            }
            await SearchJob();
        }

        const searchAuto = async (term) => {
            if(searching.value[term].trim() != '') {
                try {
                    // store.commit("Loading", true);
                    // let {data} = await store.dispatch('SEARCH_AUTO', {term, keyword: searching.value.keyword, 
                    // location: searching.value.location, specialization: searching.value.specialization});
                    let {data} = await store.dispatch('SEARCH_AUTO', {term, [term]: searching.value[term]});
                    if(term == "keyword") {
                        keyResult.value = data.results; 
                        if(keyResult.value.length > 0) {
                            document.getElementById("keylist").classList.remove('hidden');
                        } else {
                            document.getElementById("keylist").classList.add('hidden');
                        }
                    } else {
                        keyResult2.value = data.results;
                        if(keyResult2.value.length > 0) {
                            document.getElementById("keylist2").classList.remove('hidden');
                        } else {
                            document.getElementById("keylist2").classList.add('hidden');
                        }
                    }
                } catch (error) {
                    keyResult2.value = [];
                    keyResult.value = [];
                } 
            } else {
                document.getElementById("keylist").classList.add('hidden');
                document.getElementById("keylist2").classList.add('hidden');
            }
            // if(searching.value.keyword != '') {
            //     try {
            //         // store.commit("Loading", true);
            //         let {data} = await store.dispatch('SEARCH_AUTO_2', {term, location:searching.value.location});
            //         keyResult.value = data.results;
            //     } catch (error) {
            //         console.log('No Result')
            //     } finally {
            //         // store.commit("Loading", false);
            //         if(keyResult.value.length > 0) {
            //             document.getElementById("keylist").classList.remove('hidden');
            //         } else {
            //             document.getElementById("keylist").classList.add('hidden');
            //         }
            //     }
            // } else {
            //     document.getElementById("keylist").classList.remove('hidden');
            // }    
        }

        const apiSerachRequest = async (data) => {
            document.getElementById("keylist").classList.add('hidden');
            document.getElementById("keylist2").classList.add('hidden'); 
            document.getElementById("keylist3").classList.add('hidden');
            try {
                store.commit("Loading", true);
                data.page = currentRouteName.value;
                await store.dispatch('jobs/SEARCHING_JOB', {pageno: null, datas:data});
            } catch (error) {
                console.log(error)
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Cannot Connect to Server',
                    showConfirmButton: true,
                });
            } finally {
                store.commit("Loading", false);
                //if(!document.getElementById("keylist").classList.contains('hidden')) {
                   document.getElementById("keylist").classList.add('hidden');
                   document.getElementById("keylist2").classList.add('hidden'); 
                   document.getElementById("keylist3").classList.add('hidden'); 
                //}
            }
        }

        const spexialiaxations = ref([]);

        watch(state.spexialiaxation, (prevVal, newVal) => {
            console.log(newVal)
            if(!prevVal && !newVal) {
                document.querySelector("#box-all").checked = true;
            }
            if(newVal) {
                document.querySelector("#box-all").checked = false;
            }

            if(state.spexialiaxation.length == 3) {
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
            // New code feb 18
            if(state.spexialiaxation.length == 0) {
                document.querySelector("#box-all").checked = true;
                document.querySelectorAll(".nested").forEach((box) => {
                    box.classList.remove("active");
                });
            }
        });

        const constructQuery = (datas) => {
            let string = '';
            datas.forEach((str,index) => {
                string += datas[index + 1] != undefined ? `${str.id}&` : `${str.id}`
            });
            return string;
        }

        onUnmounted(() => {
            state.spexialiaxation = [];
        });

        onMounted(async () => {
            let {specializations} = await store.dispatch("GET_SPECIALIZATIONS");
          
            spexialiaxations.value = specializations;
            document.querySelector("#box-all").checked = true;
            currentRouteName.value = router.currentRoute.value.name;
            console.log('naulit')
            
            // var toggler = document.getElementsByClassName("box");
            // var i;
            setTimeout(() => {
                var toggler = document.querySelectorAll(".box");
                Array.from(toggler).forEach((btncheck) => {
                    btncheck.addEventListener("click", function() {
                        // this.parentElement.classList.add("text-bold");
                        // let childParent = this.parentElement.querySelector(".nested");
                        // childParent.classList.toggle("active");
                        if(!this.parentElement.querySelector(".nested").classList.contains("active")) {
                            this.parentElement.querySelector(".nested").classList.toggle("active");
                        }
                        let urlParent = this.nextSibling.nextSibling.nextSibling;
                        let siblings = urlParent.getElementsByTagName("input");

                        if(btncheck.checked == true) {
                            Array.from(siblings).forEach((btn) => {
                                if(btn.checked) {
                                    let index = state.spexialiaxation.findIndex((spec) => spec.id == btn.dataset.id && spec.type == btn.dataset.type);
                                    state.spexialiaxation.splice(index, 1);
                                }
                            });
                            state.spexialiaxation.push({
                                id: btncheck.dataset.id,
                                name: btncheck.dataset.name,
                                type: btncheck.dataset.type,
                            });
                        } else {
                            let index = state.spexialiaxation.findIndex((spec) => spec.id == btncheck.dataset.id && spec.type == btncheck.dataset.type)
                            state.spexialiaxation.splice(index, 1);
                        }
                        // this.classList.toggle("check-box");
                        // let urlParent = this.nextSibling.nextSibling.nextSibling.nextSibling;
                        Array.from(siblings).forEach((btn) => {
                            btn.checked = false;
                        });
                        
                    });
                });

                let inputCHild = document.querySelectorAll(".box-child");
                inputCHild.forEach((btn) => {
                    btn.addEventListener("click", () => {
                        let { id,
                            name,
                            type } = btn.dataset;
                        let parentCheck = btn.parentElement.parentElement.parentElement.getElementsByClassName("box")[0];
                        if(parentCheck.checked == true) {
                            let index = state.spexialiaxation.findIndex((spec) => spec.id == parentCheck.dataset.id && spec.type == parentCheck.dataset.type)
                            state.spexialiaxation.splice(index, 1);
                        }
                        parentCheck.checked = false;
                        if(btn.checked == true) {
                            state.spexialiaxation.push({
                                id,
                                name,
                                type,
                            });
                        } else {
                            let index = state.spexialiaxation.findIndex((spec) => spec.id == id && spec.type == type)
                            state.spexialiaxation.splice(index, 1);
                        }

                        // New Added Code Feb 18
                        let response = Array.from(parentCheck.nextSibling.nextSibling.nextSibling.querySelectorAll(".box-child")).every((checkbox) => {
                            return checkbox.checked == false;
                        });
                        
                        if(response) {
                            parentCheck.nextSibling.nextSibling.nextSibling.classList.remove("active");
                        }
                        // New Added Code Feb 18
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

                    } else {
                        e.target.checked = true;
                    }
                    state.spexialiaxation = [];
                });

            }, 2000)
            // for (i = 0; i < toggler.length; i++) {
            //     toggler[i].addEventListener("click", function() {
            //         // this.parentElement.classList.add("text-bold");
            //         console.log('here');
            //         let childParent = this.parentElement.querySelector(".nested");
            //         childParent.classList.toggle("active");
            //         // this.parentElement.querySelector(".nested").classList.toggle("active");
                
            //         this.classList.toggle("check-box");

            //         let urlParent = this.nextSibling.nextSibling.nextSibling.nextSibling;

            //         let siblings = urlParent.getElementsByTagName("input");

            //         Array.from(siblings).forEach((btn) => {
            //             btn.checked = false;
            //         });
                    
            //     });
            // }
        });
        
        const SearchJob = async () => {
            routingTemp.final = '';
            routingTemp2.final = '';
    
            searching.value.specialization = state.spexialiaxation.length > 0 ? constructQuery(state.spexialiaxation) : '';
            // if(router.currentRoute.value.name == "Home" || router.currentRoute.value.name == "vacancyjob") {
            await apiSerachRequest(searching.value);
            if(["Home","vacancyjob"].includes(currentRouteName.value)) {
                if(searching.value.keyword) {
                    routingTemp2.keyword = `${searching.value.keyword.replace(/\s/g, '-')}-jobs`;
                }
                //console.log(routingTemp2.keyword);
                if(searching.value.location) {
                    if(routingTemp2.keyword) {
                        routingTemp2.final = `${routingTemp2.keyword}-in-${searching.value.location.replace(/\s/g, '-')}`;
                    } else {
                        //routingTemp2.final = `${searching.value.location.replace(/\s/g, '-')}-jobs`;
                        routingTemp2.final = `jobs-in-${searching.value.location.replace(/\s/g, '-')}`;
                    }
                } else {
                    routingTemp2.final = `${routingTemp2.keyword}`;
                }
                //console.log(routingTemp2.final)
                if(searching.value.specialization) {
                    console.log(routingTemp2.final)
                    if(routingTemp2.final) {
                        //console.log('here 1')
                        router.push({name:'searchjob', params: {key: routingTemp2.final}, query: {specialization: searching.value.specialization} }); 
                    } else {
                        router.push({name:'vacancyjob', query: {specialization: searching.value.specialization}  });
                        //console.log('here 2')
                    }
                }

                if(!searching.value.specialization && searching.value.keyword || searching.value.location) {
                    // console.log('here 4', routingTemp2.final)
                    router.push({name:'searchjob', params: {key: routingTemp2.final} });
                }

                if(!searching.value.keyword && !searching.value.location && !searching.value.specialization) {
                    // router.push({name: 'searchjob' ,params: {key: 'vacancy-jobs'}});
                    router.push({name: 'vacancyjob'});
                }
                
                // await apiSerachRequest(searching.value);
            } else {
               
                if(searching.value.keyword) {
                    routingTemp.keyword = `${searching.value.keyword.replace(/\s/g, '-')}-jobs`;
                    routingTemp.final = routingTemp.keyword;
                }
                if(searching.value.location) {
                    if(routingTemp.keyword) {
                        // newRouteLocation = searching.value.location;
                        routingTemp.final = `${routingTemp.final}-in-${searching.value.location.replace(/\s/g, '-')}`;
                    } else { // new code
                        // routingTemp.final = `${searching.value.location.replace(/\s/g, '-')}-jobs`;
                        routingTemp.final = `jobs-in-${searching.value.location.replace(/\s/g, '-')}`;
                    }
                } else {
                    routingTemp.final = `${routingTemp.keyword}`;
                } // new code Jan 12

                // router.push({params: {key: routingTemp.final}});
                
                if(searching.value.specialization) {
                    if(routingTemp.final) {
                        router.push({params: {key: routingTemp.final}, query: {specialization: searching.value.specialization.replace(/\s/g, '-')}});
                    } else {
                        router.push({query: {specialization: searching.value.specialization.replace(/\s/g, '-')}});
                    }
                    
                } else{
                    if(routingTemp.final) {
                        router.push({params: {key: routingTemp.final}});
                    } 
                }

                if(!searching.value.keyword && !searching.value.location && !searching.value.specialization) {
                    // router.push({params: {key: 'vacancy-jobs'}});
                    router.push({name: 'vacancyjob'});
                }
                // await apiSerachRequest(searching.value);
            }

            // await apiSerachRequest(searching.value);
        }

        const showSelection = (id) => {
            document.getElementById(id).classList.toggle("hidden");
        }

        return {
            searching, SearchJob, keyResult, searchAuto, searchsjob, keyResult2, 
            closeList, spexialiaxations, specializeName, showSelection, specializeNames
        }
    }
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

/* .box {
  cursor: pointer;
  -webkit-user-select: none; 
  -moz-user-select: none; 
  -ms-user-select: none; 
  user-select: none;
}

.box::before {
  content: "\2610";
  color: black;
  display: inline-block;
  margin-right: 6px;
} */

/* .check-box::before {
  content: "\2611"; 
  color: dodgerblue;
} */

.nested {
  display: none;
}

.active {
  display: block;
}
</style>