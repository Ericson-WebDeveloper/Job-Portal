<template>
  <div class="home">
    <section class="relative py-24 px-4">
      <div class="z-20 relative text-white container mx-auto bg-white p-5">
        <h1 class="text-4xl mb-4 text-black">
          Discover more than just a workplace
        </h1>
        <!-- <p class="leading-normal text-black">Search Company's</p> -->

        <form action="" class="mt-3">
          <div class="flex items-center">
            <i
              class="ml-3 fill-current text-gray-400 text-xs z-10 fas fa-search"
            ></i>
            <!-- <input
              type="text"
              class="
                -mx-6
                px-8
                border
                rounded-xl
                py-2
                w-1/2
                text-gray-700
                focus:outline-none
              "
              name="search"
              id="search"
              placeholder="Search Company Here"
            /> -->
          </div>
        </form>
        <!-- <a href="#" class="inline-block bg-blue-500 text-white no-underline hover:bg-blue-800 mt-4 p-4 rounded ml-5">A Call to Action</a> -->
      </div>
      <div class="absolute inset-0 h-auto z-10">
        <img
          src="../../public/images/Employees.jpg"
          alt=""
          class="h-full w-full object-fit-cover"
        />
      </div>
    </section>

    <div class="container mx-auto mt-4" v-if="company">
      <div class="content">
        <div class="shadow-xl">
          <div class="mx-32 flex justify-items-center space-x-3 mb-5 p-2">
            <div class="image-company-header border-2 border-gray-100">
              <img
                :src="
                  company.detail && company.detail.image
                    ? company.detail.image
                    : 'http://localhost:3000/images/download.png'
                "
                class="w-36 h-36"
                alt=""
              />
            </div>
            <div class="company-name address-company space-y-3">
              <h1 class="text-5xl font-bold mt-6">{{ company.name }}</h1>
              <p class="text-gray-600">{{ company.address }}</p>
            </div>
          </div>
        </div>
        <ul
          class="
            nav nav-tabs
            flex flex-col
            md:flex-row
            flex-wrap
            list-none
            border-b-0
            pl-0
            mb-4
          "
          id="tabs-tabFill"
          role="tablist"
        >
          <li class="nav-item flex-auto text-center" role="presentation">
            <a
              href="javascript:void(0);"
              @click="viewTab('overview')"
              class="
                nav-link
                w-full
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                active
              "
              id="tabs-home-tabFill"
              data-bs-toggle="pill"
              data-bs-target="#tabs-homeFill"
              role="tab"
              aria-controls="tabs-homeFill"
              aria-selected="true"
              >Overview</a
            >
          </li>
          <li class="nav-item flex-auto text-center" role="presentation">
            <a
              href="javascript:void(0);"
              class="
                nav-link
                w-full
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
              "
              id="tabs-profile-tabFill"
              data-bs-toggle="pill"
              data-bs-target="#tabs-profileFill"
              role="tab"
              aria-controls="tabs-profileFill"
              aria-selected="false"
              >Review</a
            >
          </li>
          <li class="nav-item flex-auto text-center" role="presentation">
            <a
              href="javascript:void(0);"
              @click="viewTab('jobs')"
              class="
                nav-link
                w-full
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
              "
              id="tabs-messages-tabFill"
              data-bs-toggle="pill"
              data-bs-target="#tabs-messagesFill"
              role="tab"
              aria-controls="tabs-messagesFill"
              aria-selected="false"
              >Jobs</a
            >
          </li>
        </ul>
        <hr class="my-3" />
        <div class="tab-content" id="tabs-tabContentFill">
          <transition-group name="fade1">
            <div
              v-if="panelContent == 'overview'"
              class="tab-pane fade"
              id="tabs-homeFill"
              role="tabpanel"
              aria-labelledby="tabs-home-tabFill"
            >
              <div class="container mx-auto">
                <!-- <div class="main-content1 p-10 md:mx-12 lg:ml-32">
                                <h1 class="text-2xl font-bold">{{ company.name }}</h1>
                                <p class="text-gray-600">{{ company.address }}</p>
                            </div> -->
                <div
                  class="main-content2 p-10 mx-4 md:mx-12 lg:mx-32 bg-gray-100"
                >
                  <div class="review-company mx-auto">
                    Company Reviews published on our site are the views and
                    opinions of their authors and do not represent the views and
                    opinions of JobStreet.com or its personnel. JobStreet.com
                    does not verify the truth or accuracy of any reviews and
                    does not adopt or endorse any of the comments posted.
                    JobStreet.com posts reviews for what they are worth and for
                    information purposes only to assist candidates to find
                    employment.
                  </div>
                </div>

                <div class="main-content3 p-10 mx-4 md:mx-12 lg:mx-32">
                  <h1 class="text-2xl font-bold">Company Overview</h1>
                  <div id="content-overview mt-3" v-if="company.detail">
                    <div
                      class="mt-3"
                      v-html="company.detail.company_overview"
                    ></div>
                  </div>
                </div>

                <div class="main-content4 p-10 mx-4 md:mx-12 lg:mx-32">
                  <h1 class="text-2xl font-bold">Company Other Details</h1>
                  <div
                    class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-3"
                    v-if="company.detail"
                  >
                    <template
                      v-for="(detail, index) in company.detail.additional_info"
                      :key="index"
                    >
                      <div class="flex flex-row p-3 space-x-1">
                        <div class="p-1">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-14 w-14"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </div>
                        <div class="p-3 flex flex-col">
                          <h4>{{ detail.name }}</h4>
                          <p>{{ detail.value }}</p>
                        </div>
                      </div>
                    </template>

                    <!-- <div class="flex flex-row p-3 space-x-1">
                                        <div class="p-1 bg-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="p-3 bg-gray-300 flex flex-col">
                                            <h4>LOCATION</h4>
                                            <p>12th Floor Three World Square Upper McKinley Rd, McKinley Hill, Taguig City, Philippines</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-row p-3 space-x-1">
                                        <div class="p-1 bg-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="p-3 bg-gray-300 flex flex-col">
                                            <h4>LOCATION</h4>
                                            <p>12th Floor Three World Square Upper McKinley Rd, McKinley Hill, Taguig City, Philippines</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-row p-3 space-x-1">
                                        <div class="p-1 bg-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="p-3 bg-gray-300 flex flex-col">
                                            <h4>LOCATION</h4>
                                            <p>12th Floor Three World Square Upper McKinley Rd, McKinley Hill, Taguig City, Philippines</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-row p-3 space-x-1">
                                        <div class="p-1 bg-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="p-3 bg-gray-300 flex flex-col">
                                            <h4>LOCATION</h4>
                                            <p>12th Floor Three World Square Upper McKinley Rd, McKinley Hill, Taguig City, Philippines</p>
                                        </div>
                                    </div> -->
                  </div>
                </div>
              </div>
            </div>

            <div
              v-if="panelContent == 'jobs'"
              class="tab-pane fade"
              id="tabs-profileFill"
              role="tabpanel"
              aria-labelledby="tabs-profile-tabFill"
            >
              <div class="container mx-auto">
                <div class="content-1 p-4">
                  <div
                    class="
                      flex
                      justify-items-center
                      space-x-2
                      md:mx-12
                      lg:ml-32
                    "
                  >
                    <div>
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-14 w-14"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </div>
                    <div class="text-2xl">
                      Usually it takes <em>9 days</em> to process candidates
                    </div>
                  </div>
                </div>
                <hr />
                <div class="content-2 p-4">
                  <div class="mx-4 md:mx-12 lg:mx-32">
                    <h1 class="text-lg">
                      <span>{{ company.jobs.length }}</span> Jobs in Company
                      Name
                    </h1>
                  </div>
                  <div class="jobs-list mx-4 md:mx-12 lg:mx-32 mt-3">
                    <div
                      class="
                        grid grid-cols-1
                        md:grid-cols-2
                        lg:grid-cols-3
                        gap-3
                        p-1
                      "
                    >
                      <div
                        class="p-3 border-4 border-dashed"
                        v-for="(job, index) in company_jobs.data"
                        :key="index"
                      >
                        <div class="flex flex-col space-y-3">
                          <router-link
                            :to="{
                              name: 'Job',
                              params: { job: `${job.id}-${job.title}` },
                            }"
                            class="text-blue-500"
                            ><h1 class="text-2xl">
                              {{ job.title }}
                            </h1></router-link
                          >
                          <p class="text-gray-500">{{ company.name }}</p>
                          <div class="flex space-x-2">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-5 w-5"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                              />
                              <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"
                              />
                            </svg>
                            <p class="text-gray-500">
                              {{ job.specialization }}
                            </p>
                          </div>
                          <div class="flex space-x-2">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-5 w-5"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"
                              />
                            </svg>
                            <p class="text-gray-500">{{ company.address }}</p>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="p-3 border-4 border-dashed">
                                            <div class="flex flex-col space-y-3">
                                                <a href="javascript:void(0);" class="text-blue-500"><h1 class="text-2xl">PHP Dev</h1></a>
                                                <p class="text-gray-500">B2B inc.</p>
                                                <div class="flex space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                                    </svg>
                                                    <p class="text-gray-500">Min 5 years Exp: (Php Programmer)</p>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-gray-500">Philippines National Region</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-3 border-4 border-dashed">
                                            <div class="flex flex-col space-y-3">
                                                <a href="javascript:void(0);" class="text-blue-500"><h1 class="text-2xl">PHP Dev</h1></a>
                                                <p class="text-gray-500">B2B inc.</p>
                                                <div class="flex space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                                    </svg>
                                                    <p class="text-gray-500">Min 5 years Exp: (Php Programmer)</p>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-gray-500">Philippines National Region</p>
                                                </div>
                                            </div>
                                        </div> -->
                    </div>
                    <div class="flex justify-center mt-5 mb-5">
                      <a
                        href="javascript:void(0);"
                        v-if="company_jobs.prev_page_url"
                        class="
                          flex
                          items-center
                          px-4
                          py-2
                          text-gray-500
                          bg-gray-300
                          rounded-md
                          hover:bg-blue-400 hover:text-white
                        "
                        disabled
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="w-6 h-6"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12"
                          />
                        </svg>
                      </a>
                      <div class="justify-items-center space-x-2 ml-3 mr-3">
                        <span>Page</span>
                        <select
                          name=""
                          id=""
                          class="p-1 border-2 rounded-lg border-black w-20"
                        >
                          <template
                            v-for="(list, index) in company_jobs.links"
                            :key="index"
                          >
                            <option value="1" v-if="parseInt(list.label)">
                              {{ list.label }}
                            </option>
                          </template>
                        </select>
                        <span class=""> of {{ company_jobs.last_page }}</span>
                      </div>
                      <a
                        href="javascript:void(0);"
                        v-if="company_jobs.next_page_url"
                        class="
                          px-4
                          py-2
                          text-gray-500
                          bg-gray-300
                          rounded-md
                          hover:bg-blue-400 hover:text-white
                        "
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="w-6 h-6"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"
                          />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </transition-group>

          <!-- <div class="tab-pane fade" id="tabs-messagesFill" role="tabpanel" aria-labelledby="tabs-profile-tabFill">
                        Tab 3 content fill
                    </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, ref } from "@vue/reactivity";
