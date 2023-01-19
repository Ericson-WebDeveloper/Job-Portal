<template>
  <div
    class="
      h-screen
      w-full
      fixed
      left-0
      top-0
      flex
      justify-center
      items-center
      bg-black bg-opacity-50
      overflow-y-auto
    "
    :class="[jobAdd ? '' : 'hidden']"
  >
    <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
      <div class="flex justify-between border-b px-4 py-2">
        <h1 class="text-2xl font-bold font-serif">Add New Job</h1>
        <svg
          @click.prevent="closeModalAdd()"
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>

      <div class="p-3">
        <div class="mx-auto">
          <div class="">
            <div class="mt-2 bg-white rounded-lg shadow">
              <div class="px-5 pb-5">
                <label
                  for="email"
                  class="block text-xl font-semibold text-gray-600"
                  >Title</label
                >
                <input
                  v-model="job.title"
                  placeholder="Title"
                  class="
                    text-black
                    placeholder-gray-600
                    w-full
                    px-4
                    py-2.5
                    mt-2
                    text-base
                    transition
                    duration-500
                    ease-in-out
                    transform
                    border-transparent
                    rounded-lg
                    bg-gray-200
                    focus:border-blueGray-500 focus:bg-white
                    dark:focus:bg-gray-800
                    focus:outline-none focus:shadow-outline focus:ring-2
                    ring-offset-current ring-offset-2 ring-gray-400
                  "
                />
                <div class="flex flex-col md:flex-row">
                  <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                    <label
                      for="email"
                      class="block text-xl font-semibold text-gray-600"
                      >Position</label
                    >
                    <input
                      v-model="job.position"
                      placeholder="Position"
                      class="
                        text-black
                        placeholder-gray-600
                        w-full
                        px-4
                        py-2.5
                        mt-2
                        text-base
                        transition
                        duration-500
                        ease-in-out
                        transform
                        border-transparent
                        rounded-lg
                        bg-gray-200
                        focus:border-blueGray-500 focus:bg-white
                        dark:focus:bg-gray-800
                        focus:outline-none focus:shadow-outline focus:ring-2
                        ring-offset-current ring-offset-2 ring-gray-400
                      "
                    />
                  </div>
                  <div class="w-full md:flex-grow md:w-2/4">
                    <label
                      for="email"
                      class="block text-xl font-semibold text-gray-600"
                      >Specialization</label
                    >
                    <!-- <input v-model="job.specialization" placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                        focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                        focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"> -->
                    <!-- <select v-model="job.specialization" name="" id="" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                        transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                        focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                        focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            <option value="" disabled selected>Select Specialize</option>
                                            <template v-for="(spec, index) in specializes" :key="index">
                                                <option :value="spec">{{ spec }}</option>
                                            </template>
                                        </select> -->

                    <i
                      class="
                        absolute
                        ml-3
                        mt-6
                        items-centerfill-current
                        text-gray-400 text-xs
                        z-10
                        fas
                        fa-user-md
                      "
                    ></i>
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer absolute mt-4 left-24" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                            @click.prevent="showSelection('keylist3')">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg> -->
                    <input
                      class="
                        text-black
                        placeholder-gray-600
                        w-full
                        px-4
                        py-2.5
                        mt-2
                        text-base
                        transition
                        duration-500
                        ease-in-out
                        transform
                        border-transparent
                        rounded-lg
                        bg-gray-200
                        focus:border-blueGray-500 focus:bg-white
                        dark:focus:bg-gray-800
                        focus:outline-none focus:shadow-outline focus:ring-2
                        ring-offset-current ring-offset-2 ring-gray-400
                      "
                      id="grid-last-name"
                      type="text"
                      v-model="specializeName"
                      readonly
                      placeholder="   All Specialization"
                      @click.prevent="showSelection('keylist3')"
                    />

                    <ul
                      class="
                        absolute
                        mt-18
                        bg-white
                        rounded-lg
                        text-left
                        overflow-y-auto
                        h-52
                        border-2
                        z-10
                        hidden
                      "
                      id="keylist3"
                      style="width: 380px"
                    >
                      <ul class="p-2">
                        <li class="text-mono text-xl">
                          <input type="checkbox" class="" id="box-all" />
                          <span class="text-value"> All Specialization</span>
                        </li>
                        <hr />
                      </ul>
                      <template v-if="spexialiaxations.length > 0">
                        <ul
                          class="p-2"
                          v-for="(spec, index) in spexialiaxations"
                          :key="index"
                        >
                          <li class="text-mono text-xl">
                            <input
                              type="checkbox"
                              class="box"
                              :data-name="spec.name"
                              :data-id="spec.id"
                              data-type="parent"
                            />
                            <span class="text-value ml-2">
                              {{ spec.name }}
                            </span>

                            <ul
                              class="nested py-2 hidden"
                              v-if="spec?.subspecializations"
                            >
                              <li
                                class="ml-6"
                                v-for="(
                                  specc, index
                                ) in spec.subspecializations"
                                :key="index"
                              >
                                <input
                                  type="checkbox"
                                  class="box-child"
                                  :data-name="specc.name"
                                  :data-id="specc.id"
                                  data-type="child"
                                />
                                <span class="text-value">
                                  {{ specc.name }}
                                </span>
                              </li>
                              <hr />
                            </ul>
                          </li>
                          <hr />
                        </ul>
                      </template>
                    </ul>
                  </div>
                </div>
                <div class="flex flex-col my-2">
                  <div class="block">
                    <label
                      for="email"
                      class="block text-xl font-semibold text-gray-600"
                      >Status</label
                    >
                    <div class="mt-2">
                      <div>
                        <label class="inline-flex items-center">
                          <input
                            type="radio"
                            class="form-radio"
                            name="radio"
                            value="1"
                            v-model="job.open"
                          />
                          <span class="ml-2">Close</span>
                        </label>
                      </div>
                      <div>
                        <label class="inline-flex items-center">
                          <input
                            type="radio"
                            class="form-radio"
                            name="radio"
                            value="0"
                            v-model="job.open"
                          />
                          <span class="ml-2">Open</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <label
                  for="Salary"
                  class="block text-xl font-semibold text-gray-600"
                  >Salary</label
                >
                <input
                  v-model="job.salary"
                  placeholder="Salary"
                  class="
                    text-black
                    placeholder-gray-600
                    w-full
                    px-4
                    py-2.5
                    mt-2
                    text-base
                    transition
                    duration-500
                    ease-in-out
                    transform
                    border-transparent
                    rounded-lg
                    bg-gray-200
                    focus:border-blueGray-500 focus:bg-white
                    dark:focus:bg-gray-800
                    focus:outline-none focus:shadow-outline focus:ring-2
                    ring-offset-current ring-offset-2 ring-gray-400
                  "
                />

                <label
                  for="job_details"
                  class="block text-xl font-semibold text-gray-600"
                  >Job Details</label
                >
                <!-- <textarea name="job_details" id="job_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea> -->
                <QuillEditor
                  v-model:content="job.job_details"
                  height="1000"
                  theme="snow"
                  toolbar="full"
                  contentType="html"
                />

                <label
                  for="additional_details"
                  class="block text-xl font-semibold text-gray-600"
                  >Additional Details</label
                >
                <!-- <textarea name="additional_details" id="additional_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea> -->
                <!-- <QuillEditor v-model:content="job.additional_details" height="1000" theme="snow" toolbar="full" contentType="html" 
                                        />  -->

                <button
                  @click.prevent="AddNewField()"
                  class="bg-green-500 p-2 rounded text-white hover:bg-green-600"
                >
                  Add Experience
                </button>
                <div
                  class="flex flex-col md:flex-row"
                  v-for="(detail, index) in job.additional_details"
                  :key="index"
                >
                  <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                    <input
                      placeholder="Name"
                      v-model="detail.name"
                      class="
                        text-black
                        placeholder-gray-600
                        w-full
                        px-4
                        py-2.5
                        mt-2
                        text-base
                        transition
                        duration-500
                        ease-in-out
                        transform
                        border-transparent
                        rounded-lg
                        bg-gray-200
                        focus:border-blueGray-500 focus:bg-white
                        dark:focus:bg-gray-800
                        focus:outline-none focus:shadow-outline focus:ring-2
                        ring-offset-current ring-offset-2 ring-gray-400
                      "
                    />
                  </div>
                  <div class="w-full md:flex-grow md:w-2/4">
                    <input
                      placeholder="Value"
                      v-model="detail.value"
                      class="
                        text-black
                        placeholder-gray-600
                        w-full
                        px-4
                        py-2.5
                        mt-2
                        text-base
                        transition
                        duration-500
                        ease-in-out
                        transform
                        border-transparent
                        rounded-lg
                        bg-gray-200
                        focus:border-blueGray-500 focus:bg-white
                        dark:focus:bg-gray-800
                        focus:outline-none focus:shadow-outline focus:ring-2
                        ring-offset-current ring-offset-2 ring-gray-400
                      "
                    />
                  </div>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    @click.prevent="RemoveField(index)"
                    class="
                      h-6
                      w-6
                      text-red-600
                      cursor-pointer
                      hover:bg-gray-100
                    "
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </div>
              </div>

              <div id="errors4"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
        <button
          type="button"
          @click.prevent="closeModalAdd()"
          class="bg-red-500 p-2 rounded text-white hover:bg-red-600"
        >
          Close
        </button>
        <button
          type="button"
          @click.prevent="AddNewJob()"
          class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600"
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, reactive, ref} from "@vue/reactivity";
import { useStore } from "vuex";
import Error from "@/helper/errorHandler";
import { onMounted, watch } from "@vue/runtime-core";
export default {
  props: {
    jobAdd: Boolean,
    SwalAlert: Function,
    spexial: Array,
  },
  setup(props, context) {
    const store = useStore();

    const spexialiaxations = ref(props.spexial);
    let specializeName = ref('');
    const state = reactive({ spexialiaxation: [] });

    const job = reactive({
      title: "",
      position: "",
      // specialization: '',
      specialization: [],
      open: 0,
      salary: "",
      job_details: "",
      additional_details: [],
      company_id: computed(() => store.getters["company/GET_COMPANY"].id),
    });

    const specializes = ref([
      "Accounting/Finance",
      "Admin/Human Resources",
      "Sales/Marketing",
      "Arts/Media/Communications",
      "Services",
      "Hotel/Restaurant",
      "Education/Training",
      "Computer/Information Technology",
      "Engineering",
      "Manufacturing",
      "Building/Contructions",
      "Sciences",
      "Healthcare",
      "Others",
    ]);

    const RemoveField = (index) => {
      index = parseInt(index);
      // user.value.detail.experience.splice(index, 1);
      job.additional_details.splice(index, 1);
    };
    const AddNewField = () => {
      job.additional_details.push({ name: "", value: "" });
    };

    watch(state.spexialiaxation, (val) => {
        if(val.length > 0) {
            specializeName.value = val?.map((v) => {
                return v.name
            }).join(", ")
        } else {
            specializeName.value = ''
        }
    })

    watch(state.spexialiaxation, (prevVal, newVal) => {
      // console.log(newVal)
      if (!prevVal && !newVal) {
        document.querySelector("#box-all").checked = true;
      }
      if (newVal) {
        document.querySelector("#box-all").checked = false;
      }

      if (state.spexialiaxation.length == 3) {
        document.querySelectorAll(".box").forEach((check) => {
          if (!check.checked) {
            check.setAttribute("disabled", "");
          }
        });
        document.querySelectorAll(".box-child").forEach((check) => {
          if (!check.checked) {
            check.setAttribute("disabled", "");
          }
        });
      } else {
        document.querySelectorAll(".box").forEach((check) => {
          check.removeAttribute("disabled");
        });
        document.querySelectorAll(".box-child").forEach((check) => {
          check.removeAttribute("disabled");
        });
      }

      if (state.spexialiaxation.length == 0) {
        document.querySelector("#box-all").checked = true;
        document.querySelectorAll(".nested").forEach((box) => {
          box.classList.remove("active");
        });
      }
    });

    onMounted(() => {
      document.querySelector("#box-all").checked = true;

      setTimeout(() => {
        var toggler = document.querySelectorAll(".box");
        Array.from(toggler).forEach((btncheck) => {
          btncheck.addEventListener("click", function () {
            if (
              !this.parentElement
                .querySelector(".nested")
                .classList.contains("active")
            ) {
              this.parentElement
                .querySelector(".nested")
                .classList.toggle("active");
            }
            let urlParent = this.nextSibling.nextSibling.nextSibling;
            let siblings = urlParent.getElementsByTagName("input");

            if (btncheck.checked == true) {
              Array.from(siblings).forEach((btn) => {
                if (btn.checked) {
                  let index = state.spexialiaxation.findIndex(
                    (spec) =>
                      spec.id == btn.dataset.id && spec.type == btn.dataset.type
                  );
                  state.spexialiaxation.splice(index, 1);
                }
              });
              state.spexialiaxation.push({
                id: btncheck.dataset.id,
                name: btncheck.dataset.name,
                type: btncheck.dataset.type,
              });
            } else {
              let index = state.spexialiaxation.findIndex(
                (spec) =>
                  spec.id == btncheck.dataset.id &&
                  spec.type == btncheck.dataset.type
              );
              state.spexialiaxation.splice(index, 1);
            }

            Array.from(siblings).forEach((btn) => {
              btn.checked = false;
            });
          });
        });

        let inputCHild = document.querySelectorAll(".box-child");

        inputCHild.forEach((btn) => {
          btn.addEventListener("click", () => {
            let { id, name, type } = btn.dataset;
            let parentCheck =
              btn.parentElement.parentElement.parentElement.getElementsByClassName(
                "box"
              )[0];

            if (parentCheck.checked == true) {
              let index = state.spexialiaxation.findIndex(
                (spec) =>
                  spec.id == parentCheck.dataset.id &&
                  spec.type == parentCheck.dataset.type
              );
              state.spexialiaxation.splice(index, 1);
            }
            parentCheck.checked = false;
            if (btn.checked == true) {
              state.spexialiaxation.push({
                id,
                name,
                type,
              });
            } else {
              let index = state.spexialiaxation.findIndex(
                (spec) => spec.id == id && spec.type == type
              );
              state.spexialiaxation.splice(index, 1);
            }

            let response = Array.from(
              parentCheck.nextSibling.nextSibling.nextSibling.querySelectorAll(
                ".box-child"
              )
            ).every((checkbox) => {
              return checkbox.checked == false;
            });

            if (response) {
              parentCheck.nextSibling.nextSibling.nextSibling.classList.remove(
                "active"
              );
            }
          });
        });

        document.getElementById("box-all").addEventListener("click", (e) => {
          if (e.target.checked == true) {
            document.querySelectorAll(".box").forEach((check) => {
              check.removeAttribute("disabled");
              check.checked = false;
            });
            document.querySelectorAll(".box-child").forEach((check) => {
              check.checked = false;
              check.removeAttribute("disabled");
            });

            document.querySelectorAll(".nested").forEach((nested) => {
              nested.classList.remove("active");
            });
          } else {
            e.target.checked = true;
          }

          state.spexialiaxation = [];
        });
      }, 1000);
    });

    const closeModalAdd = (reload = false) => {
      context.emit("closeModalAdd", reload);
    };

    const AddNewJob = async () => {
      let errorBox = document.getElementById("errors4");
      errorBox.innerHTML = "";
      try {
        store.commit("Loading", true);
        job.specialization = [...state.spexialiaxation];
        await store.dispatch("jobs/ADD_NEW_JOB", job);
        let { id } = store.getters["company/GET_COMPANY"];
        await store.dispatch("jobs/FETCH_JOBS", id);
        store.commit("Loading", false);
        props.SwalAlert.fire({
          position: "center",
          icon: "success",
          title: "Success Added New Job",
          showConfirmButton: true,
        }).then(() => {
          closeModalAdd(true);
        });
      } catch (error) {
        store.commit("Loading", false);
        Error.ErrorShow(errorBox, error, props.SwalAlert);
      }
    };

    const showSelection = (id) => {
      document.getElementById(id).classList.toggle("hidden");
    };

    return {
      closeModalAdd,
      job,
      AddNewJob,
      RemoveField,
      AddNewField,
      specializes,
      showSelection,
      spexialiaxations,
      specializeName
    };
  },
};
</script>


<style scoped>
ul,
#myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>