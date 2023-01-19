<template>
  <div id="home" class="flex h-screen">
    <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">
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
                  @click.prevent="EditImage()"
                  :src="users.detail.image"
                  alt=""
                />
              </div>
              <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">
                {{ users.name }}
              </h1>
              <!-- <h3 class="text-gray-600 font-lg text-semibold leading-6">Owner at Her Company Inc.</h3> -->
              <!-- <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Lorem ipsum dolor sit amet
                                consectetur adipisicing elit.
                                Reprehenderit, eligendi dolorum sequi illum qui unde aspernatur non deserunt</p> -->
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
                  <span class="ml-auto">{{ moment(users.created_at).format('MMMM Do YYYY') }}</span>
                </li>
                <li class="flex items-center py-3">
                  <button
                    type="button"
                    @click.prevent="Editpassword()"
                    class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600"
                  >
                    Update Password
                  </button>
                </li>
              </ul>
            </div>
            <!-- End of profile card -->
            <div class="my-4"></div>
            <!-- Friends card -->
            <!-- <div class="bg-white p-3 hover:shadow">
                            <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                <span class="text-green-500">
                                    <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </span>
                                <span>Similar Profiles</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-center my-2">
                                    <img class="h-16 w-16 rounded-full mx-auto"
                                        src="https://cdn.australianageingagenda.com.au/wp-content/uploads/2015/06/28085920/Phil-Beckett-2-e1435107243361.jpg"
                                        alt="">
                                    <a href="#" class="text-main-color">Kojstantin</a>
                                </div>
                                <div class="text-center my-2">
                                    <img class="h-16 w-16 rounded-full mx-auto"
                                        src="https://widgetwhats.com/app/uploads/2019/11/free-profile-photo-whatsapp-4.png"
                                        alt="">
                                    <a href="#" class="text-main-color">James</a>
                                </div>
                                <div class="text-center my-2">
                                    <img class="h-16 w-16 rounded-full mx-auto"
                                        src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                        alt="">
                                    <a href="#" class="text-main-color">Natie</a>
                                </div>
                                <div class="text-center my-2">
                                    <img class="h-16 w-16 rounded-full mx-auto"
                                        src="https://bucketeer-e05bbc84-baa3-437e-9518-adb32be77984.s3.amazonaws.com/public/images/f04b52da-12f2-449f-b90c-5e4d5e2b1469_361x361.png"
                                        alt="">
                                    <a href="#" class="text-main-color">Casey</a>
                                </div>
                            </div>
                        </div> -->
            <!-- End of friends card -->
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
                    <div class="px-4 py-2">{{ users.name }}</div>
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
                    <div class="px-4 py-2">{{ users.detail.address }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Permanant Address</div>
                    <div class="px-4 py-2">{{ users.detail.address }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Email.</div>
                    <div class="px-4 py-2">
                      <a class="text-blue-800" href="mailto:jane@example.com">{{
                        users.email
                      }}</a>
                    </div>
                  </div>
                  <!-- <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Birthday</div>
                                        <div class="px-4 py-2">Feb 06, 1998</div>
                                    </div> -->
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">course</div>
                    <div class="px-4 py-2">{{ users.detail.course }}</div>
                  </div>
                  <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">college</div>
                    <div class="px-4 py-2">{{ users.detail.college }}</div>
                  </div>
                </div>
              </div>
              <button
                @click.prevent="editProfile()"
                class="
                  block
                  w-full
                  text-blue-800 text-sm
                  font-semibold
                  rounded-lg
                  hover:bg-gray-100
                  focus:outline-none focus:shadow-outline focus:bg-gray-100
                  hover:shadow-xs
                  p-3
                  my-4
                "
              >
                Edit About Data
              </button>
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
                  <ul class="list-inside space-y-2">
                    <li
                      v-for="(job, index) in users.detail.experience"
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
                  <button
                    @click.prevent="EditJobExp()"
                    class="
                      block
                      w-full
                      text-blue-800 text-sm
                      font-semibold
                      rounded-lg
                      hover:bg-gray-100
                      focus:outline-none focus:shadow-outline focus:bg-gray-100
                      hover:shadow-xs
                      p-3
                      my-4
                    "
                  >
                    Edit Job Exp. Data
                  </button>
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

    <!-- Modal Edit Profile Form -->
    <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[profileEdit ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit My Profile</h1>
                        <svg @click="profileEdit = !profileEdit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="p-3 overflow-y-auto">
                        <div class="m-auto">
                            <div>
                        
                                <div class="mt-2 bg-white rounded-lg shadow">
                                    <div class="flex">
                                        <div class="flex-1 py-5 pl-5 overflow-hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.5" class="inline align-text-top" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <h1 class="inline text-2xl font-semibold leading-none ml-2">Profile</h1>
                                        </div>
                                    </div>
                                    <div class="px-5 pb-5">
                                        <img src="../../../public/images/download.png" class="mx-auto w-64 h-64" alt="">
                                        <input  placeholder="Name" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        <div class="flex flex-col md:flex-row">
                                            <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                                <input  placeholder="Email" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                            <div class="w-full md:flex-grow md:w-2/4">
                                                <input placeholder="age" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                                <input  placeholder="Course" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                            <div class="w-full md:flex-grow md:w-2/4">
                                                <input placeholder="College" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                            </div>
                                        </div>
                                        <input  placeholder="Job" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                        <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="profileEdit = !profileEdit">Cancel</button>
                        <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                    </div>
                </div>
           </div> -->

    <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50" :class="[jobExpEdit ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit My Job Experience:</h1>
                        <svg @click="jobExpEdit = !jobExpEdit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 overflow-y-auto">
                    <div class="m-auto">
                        <div>
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                                 <div class="flex">
                                    <div class="flex-1 py-5 pl-5 overflow-hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline align-text-top" width="21" height="20.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
          
                                        <h1 class="inline text-2xl font-semibold leading-none ml-2">Job Experience</h1>
                                    </div>
                                    <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
                                </div>
                                <div class="px-5 pb-5">
                                    <input  placeholder="Current Job" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                            <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <input placeholder="Company" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="jobExpEdit = !jobExpEdit">Cancel</button>
                    <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                </div>
             </div>
           </div> -->

    <edit-modal-profile
      :profileEdit="profileEdit"
      @closeProfileEditModal="editProfile"
      :users="users"
      :Swal="Swal"
    ></edit-modal-profile>
    <edit-modal-job
      :jobExpEdit="jobExpEdit"
      @closeModalJob="EditJobExp"
      :users="users"
      :Swal="Swal"
    ></edit-modal-job>
    <edit-modal-image
      :imageEdit="imageEdit"
      @closeimagemodal="EditImage"
      :Swal="Swal"
    ></edit-modal-image>
    <edit-modal-pass
      :passwordEdit="passwordEdit"
      @ClosePassModal="Editpassword"
      :Swal="Swal"
    ></edit-modal-pass>
  </div>
</template>


<script>
import { computed, ref, inject } from "vue";
import EditModalProfile from "@/components/admin/EditModalProfile";
import EditModalJob from "@/components/admin/EditModalJob";
import { useStore } from "vuex";
import EditModalImage from "../../components/admin/EditModalImage.vue";
import EditModalPass from "../../components/admin/EditModalPass.vue";
import moment from 'moment';
export default {
  components: {
    EditModalProfile,
    EditModalJob,
    EditModalImage,
    EditModalPass,
  },
  setup() {
    const profileEdit = ref(false);
    const jobExpEdit = ref(false);
    const imageEdit = ref(false);
    const passwordEdit = ref(false);
    const store = useStore();

    const Swal = inject("$Swal");

    const users = ref(
      computed(() => {
        return store.getters["user/GET_USER_DATA"];
      })
    );

    const editProfile = () => {
      profileEdit.value = !profileEdit.value;
    };

    const EditJobExp = () => {
      jobExpEdit.value = !jobExpEdit.value;
    };

    const EditImage = () => {
      imageEdit.value = !imageEdit.value;
    };

    const Editpassword = () => {
      passwordEdit.value = !passwordEdit.value;
    };

    return {
      profileEdit,
      editProfile,
      jobExpEdit,
      EditJobExp,
      users,
      Swal,
      imageEdit,
      EditImage,
      passwordEdit,
      Editpassword,
      moment
    };
  },
};
</script>

