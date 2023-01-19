<template>
     <Loading v-model:active="loading.isLoading"
                 :is-full-page="loading.fullPage"></Loading>
</template>

<script>
import {reactive, computed} from 'vue'
import {useStore} from 'vuex';
export default {
    setup() {

        const store = useStore();
        const {state} = store;

        const loading = reactive({
            isLoading: computed(() => {
                return state.isLoading
            }),
            fullPage: computed(() => {
                return state.fullPage
            })
        });

        return {
            loading
        }
    }
}
</script>