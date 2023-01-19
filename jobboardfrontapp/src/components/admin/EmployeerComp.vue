<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" :src="(user.detail && user.detail.image) ? user.detail.image : 
                'http://localhost:3000/images/useravatar.png'" alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                {{ user.name }}
                </div>
                <div class="text-sm text-gray-500">
                {{ user.email }}
                </div>
            </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ (user.company && user.company.name) ? user.company.name : '' }}</div>
            <div class="text-sm text-gray-500">{{ (user.company && user.company.industry) ? user.company.industry : '' }}</div>
        </td>

        <td class="px-6 py-4 whitespace-nowrap">
            <template v-if="user.email_verified_at">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Subcribed
                </span> 
            </template>
            <template v-else>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Not Subcribed
                </span> 
            </template>
        </td>
    
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
            <a href="javascript:void(0);" @click.prevent="viewEmployeer()" class="bg-green-600 p-2 rounded 
            text-green-200 hover:text-green-900">View</a>
            <span v-if="!user.email_verified_at">
                <a href="javascript:void(0);" @click.prevent="updateAccount('activate')" class="bg-blue-600 p-2 rounded 
                text-blue-200 hover:text-blue-900">Activate</a>
            </span>
            
            <span v-else>
                <a href="javascript:void(0);" @click.prevent="updateAccount('deactivate')" class="bg-red-600 p-2 rounded 
                text-blue-200 hover:text-red-900">DeActivate</a>
            </span>
            
        </td>
    </tr>
</template>

<script>
import { computed, ref } from '@vue/reactivity';
export default {
    name: 'Employeer-Single',
    props: {
        employeer: Object
    },
    setup(props, context) {
        const user = ref(computed(() => {
            return props.employeer
        }));

        const viewEmployeer = () => {
            context.emit('viewEmployeer', user.value.email);
        }

        const updateAccount = (type) => {
            context.emit('changeStatus', {type, email: user.value.email});
        }

        return {
            user, viewEmployeer, updateAccount
        }
    }
}
</script>