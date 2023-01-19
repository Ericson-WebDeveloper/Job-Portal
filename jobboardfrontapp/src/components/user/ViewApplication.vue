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
    "
    :class="[modalView ? '' : 'hidden']"
  >
    <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
      <div class="flex justify-between border-b px-4 py-2">
        <h1 class="text-2xl font-bold font-serif">Job Application</h1>
        <svg
          @click.prevent="closeModal"
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

      <div class="p-3 overflow-y-auto" v-if="application">
        <div class="m-auto">
          <div>
            <div class="mt-2 bg-white rounded-lg shadow">
              <div class="flex">
                <div class="flex-1 py-5 pl-5 overflow-hidden">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="21"
                    height="20.5"
                    class="inline align-text-top"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                    />
                  </svg>

                  <h1 class="inline text-2xl font-semibold leading-none ml-2">
                    Company
                  </h1>
                </div>
              </div>
              <div class="px-5 pb-5">
                <img
                  :src="
                    application.job.company.detail &&
                    application.job.company.detail.image
                      ? application.job.company.detail.image
                      : 'http://localhost:3000/images/download.png'
                  "
                  class="mx-auto w-64 h-64"
                  alt=""
                />
                <input
                  placeholder="Name"
                  :value="application.job.company.name"
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
                    <input
                      placeholder="Address"
                      :value="application.job.company.address"
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
                      placeholder="Industry"
                      :value="application.job.company.industry"
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
                </div>
              </div>

              <div class="flex">
                <div class="flex-1 py-5 pl-5 overflow-hidden">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="inline align-text-top"
                    width="21"
                    height="20.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                  </svg>

                  <h1 class="inline text-2xl font-semibold leading-none ml-2">
                    Job Details
                  </h1>
                </div>
                <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
              </div>
              <div class="px-5 pb-5">
                <input
                  placeholder="Title"
                  :value="application.job.title"
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
                    <input
                      placeholder="Position"
                      :value="application.job.position"
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
                    <span
                      v-for="(application, index) in JSON.parse(
                        application.job.specialization
                      )"
                      :key="index"
                    >
                      <input
                        :value="application.name"
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
              </div>

              <div class="flex">
                <div class="flex-1 py-5 pl-5 overflow-hidden">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="inline align-text-top"
                    width="21"
                    height="20.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"
                    />
                  </svg>

                  <h1 class="inline text-2xl font-semibold leading-none ml-2">
                    Application Status
                  </h1>
                </div>
                <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>
              </div>
              <div class="px-5 pb-5">
                <span
                  class="
                    px-2
                    inline-flex
                    text-lg
                    leading-5
                    font-semibold
                    rounded-lg
                    p-1
                  "
                  :class="{
                    'bg-indigo-100 text-indigo-800':
                      application.status == 'review',
                    'bg-green-100 text-green-800':
                      application.status == 'accept',
                    'bg-blue-100 text-blue-800': application.status == 'select',
                    'bg-red-100 text-red-800': application.status == 'reject',
                    'bg-yellow-100 text-yellow-800': application.status == null,
                  }"
                >
                  {{
                    application.status == null ? "standby" : application.status
                  }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
        <button
          class="bg-red-500 p-2 rounded text-white hover:bg-red-600"
          @click.prevent="closeModal"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    modalView: Boolean,
    application: Object,
  },

  setup(props, context) {
    const closeModal = () => {
      context.emit("closeModal", "modalView");
    };

    return {
      closeModal,
    };
  },
};
</script>