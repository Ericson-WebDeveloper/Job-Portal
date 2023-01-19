<template>
  <div id="home" class="flex h-screen" v-cloak>
    <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5" v-if="user">
      <div class="bg-gray-800">
        <div class="bg-blue-900 p-4 shadow text-2xl text-white">
          <h3 class="font-bold pl-2">Profile</h3>
        </div>
      </div>

      <!-- https://tailwindcomponents.com/component/profile-page -->
      <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2">
          <!-- Left Side -->
          <div class="w-full md:w-3/12 md:mx-2">
            <!-- Profile Card -->
            <div class="bg-white p-3 border-t-4 border-green-400">
              <div class="image overflow-hidden">
                <img
                  class="h-auto w-full mx-auto"
                  :src="
                    user.detail && user.detail.image
                      ? user.detail.image
                      : 'http://localhost:3000/images/useravatar.png'
                  "
                  alt=""
                />
              </div>
              <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                {{ user.name }}
              </h1>

              <ul
                class="
                  bg-gray-100
                  text-gray-600
                  hover:text-gray-700 hover:shadow
                  py-2
                  px-3
                  mt-3
                  divide-y
                  rounded
                  shadow-sm
                "
              >
                <li class="flex items-center py-3">
                  <span>Status</span>
                  <span class="ml-auto"
                    ><span
                      class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                      >Active</span
                    ></span
                  >
                </li>
                <li class="flex items-center py-3">
                  <span>Member since</span>
                  <span class="ml-auto">{{ moment(user.created_at).format('MMMM Do YYYY') }}</span>
                </li>
              </ul>
            </div>
            <!-- End of profile card -->
            <div class="my-4"></div>
          </div>
          <!-- Right Side -->
          <div class="w-full md:w-9/12 mx-2 h-64">
            <!-- Profile tab -->
            <!-- About Section -->
            <div class="bg-white p-3 shadow-sm rounded-sm">
              <div
                class="
                  flex
                  items-center
                  space-x-2
                  font-semibold
                  text-gray-900
                  leading-8
                "
              >
                <span clas="text-green-500">
                  <svg
                    class="h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                  </svg>
                </span>
                <span class="tracking-wide">About</span>
              </div>
              <div class="text-gray-700">
                <div class="grid md:grid-cols-2 text-sm">
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Name</div>
                    <div class="px-4 py-2">{{ user.name }}</div>
                  </div>
                  <!-- <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Last Name</div>
                                        <div class="px-4 py-2">Doe</div>
                                    </div> -->
                  <!-- <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Gender</div>
                                        <div class="px-4 py-2">Female</div>
                                    </div> -->
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Contact No.</div>
                    <div class="px-4 py-2">+11 998001001</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Address</div>
                    <div class="px-4 py-2">
                      {{
                        user.detail && user.detail.address
                          ? user.detail.address
                          : "N/A"
                      }}
                    </div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Permanant Address</div>
                    <div class="px-4 py-2">
                      {{
                        user.detail && user.detail.address
                          ? user.detail.address
                          : "N/A"
                      }}
                    </div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Email.</div>
                    <div class="px-4 py-2">
                      <a class="text-blue-800" href="mailto:jane@example.com">{{
                        user.email
                      }}</a>
                    </div>
                  </div>
                  <!-- <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Birthday</div>
                                        <div class="px-4 py-2">Feb 06, 1998</div>
                                    </div> -->
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">course</div>
                    <div class="px-4 py-2">
                      {{
                        user.detail && user.detail.course
                          ? user.detail.course
                          : "N/A"
                      }}
                    </div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">college</div>
                    <div class="px-4 py-2">
                      {{
                        user.detail && user.detail.college
                          ? user.detail.college
                          : "N/A"
                      }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of about section -->

            <div class="my-4"></div>

            <!-- Experience and education -->
            <div class="bg-white p-3 shadow-sm rounded-sm">
              <div class="grid grid-cols-2">
                <div>
                  <div
                    class="
                      flex
                      items-center
                      space-x-2
                      font-semibold
                      text-gray-900
                      leading-8
                      mb-3
                    "
                  >
                    <span clas="text-green-500">
                      <svg
                        class="h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                      </svg>
                    </span>
                    <span class="tracking-wide">Experience</span>
                  </div>
                  <ul
                    class="list-inside space-y-2"
                    v-if="user.detail && user.detail.experience"
                  >
                    <li
                      v-for="(job, index) in user.detail.experience"
                      :key="index"
                    >
                      <div class="text-teal-600">
                        position: {{ job.position }}
                      </div>
                      <div class="text-teal-600">
                        Company: {{ job.company }}
                      </div>
                      <div class="text-gray-500 text-xs">March 2020 - Now</div>
                    </li>
                  </ul>
                </div>
                <!-- <div>
                                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                <path fill="#fff"
                                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Education</span>
                                    </div>
                                    <ul class="list-inside space-y-2">
                                        <li>
                                            <div class="text-teal-600">Masters Degree in Oxford</div>
                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                        </li>
                                        <li>
                                            <div class="text-teal-600">Bachelors Degreen in LPU</div>
                                            <div class="text-gray-500 text-xs">March 2020 - Now</div>
                                        </li>
                                    </ul>
                                </div> -->
              </div>
              <!-- End of Experience and education grid -->
            </div>
            <!-- End of profile tab -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { onMounted, inject, ref } from "@vue/runtime-core";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
import moment from 'moment'
export default {
  setup() {
    const store = useStore();
    const user = ref(null);
    const route = useRoute();
    const router = useRouter();

    const Swal = inject("$Swal");

    onMounted(async () => {
      try {
        store.commit("Loading", true);
        let email = route.params.email;
        user.value = await store.dispatch("user/FETCH_USER", { email });
        store.commit("Loading", false);
      } catch (error) {
        store.commit("Loading", false);
        Swal.fire({
          position: "center",
          icon: "error",
          title: "User Not Found!",
          showConfirmButton: true,
        }).then(() => {
          router.push({ name: "User-List" });
        });
      }
    });

    return { user, moment };
  },
};
</script>



