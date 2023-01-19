<template>
  <div
    class="w-full h-screen flex items-center justify-center bg-gray-200"
  ></div>
</template>

<script>
import { inject, onMounted } from "vue";
import {useStore} from 'vuex';
import { useRoute } from "vue-router";

export default {
  setup() {
    const store = useStore();
    const Swal = inject("$Swal");
    const route = useRoute();
    // const router = useRouter();

    onMounted(() => {
    //   if (!route.params.token || !route.params.email) {
    //     Swal.fire({
    //       position: "top-center",
    //       icon: "error",
    //       title: "You dont have permission in this page.",
    //       showConfirmButton: false,
    //     });
    //     window.location.href = "/signin";
    //   }
      handleVerifyAccount();
    });

    const handleVerifyAccount = async () => {
      const datas = {
          token: route.params.token,
          email: route.params.email
      }
      if (!route.params.token || !route.params.email) {
        Swal.fire({
          position: "top-center",
          icon: "error",
          title: "You dont have permission in this page.",
          showConfirmButton: false,
        });
        window.location.href = "/signin";
      }
      try {
        store.commit("Loading", true);
        await store.dispatch("POST_VERIFY_ACCOUNT", datas);
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: 'Account Verified!.',
          showConfirmButton: true,
        }).then(() => {
          window.location.href = "/signin";
        });
      } catch (error) {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: 'Invalid Request',
            showConfirmButton: false,
          });
          window.location.href = "/signin";
      } finally {
        store.commit("Loading", false);
      }
    };
  },
};
</script>

<style>
</style>