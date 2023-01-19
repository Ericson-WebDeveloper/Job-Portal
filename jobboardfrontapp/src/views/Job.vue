<template>
  <div class="Job-content" v-if="job">
    <!-- <search-input></search-input> -->
    <div class="container mx-auto mt-0">
      <div class="content mx-32 mb-3">
        <div class="flex flex-col mx-24 shadow-xl p-1">
          <div class="img-banner-company border-b-2">
            <img v-if="job.company && job.company.detail && job.company.detail.image"
              :src="job.company.detail.image"
              class="object-fill h-72 w-full"
              alt=""
            />
          </div>
          <div
            class="img-company-logo"
            v-if="job.company && job.company.detail && job.company.detail.image"
          >
            <img
              :src="job.company.detail.image"
              class="h-32 w-34 ml-3"
              alt=""
            />
          </div>
        </div>
        <div class="content details mx-24 shadow-xl p-5">
          <div class="flex justify-between px-5 pt-3">
            <h1 class="text-2xl font-bold font-serif">{{ job.title }}</h1>
            <button
            @click="applyingJob"
              class="
                p-2
                rounded
                bg-purple-500
                text-white
                cursor-pointer
                px-28
                py-2"
                v-if="!applied"
            >
              Apply now
            </button>
          </div>
          <div class="flex flex-col px-5 space-y-2">
            <h4 class="font-semibold text-xl">{{ job.company.name }}</h4>
            <h4
              class="font-semibold text-sm"
              v-if="job.detail.salary || job.detail.salary != 'N/A'"
            >
              {{ job.detail.salary }}
            </h4>
            <h4 class="font-semibold text-sm">
              Posted {{ moment(job.created_at).startOf("hour").fromNow() }}
            </h4>
          </div>
        </div>
      </div>

      <div class="content mx-32 mb-3">
        <div class="flex flex-col mx-24 bg-white shadow-xl px-6 py-5">
          <h1 class="text-2xl font-bold font-serif mb-5">Job Description</h1>
          <div class="" v-html="job.detail.job_details"></div>

          <hr class="my-5" />
          <h1 class="mt-5 text-2xl font-bold font-serif">
            Additional Information
          </h1>
          <div class="grid grid-cols-2 gap-4">
            <template
              v-for="(info, index) in job.detail.additional_details"
              :key="index"
            >
              <div class="my-5">
                <h1 class="font-bold font-serif text-xl">{{ info.name }}</h1>
                <h3 class="font-semibold font-serif text-sm">
                  {{ info.value }}
                </h3>
              </div>
            </template>
          </div>

          <hr class="my-5" />
          <h1 class="mt-5 text-2xl font-bold font-serif mb-5">
            Company Overview
          </h1>
          <div v-html="job.company.detail.company_overview"></div>

          <hr class="my-5" />
          <h1 class="mt-5 text-2xl font-bold font-serif">
            Additional Company Information
          </h1>
          <div class="grid grid-cols-2 gap-4">
            <template
              v-for="(info, index) in job.company.detail.additional_info"
              :key="index"
            >
              <div class="my-5">
                <h1 class="font-bold font-serif text-xl">{{ info.name }}</h1>
                <h3 class="font-serif text-sm">{{ info.value }}</h3>
              </div>
            </template>
          </div>

          <hr class="mt-24 mb-16" />

          <!-- <h2 class="mb-5 text-lg font-bold">Company photos</h2>
          <div class="carousel relative rounded overflow-hidden shadow-xl">
            <div class="carousel-inner relative overflow-hidden w-full">
              Slide 1
              <input
                class="carousel-open"
                type="radio"
                id="carousel-1"
                name="carousel"
                aria-hidden="true"
                hidden=""
                checked="checked"
              />
              <div
                class="carousel-item absolute opacity-0 bg-center"
                style="
                  height: 500px;
                  background-image: url(https://mdbootstrap.com/img/new/slides/052.jpg);
                "
              >
              </div>

              <label
                for="carousel-3"
                class="
                  control-1
                  w-10
                  h-10
                  ml-2
                  md:ml-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  left-0
                  my-auto
                  flex
                  justify-center
                  content-center
                "
                ><i class="fas fa-angle-left mt-3"></i
              ></label>
              <label
                for="carousel-2"
                class="
                  next
                  control-1
                  w-10
                  h-10
                  mr-2
                  md:mr-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  right-0
                  my-auto
                "
                ><i class="fas fa-angle-right mt-3"></i
              ></label>

              Slide 2
              <input
                class="carousel-open"
                type="radio"
                id="carousel-2"
                name="carousel"
                aria-hidden="true"
                hidden=""
              />
              <div
                class="carousel-item absolute opacity-0 bg-center"
                style="
                  height: 500px;
                  background-image: url(https://mdbootstrap.com/img/new/slides/043.jpg);
                "
              ></div>
              <label
                for="carousel-1"
                class="
                  control-2
                  w-10
                  h-10
                  ml-2
                  md:ml-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  left-0
                  my-auto
                "
                ><i class="fas fa-angle-left mt-3"></i
              ></label>
              <label
                for="carousel-3"
                class="
                  next
                  control-2
                  w-10
                  h-10
                  mr-2
                  md:mr-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  right-0
                  my-auto
                "
                ><i class="fas fa-angle-right mt-3"></i
              ></label>

              Slide 3
              <input
                class="carousel-open"
                type="radio"
                id="carousel-3"
                name="carousel"
                aria-hidden="true"
                hidden=""
              />
              <div
                class="carousel-item absolute opacity-0"
                style="
                  height: 500px;
                  background-image: url(https://mdbootstrap.com/img/new/slides/054.jpg);
                "
              ></div>
              <label
                for="carousel-2"
                class="
                  control-3
                  w-10
                  h-10
                  ml-2
                  md:ml-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  left-0
                  my-auto
                "
                ><i class="fas fa-angle-left mt-3"></i
              ></label>
              <label
                for="carousel-1"
                class="
                  next
                  control-3
                  w-10
                  h-10
                  mr-2
                  md:mr-10
                  absolute
                  cursor-pointer
                  hidden
                  font-bold
                  text-black
                  hover:text-white
                  rounded-full
                  bg-white
                  hover:bg-blue-700
                  leading-tight
                  text-center
                  z-10
                  inset-y-0
                  right-0
                  my-auto
                "
                ><i class="fas fa-angle-right mt-3"></i
              ></label>

              Add additional indicators for each slide
              <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                  <label
                    for="carousel-1"
                    class="
                      carousel-bullet
                      cursor-pointer
                      block
                      text-4xl text-white
                      hover:text-blue-700
                    "
                    >•</label
                  >
                </li>
                <li class="inline-block mr-3">
                  <label
                    for="carousel-2"
                    class="
                      carousel-bullet
                      cursor-pointer
                      block
                      text-4xl text-white
                      hover:text-blue-700
                    "
                    >•</label
                  >
                </li>
                <li class="inline-block mr-3">
                  <label
                    for="carousel-3"
                    class="
                      carousel-bullet
                      cursor-pointer
                      block
                      text-4xl text-white
                      hover:text-blue-700
                    "
                    >•</label
                  >
                </li>
              </ol>
            </div>
          </div> -->

          <hr class="mt-24 mb-16" />

          <router-link
            :to="{
              name: 'searchjob',
              params: { key: `jobs-at-${formattingUrl(job.company.name)}` },
            }"
            class="text-blue-600 hover:underline mb-32"
            >More Jobs on this employeer?</router-link
          >
          <hr />
        </div>
      </div>
    </div>
    <apply-job-modal
        :ApplyJob="ApplyJob"
        :jobData="job"
        :SwalAlert="SwalAlert"
        @successApply="successApply"
      ></apply-job-modal>

  </div>
</template>

<script>
// @ is an alias to /src
//import SearchInput from '@/components/SearchInput';
import { useRouter, useRoute } from "vue-router";
import { useStore } from "vuex";
import { computed, inject, onMounted, ref, watch } from "vue";
import ApplyJobModal from "@/components/ApplyJobModal";

export default {
  components: {
    ApplyJobModal,
  },
  setup() {

    const store = useStore();
    const route = useRoute();
    const router = useRouter();
    const SwalAlert = inject("$Swal");
    const moment = inject("$moment");
    const job = ref(computed(() => store.getters["jobs/GET_JOB2"]));

    const applied = ref(false);
    const ApplyJob = ref(computed(() => store.state.ApplyJobModal));
    const user = ref(computed(() => store.getters["user/GET_USER_DATA"]));

    const formattingUrl = (url) => {
      return url.replace(/\s/g, "-");
    };

    watch(
      () => job,
      () => {
        checkingApplication();
      }
    );

    const checkingApplication = () => {
      applied.value = false;
      if (user.value) {
        let { applications } = user.value;
        console.log(user.value);
        Array.from(applications).forEach((app) => {
          if (app.job_id == job.value.id) {
            applied.value = true;
          }
        });
      } else {
        applied.value = false;
      }
    };

    const successApply = async () => {
      try {
        store.commit("Loading", true);
        await store.dispatch("auth/GET_USER");
        checkingApplication();
      } catch (error) {
        window.location.reload();
      } finally {
        store.commit("Loading", false);
      }
    };

    const applyingJob = async () => {
      try {
        store.commit("Loading", true);
        let data = await store.dispatch("auth/VERIFY_USER");
        await store.dispatch("auth/GET_USER");
        // if(data == 1) {
        if (data.authenticate) {
          // Open Modal
          checkingApplication();
          if (applied.value) {
            SwalAlert.fire({
              position: "center",
              icon: "error",
              title:
                "Cannot Apply for this job now. you have aleardy apply for this job.",
              showConfirmButton: true,
            });
          } else {
            store.commit("Open_Close_Modal", "ApplyJobModal");
          }
        } else {
          localStorage.setItem("routeBack", router.currentRoute.value.path);
          router.push({ name: "Login" });
        }
      } catch (error) {
        if (error.status == 401) {
          localStorage.setItem("routeBack", router.currentRoute.value.path);
          router.push({ name: "Login" });
        } else {
          SwalAlert.fire({
            position: "center",
            icon: "error",
            title: "Cannot Apply for this job now. please try again later.",
            showConfirmButton: true,
          });
        }
      } finally {
        store.commit("Loading", false);
      }
    };

    onMounted(async () => {
      try {
        store.commit("Loading", true);
        await store.dispatch(
          "jobs/FETCH_PUBLIC_JOB",
          route.params.job.split("-")[0]
        );
      } catch (error) {
        SwalAlert.fire({
          position: "center",
          icon: "error",
          title: "Job Data Not Found",
          showConfirmButton: true,
        }).then(() => {
          router.push({ name: "Home" });
        });
      } finally {
        store.commit("Loading", false);
      }
      checkingApplication()
    });

    const closeJob = () => {
      window.location.reload()
      // context.emit("closeJob");
      // checkingApplication();
    };

    return {
      job,
      moment,
      formattingUrl,
      SwalAlert,
      checkingApplication,
      applied,
      ApplyJob,
      applyingJob,
      successApply,
      closeJob
    };
  },
};
</script>

<style scoped>
.carousel-open:checked + .carousel-item {
  position: static;
  opacity: 100;
}

.carousel-item {
  -webkit-transition: opacity 0.6s ease-out;
  transition: opacity 0.6s ease-out;
}

#carousel-1:checked ~ .control-1,
#carousel-2:checked ~ .control-2,
#carousel-3:checked ~ .control-3 {
  display: block;
}

.carousel-indicators {
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  bottom: 2%;
  left: 0;
  right: 0;
  text-align: center;
  z-index: 10;
}

#carousel-1:checked
  ~ .control-1
  ~ .carousel-indicators
  li:nth-child(1)
  .carousel-bullet,
#carousel-2:checked
  ~ .control-2
  ~ .carousel-indicators
  li:nth-child(2)
  .carousel-bullet,
#carousel-3:checked
  ~ .control-3
  ~ .carousel-indicators
  li:nth-child(3)
  .carousel-bullet {
  color: #2b6cb0;
  /*Set to match the Tailwind colour you want the active one to be */
}
</style>
