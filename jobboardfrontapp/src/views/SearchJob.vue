<template>
  <div class="search-jobs">
    <!-- <keep-alive include="search">
      <component :is="selectedComp" :search="search"></component>
    </keep-alive> -->
    <search-input :search="search"></search-input>
    <!-- <search-input :is="view" ></search-input> -->
    <div class="container mx-auto">
      <div class="content">
        <div id="job-content-list">
          <p
            class="mb-2 ml-12 text-lg font-serif"
            v-if="searchjobs?.data && searchjobs.data.length > 0"
          >
            <b
              >{{ searchjobs.to - searchjobs.data.length + 1 }}-{{
                searchjobs.to
              }}</b
            >
            of <b>{{ searchjobs.total }}</b> jobs
          </p>

          <!-- v-if="searchjobs.data && searchjobs.data.length > 0" -->
          <div class="flex flex-row gap-4 h-screen">
            <!-- flex-col -->

            <div
              class="w-full lg:w-2/5 items-center overflow-y-auto"
              v-if="searchjobs.data && searchjobs.data.length > 0"
            >
              <!-- v-if="searchjobs.data.length > 0" -->
              <div class="flex flex-col">
                <!-- max-h-full -->
                <template v-for="(job, index) in searchjobs.data" :key="index">
                  <div class="mb-2 cursor-pointer" @click="showDetails(job.id)">
                    <div
                      class="
                        max-w-auto
                        mx-4
                        rounded
                        overflow-hidden
                        shadow-lg
                        p-2
                        border-l-8 border-green-800
                      "
                    >
                      <img
                        class="w-48"
                        :src="
                          job.company.detail?.image
                            ? job.company.detail.image
                            : '../../public/images/download.png'
                        "
                        alt="Sunset in the mountains"
                      />
                      <div class="px-6 py-4">
                        <div class="mb-2">
                          <router-link
                            :to="{ name: 'Job', params: { job: job.id } }"
                            class="font-bold text-xl text-blue-500"
                            >{{ job.title }}</router-link
                          >
                          <br />
                          <router-link
                            :to="{
                              name: 'Company',
                              params: {
                                company: `${job.company.id}-${job.company.name}`,
                              },
                            }"
                            class=""
                          >
                            <p class="font-bold hover:underline">
                              {{ job.company.name }}
                            </p>
                          </router-link>
                          <!-- link to show job Details -->
                        </div>
                        <p class="text-gray-700 text-base">
                          {{ job.company.address }}
                        </p>
                        <p class="text-gray-700 text-base">
                          {{ job?.detail?.salary }}
                        </p>
                        <br /><br />
                        <p class="text-gray-700 text-base">
                          {{ moment(job.created_at).startOf("hour").fromNow() }}
                        </p>
                        <button
                          type="button"
                          class="
                            p-2
                            rounded
                            bg-purple-500
                            text-white
                            cursor-pointer
                            block
                            lg:hidden
                          "
                        >
                          <router-link
                            :to="{ name: 'Job', params: { job: job.id } }"
                            target="_blank"
                            class="cursor-pointer p-1"
                          >
                            View Job
                          </router-link>
                        </button>
                      </div>
                      <div class="px-6 pt-4 pb-2">
                        <span v-for="(name, index) in job.specialize_names" :key="index"
                          class="
                            inline-block
                            bg-gray-200
                            rounded-full
                            px-3
                            py-1
                            text-sm
                            font-semibold
                            text-gray-700
                            mr-2
                            mb-2
                          "
                          >#{{ name }}</span
                        >
                       
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Pagination -->

                <div
                  class="flex justify-center space-x-1 mt-5 mb-10"
                  v-if="searchjobs?.data"
                >
                  <a
                    href="javascript:void(0);"
                    class="
                      px-4
                      py-2
                      font-bold
                      text-gray-500
                      bg-gray-300
                      rounded-md
                      hover:bg-blue-400 hover:text-white
                    "
                    v-if="searchjobs.prev_page_url"
                    @click.prevent="
                      apiSerachRequest(
                        parseInt(searchjobs.current_page) - 1,
                        search
                      )
                    "
                  >
                    Previous
                  </a>
                  <template v-if="page1.data > 0">
                    <a
                      href="javascript:void(0);"
                      class="
                        px-4
                        py-2
                        text-gray-700
                        bg-gray-200
                        rounded-md
                        hover:bg-blue-400 hover:text-white
                      "
                      v-if="
                        page1[0]?.page == searchjobs.current_page &&
                        searchjobs.prev_page_url &&
                        ![1, 2, 3].includes(searchjobs.current_page)
                      "
                    >
                      ...
                    </a>
                  </template>

                  <template v-for="(page, index) in page1" :key="index">
                    <a
                      href="javascript:void(0);"
                      class="
                        px-4
                        py-2
                        text-gray-700
                        bg-gray-200
                        rounded-md
                        hover:bg-blue-400 hover:text-white
                      "
                      @click.prevent="apiSerachRequest(page.page, search)"
                      :class="{
                        'z-10 bg-indigo-400 border-indigo-300 text-indigo-600':
                          page.page == searchjobs.current_page,
                      }"
                    >
                      {{ page.page }}
                    </a>
                  </template>
                  <template v-if="page1.data > 0">
                    <a
                      href="javascript:void(0);"
                      class="
                        px-4
                        py-2
                        text-gray-700
                        bg-gray-200
                        rounded-md
                        hover:bg-blue-400 hover:text-white
                      "
                      v-if="
                        page1[page1.length - 1].page ==
                          searchjobs.current_page && searchjobs.next_page_url
                      "
                    >
                      ...
                    </a>
                  </template>
                  <a
                    href="javascript:void(0);"
                    class="
                      px-4
                      py-2
                      font-bold
                      text-gray-500
                      bg-gray-300
                      rounded-md
                      hover:bg-blue-400 hover:text-white
                    "
                    v-if="searchjobs.next_page_url"
                    @click.prevent="
                      apiSerachRequest(
                        parseInt(searchjobs.current_page) + 1,
                        search
                      )
                    "
                  >
                    Next
                  </a>
                </div>
              </div>
            </div>
            <!-- lg:block  -->
            <div
              class="lg:block w-full bg-gray-100 hidden overflow-y-auto"
              :class="{ 'w-full mx-auto': !searchjobs.data }"
            >
              <!-- :class="{'w-full mx-auto': !searchjobs.data}" flex flex-col -->
              <div class="content p-2">
                <template v-if="!showJobData">
                  <div class="mx-auto justify-items-center flex flex-col">
                    <img
                      class="w-3/4 h-full mx-auto"
                      src="http://localhost:3000/images/job-searching-700x400.jpg"
                      alt=""
                    />
                    <h1 class="mx-auto text-2xl font-serif">
                      We have 9,327 jobs for you
                    </h1>
                    <h3 class="mx-auto text-lg font-serif">
                      Select a job to view details
                    </h3>
                  </div>
                </template>
                <template v-else>
                  <div id="content-job-details">
                    <show-job
                      :job="showJobData"
                      :moment="moment"
                      @closeJob="closeJob"
                    ></show-job>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import SearchInput from "@/components/SearchInput";
