<template>
     <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img v-if="application.user && application.user.detail && application.user.detail.image" class="h-10 w-10 rounded-full" 
                :src="application.user.detail.image" alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ application.user.name }}
                </div>
            </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">
                {{ application.job.title }}
            </div>
            <!-- <div class="text-sm text-gray-500">{{ jobdata.specialization }}</div> -->
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ application.message }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
             <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-lg p-1" 
            :class="{ 'bg-indigo-100 text-indigo-800': application.status == 'review', 
            'bg-green-100 text-green-800': application.status == 'accept',
            'bg-blue-100 text-blue-800': application.status == 'select', 
            'bg-red-100 text-red-800': application.status == 'reject',
            'bg-yellow-100 text-yellow-800': application.status == null}">
                {{ application.status == null ? 'standby' : application.status }}
            </span>
        </td>
    
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2" >
            <template v-if="!['reject', 'accept'].includes(application.status)">
<a href="javascript:void(0);" @click.prevent="StatusChange" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">
                Change Status</a>
            </template>
            
            <a href="javascript:void(0);" @click.prevent="ShowCVModal" class="bg-yellow-600 p-2 rounded text-yellow-200 hover:text-yellow-900" >View CV</a>
            <a href="javascript:void(0);" @click.prevent="ShowViewModal" class="bg-blue-600 p-2 rounded text-blue-200 hover:text-blue-900">
                View Application</a>
        </td>
    </tr>
</template>

<script>
import { ref } from '@vue/reactivity';
export default {
    props: {
        application: Object
    },

    setup(props, {emit}) {
        const appli = ref(props.application);
        
        const StatusChange = () => {
            emit('ShowChangeModal', appli)
        }

        const ShowViewModal = () => {
            emit('ShowViewModal', appli)
        }

        const ShowCVModal = () => {
            emit('ShowCVModal', appli)
        }

        return {
            StatusChange, ShowViewModal, ShowCVModal
        }
    }
}
</script>