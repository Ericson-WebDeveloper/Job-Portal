<template>
  <div id="nav-bar" class="fixed left-0 right-0 z-30" ref="showTopNav">
    <nav class="flex items-center justify-between flex-wrap bg-green-400 p-6">
      <div class="flex items-center flex-shrink-0 text-white mr-6">
        <svg
          class="fill-current h-8 w-8 mr-2"
          width="54"
          height="54"
          viewBox="0 0 54 54"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"
          />
        </svg>
        <span class="font-semibold text-xl tracking-tight"
          >Laravel Job Finder</span
        >
      </div>
      <div class="block lg:hidden">
        <button
          class="
            flex
            items-center
            px-3
            py-2
            border
            rounded
            text-teal-200
            border-teal-400
            hover:text-white hover:border-white
          "
          ref="burgerbtn"
        >
          <svg
            class="fill-current h-3 w-3"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <title>Menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
          </svg>
        </button>
      </div>
      <div
        class="
          w-full
          hidden
          lg:block
          flex-grow
          lg:flex lg:items-center lg:w-auto
        "
        ref="navmenu"
      >
        <div class="text-sm lg:flex-grow">
          <router-link
            :to="{ name: 'Home' }"
            class="
              main-a-3
              block
              mt-4
              lg:inline-block lg:mt-0
              text-green-200
              hover:text-white
              mr-4
            "
          >
            Search Jobs
          </router-link>
          <router-link
            :to="{ path: '/user' }"
            class="
              main-a-3
              block
              mt-4
              lg:inline-block lg:mt-0
              text-green-200
              hover:text-white
              mr-4
            "
          >
            My Laravel Job
          </router-link>
          <router-link
            :to="{ name: 'Companies' }"
            class="
              main-a-3
              block
              mt-4
              lg:inline-block lg:mt-0
              text-green-200
              hover:text-white
            "
          >
            Company Profiles
          </router-link>
        </div>
        <div class="gap-2">
          <span v-if="!loggedin">
            <router-link
              :to="{ name: 'Login' }"
              class="
                main-btn-3
                inline-block
                text-sm
                px-4
                py-2
                leading-none
                border
                rounded
                text-white
                border-white
                hover:border-transparent hover:text-green-500 hover:bg-white
                mt-4
                lg:mt-0
                mr-3
              "
              >Login</router-link
            >
            <router-link
              :to="{ name: 'SignUp' }"
              href="#"
              class="
                main-btn-3
                inline-block
                text-sm
                px-4
                py-2
                leading-none
                border
                rounded
                text-white
                border-white
                hover:border-transparent hover:text-green-500 hover:bg-white
                mt-4
                lg:mt-0
                mr-3
              "
              >Sign Up</router-link
            >
            <span class="mr-3">|</span>
            <router-link
              :to="{ name: 'Employeer' }"
              class="
                main-btn-3
                inline-block
                text-sm
                px-4
                py-2
                leading-none
                border
                rounded
                text-white
                border-white
                hover:border-transparent hover:text-green-500 hover:bg-white
                mt-4
                lg:mt-0
                mr-3
              "
              >For Employeers</router-link
            >
          </span>

          <span v-else>
            <a
              href="javascript:void(0);"
              @click.prevent="redirect"
              class="
                inline-block
                text-sm
                px-4
                py-2
                leading-none
                border
                rounded
                text-white
                border-white
                hover:border-transparent hover:text-green-500 hover:bg-white
                mt-4
                lg:mt-0
                mr-3
              "
              >My DashBoard</a
            >
            <a
              href="javascript:void(0);"
              @click.prevent="logout"
              class="
                inline-block
                text-sm
                px-4
                py-2
                leading-none
                border
                rounded
                text-white
                border-white
                hover:border-transparent hover:text-green-500 hover:bg-white
                mt-4
                lg:mt-0
                mr-3
              "
              >Logout</a
            >
          </span>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import { ref, onMounted, watch, computed, inject } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import csrf from "@/axios/csrf";
export default {
  setup() {
    const burgerbtn = ref(null);
    const navmenu = ref(null);
    const showTopNav = ref(null);
    const Swal = inject("$Swal");
    const router = useRouter();
    const store = useStore();

    const roles = ref(
      computed(() => {
        return store.getters["user/GET_ROLES"];
      })
    );

    const loggedin = ref(
      computed(() => {
        return store.state.auth.token;
      })
    );
    const GET_USER = async () => {
      await store.dispatch("auth/GET_USER");
    };
    onMounted(async () => {
      // if(store.state.auth.loggedin) {
      //    await GET_USER();
      // }
      // console.log(store.state.user.user.roles[0].name)
      burgerbtn.value.addEventListener("click", (e) => {
        e.preventDefault();
        navmenu.value.classList.toggle("hidden");
      });
    });

    watch(
      () => router.currentRoute.value.name,
      (newVal) => {
        if (
          ![
            "Home",
            "Login",
            "SignUp",
            "Employeer",
            "Companies",
            "Company",
            "Job",
            "searchjob",
            "vacancyjob",
            "Reset-Password",
            "Update-Password",
          ].includes(newVal)
        ) {
          showTopNav.value.classList.add("hidden");
          document.getElementById("views-router").classList.remove("pt-20");
        } else {
          showTopNav.value.classList.remove("hidden");
          document.getElementById("views-router").classList.add("pt-20");
        }
      }
    );

    const redirect = async () => {
      if (!roles.value) {
        await GET_USER();
      }
      if (roles.value[0].name == "user") {
        return router.push({ name: "User-Dashboard" });
      }
      if (roles.value[0].name == "employeer") {
        return router.push({ name: "Employeer-Dashboard" });
      }
      if (roles.value[0].name == "admin") {
        return router.push({ name: "Admin-Dashboard" });
      }

      // return router.push({name: 'Login'});
    };

    const logout = async () => {
      try {
        store.commit("Loading", true);
        let response = await store.dispatch("auth/VERIFY_USER");
        if (response) {
          await store.dispatch("auth/LOGOUT");
          store.commit("Loading", false);
          await Swal.fire({
            position: "center",
            icon: "success",
            title: "Logout Success",
            showConfirmButton: true,
          });

          window.location.reload();
        } else {
          store.commit("Loading", false);
          window.location.reload();
        }
      } catch (error) {
        store.commit("Loading", false);
        await Swal.fire({
          position: "center",
          icon: "error",
          title: "Logout Failed. Forcing Logout process.",
          timer: 3000,
        });
        store.commit("auth/SET_TOKEN", null);
        csrf.deleteToken();
        window.location.reload();
      }
    };

    // watch(() => store.state.auth.loggedin, (newVal) => {
    //     if(newVal) {
    //         try {

    //         } catch (error) {

    //         }
    //     } else {

    //     }
    // });

    // burgerbtn.value.addEventListener('click', (e) => {
    //     console.log(e.target.classList)
    // });
    // burgerbtn.add

    return {
      burgerbtn,
      navmenu,
      showTopNav,
      loggedin,
      logout,
      redirect,
    };
  },
};
</script>