import ShowJob from "@/components/ShowJob";
import { computed, inject, onMounted, reactive, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import Paginations from "@/helper/Paginations";
export default {
  name: "Home",
  components: {
    SearchInput,
    ShowJob,
  },

  setup() {
    const search = reactive({
      keyword: "",
      location: "",
      specialization: "",
    });
    const moment = inject("$moment");
    const searchjobs = ref(
      computed(() => store.getters["jobs/GET_SEARCH_JOBS"])
    );
    const showJobData = ref(null);

    const selectedComp = ref("search-input");
    const loaded = ref(false);
    const SwalAlert = inject("$Swal");
    const store = useStore();
    const page1 = ref([]);

    //const router = useRouter();
    const route = useRoute();

    const closeJob = () => {
      showJobData.value = null;
    };

    const formattingUrl = (url) => {
      return url.replace(/\s/g, "-");
    };

    const apiSerachRequest = async (pageno = null, data) => {
      document.getElementById("keylist").classList.add("hidden");
      document.getElementById("keylist2").classList.add("hidden");
      document.getElementById("keylist3").classList.add("hidden");
      try {
        store.commit("Loading", true);
        data.page = "searchjob";
        await store.dispatch("jobs/SEARCHING_JOB", {
          pageno: pageno,
          datas: data,
        });
        closeJob();
        //if(searchjobs.value.data.length > 0) {
        new Paginations(3, searchjobs, page1);
        //}
      } catch (error) {
        SwalAlert.fire({
          position: "center",
          icon: "error",
          title: "Server Cannot Connect",
          showConfirmButton: true,
        });
      } finally {
        // if(!document.getElementById("keylist").classList.contains('hidden')) {
        //    document.getElementById("keylist").classList.add('hidden');
        // }
        // if(!document.getElementById("keylist2").classList.contains('hidden')) {
        //    document.getElementById("keylist2").classList.add('hidden');
        // }
        store.commit("Loading", false);
      }
    };

    onMounted(async () => {
      loaded.value = false;
      search.specialization = route.query.specialization
        ? route.query.specialization.replaceAll("&", "-")
        : "";
      window.addEventListener("load", (event) => {
        event.preventDefault();
        loaded.value = true;
      });

      if (!loaded.value) {
        if (route.params.key.split("-").includes("at")) {
          search.keyword = route.params.key
            .substring(route.params.key.indexOf("at") + 3)
            .replace(/-/g, " ");
        }

        if (route.params.key.split("-").includes("in")) {
          let routekey = route.params.key;
          let routekey2 = route.params.key;
          // search.keyword = route.params.key.substring(route.params.key.indexOf('in') - 3).replace(/-/g, ' ');
          search.keyword = routekey
            .substr(0, routekey.indexOf("-jobs") - 0)
            .replace(/-/g, " ");
          // search.keyword = route.params.key.substring(route.params.key.indexOf('jobs') - 5).replace(/-/g, ' ');
          search.location =
            routekey2
              .substring(routekey2.indexOf("in-") + 3)
              .replace(/-/g, " ") ?? "";
        } else {
          if (route.params.key.split("-").includes("jobs")) {
            let routekey = route.params.key;
            search.keyword = routekey
              .substr(0, routekey.indexOf("-jobs") - 0)
              .replace(/-/g, " ");
          }
        }

        // if(route.query.specialization) {
        // change
        //   search.specialization = route.query.specialization;
        // }
        // if(route.params.key.split("-").includes('vacancy')) {
        //   alert('select all jobs recently post')
        // }

        await apiSerachRequest(null, search);
      } else {
        new Paginations(3, searchjobs, page1);
        return false;
      }
    });

    const showDetails = async (id) => {
      try {
        store.commit("Loading", true);
        let job = await store.dispatch("jobs/FETCH_PUBLIC_JOB", id);
        showJobData.value = job;
      } catch (error) {
        SwalAlert.fire({
          position: "center",
          icon: "error",
          title: "Unable to Show Details",
          showConfirmButton: true,
        });
      } finally {
        store.commit("Loading", false);
      }
    };

    return {
      search,
      selectedComp,
      searchjobs,
      showJobData,
      showDetails,
      moment,
      closeJob,
      page1,
      apiSerachRequest,
      formattingUrl,
    };
  },
};
</script>