import { inject } from "vue";
import { useRouter, useRoute } from "vue-router";
import { onMounted } from "@vue/runtime-core";
import { useStore } from "vuex";
export default {
  components: {},
  setup() {
    const store = useStore();
    const company = ref(computed(() => store.getters["company/GET_COMPANY2"]));
    const company_jobs = ref(
      computed(() => store.getters["jobs/GET_COMPANY_JOBS"])
    );
    const SwalAlert = inject("$Swal");
    const panelContent = ref("overview");
    const route = useRoute();
    const router = useRouter();
    onMounted(async () => {
      try {
        company.value = null;
        store.commit("Loading", true);
        await store.dispatch(
          "company/FETCH_PUBLIC_COMPANY",
          route.params.company.split("-")[0]
        );
        await store.dispatch("jobs/FETCH_PUBLIC_COMPANYJOB", {
          company_id: route.params.company.split("-")[0],
        });
      } catch (error) {
        SwalAlert.fire({
          position: "center",
          icon: "error",
          title: "Company Data Not Found",
          showConfirmButton: true,
        }).then(() => {
          router.push({ name: "Home" });
        });
      } finally {
        store.commit("Loading", false);
      }
    });

    const viewTab = (tab) => {
      panelContent.value = tab;
      router.push({ query: { tab } });
    };

    return {
      viewTab,
      panelContent,
      company,
      company_jobs,
    };
  },
};
</script>

<style scoped>
.fade1-enter-active {
  transition: all 0.4s ease;
}

.fade1-enter-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: scale(1);
}
.fade1-enter-from {
  opacity: 1;
  transform: scale(0.6);
}
.fade1-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 1;
  transform: scale(0.6);
}

.fade1-leave-active {
  transition: all 0.4s ease;
}
.fade1-leave-from {
  opacity: 0;
  transform: scale(1);
}
</style>