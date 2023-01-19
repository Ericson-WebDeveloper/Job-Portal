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
    :class="[jobView ? '' : 'hidden']"
  >
    <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
      <div class="flex justify-between border-b px-4 py-2">
        <h1 class="text-2xl font-bold font-serif">Job details</h1>
        <svg
          @click.prevent="closemodalview()"
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
                  placeholder="Title"
                  readonly
                  :value="job.title"
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
                      readonly
                      :value="job.position"
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
                    <span
                      v-for="(application, index) in JSON.parse(
                        job.specialization
                      )"
                      :key="index"
                      ><input
                        readonly
                        :value="application.name"
                        placeholder="specialization"
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
                    </span>
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
                      <div v-if="job.open == 1">
                        <label class="inline-flex items-center">
                          <input
                            type="radio"
                            class="form-radio"
                            name="radio"
                            value="1"
                            checked
                          />
                          <span class="ml-2">Close</span>
                        </label>
                      </div>
                      <div v-else>
                        <label class="inline-flex items-center">
                          <input
                            type="radio"
                            class="form-radio"
                            name="radio"
                            value="2"
                            checked
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
                  readonly
                  :value="job.detail.salary"
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
                <div id="details" v-html="job.detail.job_details"></div>

                <label
                  for="additional_details"
                  class="block text-xl font-semibold text-gray-600"
                  >Additional Details</label
                >
                <div id="additonaldata">
                  <ul class="list-inside space-y-2">
                    <li
                      v-for="(detail, index) in job.detail.additional_details"
                      :key="index"
                    >
                      <div class="text-green-600">{{ detail.name }}</div>
                      <div class="text-gray-500 text-xs">
                        {{ detail.value }}
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
        <button
          type="button"
          @click.prevent="closemodalview()"
          class="bg-red-500 p-2 rounded text-white hover:bg-red-600"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    jobView: Boolean,
    job: Object,
  },
  setup(props, context) {
    const closemodalview = () => {
      context.emit("closemodalview", 1);
    };

    return {
      closemodalview,
    };
  },
};
</script>