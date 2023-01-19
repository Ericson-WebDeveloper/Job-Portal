<template>
  <div id="showjobcomp" class="hidden">
    <div class="flex justify-between">
      <router-link
        :to="{ name: 'Job', params: { job: job.id } }"
        target="_blank"
        class="cursor-pointer rounded-xl text-blue-500 hover:bg-white p-1"
      >
        Show to other Tab
      </router-link>
      <a
        href="javascript:void(0);"
        @click="closeJob"
        class="cursor-pointer rounded-xl text-blue-500 hover:bg-white p-1"
        >Close</a
      >
    </div>
    <div class="container mx-auto mt-2" v-if="job">
      <div class="content mb-3">
        <div class="flex flex-col mx-24 shadow-xl p-1">
          <div class="img-banner-company border-b-2">
            <img v-if="job?.company?.detail?.image"
            :src="job.company.detail.image"
              class="object-fill h-72 w-full"
              alt=""
            />
          </div>
          <div class="img-company-logo" v-if="job?.company?.detail?.image">
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
              type="button"
              @click.prevent="applyingJob"
              class="
                p-2
                rounded
                bg-purple-500
                text-white
                cursor-pointer
                px-28
                py-2
              "
              v-if="!applied"
            >
              Apply now
            </button>
          </div>
          <div class="flex flex-col px-5 space-y-2">
            <h4 class="font-semibold text-xl">{{ job.company.name }}</h4>
            <!-- || job.detail.salary != 'N/A' -->
            <h4 class="font-semibold text-sm" v-if="job?.detail?.salary">
              {{ job.detail.salary }}
            </h4>
            <h4 class="font-semibold text-sm">
              Posted {{ moment(job.created_at).startOf("hour").fromNow() }}
            </h4>
          </div>
        </div>
      </div>

      <div class="content mb-3">
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

          <h2 class="mb-5 text-lg font-bold">Company photos</h2>
          <div
            class="carousel relative rounded relative overflow-hidden shadow-xl"
          >
            <div class="carousel-inner relative overflow-hidden w-full">
              <!--Slide 1-->
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
                <!-- <p class="text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis tempore quisquam alias molestiae explicabo aliquid nisi! Quas repellendus impedit soluta? Odio </p> -->
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

              <!--Slide 2-->
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

              <!--Slide 3-->
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

              <!-- Add additional indicators for each slide-->
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
          </div>

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
      <apply-job-modal
        :ApplyJob="ApplyJob"
        :jobData="jobData"
        :SwalAlert="SwalAlert"
        @successApply="successApply"
      ></apply-job-modal>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
import { computed, inject, onMounted, ref, watch } from "vue";
import { useRouter } from "vue-router";
import ApplyJobModal from "@/components/ApplyJobModal";
export default {
  components: {
    ApplyJobModal,
  },

  props: {
    job: Object,
    moment: Function,
  },

  setup(props, context) {
    const store = useStore();
    const router = useRouter();
    const SwalAlert = inject("$Swal");
    const jobData = ref(props.job);

    const applied = ref(false);

    const ApplyJob = ref(computed(() => store.state.ApplyJobModal));
    const user = ref(computed(() => store.getters["user/GET_USER_DATA"]));

    const formattingUrl = (url) => {
      return url.replace(/\s/g, "-");
    };

    watch(
      () => props.job,
      () => {
        // checkingApplication();
      }
    );

    const closeJob = () => {
      context.emit("closeJob");
      // checkingApplication();
    };

    const checkingApplication = () => {
      applied.value = false;
      if (user.value) {
        let { applications } = user.value;
        // console.log(app.job_id, jobData.value.id)
        applied.value = Array.from(applications).some((app) => app.job_id == jobData.value.id);
        // Array.from(applications).forEach((app) => {
        //   // console.log(app.job_id, jobData.value.id);
        //   if (app.job_id == jobData.value.id) {
        //       applied.value = true;
        //   }
        // });
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

    onMounted(async () => {
      try {
       await store.dispatch("auth/VERIFY_USER");
      //  let data = 
        // if (data == 1) {
        // if (data.authenticate) {
        //   await store.dispatch("auth/GET_USER");
        //   checkingApplication();
        // }
        document.getElementById("showjobcomp").classList.remove("hidden");
      } catch (error) {
        document.getElementById("showjobcomp").classList.remove("hidden");
      } finally {
        document.getElementById("showjobcomp").classList.remove("hidden");
      }
    });

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
              title: "Cannot Apply for this job now. you have aleardy apply for this job.",
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

    return {
      formattingUrl,
      closeJob,
      applyingJob,
      ApplyJob,
      jobData,
      SwalAlert,
      checkingApplication,
      applied,
      successApply,
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
