<template>
    <div id="companies">
        <section class="relative py-24 px-4">
            <div class="z-20 relative text-white container mx-auto bg-white bg-opacity-80 p-5">
                <h1 class="text-4xl mb-4 text-black">Discover more than just a workplace</h1>
                <p class="leading-normal text-black">Search Company's</p>

                <form action="" class="mt-3">
                    <div class="flex items-center static">
                        <i class='ml-3 fill-current text-gray-400 text-xs z-10 fas fa-search'></i>
                        <!-- <input type="text" class="-mx-6 px-8 border rounded-xl py-2 w-1/2 text-gray-700 focus:outline-none " 
                        v-model="search.company" name="search" id="search" 
                        placeholder="Search Company Here" @keyup="searchAuto('company')" @blur="searchAuto('company')"> -->
                     
                        <ul class="absolute mt-64 bg-white text-blue-400 rounded-lg text-left overflow-y-auto h-52 border-2 w-1/2 hidden" id="keylist" 
                        v-if="keyResult.length > 0">
      
                            <template v-for="(result, index) in keyResult" :key="index">
                                <li class="p-2 font-serif text-lg cursor-pointer hover:bg-gray-100"  @click.prevent="viewCompany(result)">
                                    {{ result.name }}</li>
                                <hr>
                            </template>
                        </ul>
                    </div>
                </form>
                <!-- <a href="#" class="inline-block bg-blue-500 text-white no-underline hover:bg-blue-800 mt-4 p-4 rounded ml-5">A Call to Action</a> -->
            </div>
            <div class="absolute inset-0 h-auto z-10">
                <img src="../../public/images/Employees.jpg" alt="" class="h-full w-full ">
            </div>
        </section>

        <section id="popular-companies">
            <div class="container mx-auto">
                <h2 class="text-4xl text-center text-gray-700 mb-4 mt-3 font-semibold text-green-400">Popular Companies</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                    <template v-for="(company, index) in companies" :key="index">
                        <div class="p-10 relative cursor-pointer" @click.prevent="viewCompany(company)">  
                            <div class="absolute right-10 mr-2 mt-2 rounded">
                                <h4 class="bg-green-500 p-1 px-4 text-serif text-white text-sm" v-if="company?.hiring">Hiring</h4>
                            </div>
                            <!--Card 1--> 
                            <div class="max-w-sm rounded overflow-hidden shadow-lg border-2">
                                <img class="w-52 h-44 mx-auto" :src="company?.detail?.image ? company.detail.image : 'http://localhost:3000/images/download.png'" alt="Mountain">
                            <div class="px-6 py-4 text-center">
                                <div class="font-bold text-xl mb-2">{{company.name}}</div>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <p>ratings</p>
                            </div>
                            <!-- <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                            </div> -->
                            </div>
                        </div>
                    </template>
                    
       
                </div>  
            </div>
        </section>
    </div>
</template>

<script>
import { computed, onMounted, reactive, ref } from '@vue/runtime-core';
import { useStore } from 'vuex'
import { useRouter } from 'vue-router';
export default {
    setup() {
        const store = useStore();
        const router = useRouter();
        const companies = ref(computed(() => store.getters['company/GET_TOP_COMPANY']));
        const search = reactive({
            company: ''
        });
        const keyResult = ref([]);

        const searchAuto = async (term) => {
            if(search.company.trim() != '') {
                try {
                    let {data} = await store.dispatch('SEARCH_AUTO', {term, company: search.company});
                    keyResult.value = data.results
                } catch (error) {
                    keyResult.value = [];
                } finally {
                    // store.commit("Loading", false);
                    if(keyResult.value.length > 0) {
                        document.getElementById("keylist").classList.remove('hidden');
                    } else {
                        document.getElementById("keylist").classList.add('hidden');
                    }
                }
            }
             else {
                document.getElementById("keylist").classList.add('hidden');
            }
        }


        onMounted(async() => {
            try {
                await store.dispatch('company/TOP_COMPANIES');
            } catch (error) {
                console.log(error);
            }
        });

        const viewCompany = (company_data) => {
            router.push({name: 'Company', params: {company: `${company_data.id}-${company_data.name}` }});
        } 

        return {
            companies, viewCompany, keyResult, searchAuto, search
        }
    }
}
</script>

<style scoped>
.object-fit-fill {
  object-fit: fill;
}

.object-fit-contain {
  object-fit: contain;
}

.object-fit-cover {
  object-fit: cover;
}

.object-fit-none {
  object-fit: none;
}

.object-fit-scale-down {
  object-fit: scale-down;
}
</style>