<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
            <!-- <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
            </div> -->
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                {{ jobdata.title }}
                </div>
                <!-- <div class="text-sm text-gray-500">
                 {{ jobdata.title }}
                </div> -->
            </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ jobdata.position }}</div>
            <!-- <div class="text-sm text-gray-500">{{ jobdata.specialization }}</div> -->
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
                <template v-for="(specialz, index) in jobdata.specialize_names" :key="index">
                    {{ specialz }},
                </template>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" v-if="jobdata.open == 0">
            Open
            </span>
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800" v-else>
            Close
            </span>
        </td>
    
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2" >
            <a href="javascript:void(0);" @click.prevent="Viewjob()" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
            <a href="javascript:void(0);"  @click.prevent="Updatejob()" class="bg-yellow-600 p-2 rounded text-yellow-200 
        hover:text-yellow-900" v-if="jobdata.open == 0">Update</a>
            <a href="javascript:void(0);"  @click.prevent="viewAllApplication" class="bg-blue-600 p-2 rounded text-blue-200 
        hover:text-yellow-900">View Applications</a>
        </td>
    </tr>
</template>

<script>
import { computed, ref } from '@vue/reactivity'
import { useRouter } from 'vue-router';
export default {
     props: {
        job: Object
    },
    setup(props, context) {
        
        const jobdata = ref(computed(() => props.job));
        const router = useRouter();

        const Viewjob = () => {
            context.emit('Viewjob', jobdata.value.id);
        }

        const Updatejob = () => {
            context.emit('updatingJob', jobdata.value.id);
        }

        const viewAllApplication = () => {
            router.push({name: 'Job-Application-List', params: {job_id: jobdata.value.id}});
            //router.replace({name:'Job-Application-List', params: {job_id: jobdata.value.id}})
        }

        return {
            jobdata, Viewjob, Updatejob, viewAllApplication
        }
    },
}
</script>

