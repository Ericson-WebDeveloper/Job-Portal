<template>
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" 
                :src="(users.detail && users.detail.image) ? users.detail.image : 'http://localhost:3000/images/useravatar.png'" alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                {{ users.name }}
                </div>
                <div class="text-sm text-gray-500">
                {{ users.email }}
                </div>
            </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ user.detail.address }}</div>
            <!-- <div class="text-sm text-gray-500">{{ user.detail.college }}</div> -->
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ user.detail.course }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <template v-if="user.email_verified_at">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Active
                </span> 
            </template>
            <template v-else>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Not Active
                </span> 
            </template>
           
        </td>
    
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
            <router-link :to="{name: 'User-View', params: {email: users.email} }" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</router-link>
        </td>
    </tr>
</template>

<script>
import { computed, ref } from '@vue/reactivity'
export default {
    props: {
        user: Object
    },
    setup(props) {
        const users = ref(computed(() => {
            return props.user
        }));

        return {
            users
        }
    }
}
</script>