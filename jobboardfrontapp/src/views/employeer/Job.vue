<template>
    <div id="home" class="flex">
        <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">

            <div class="bg-gray-800">
                <div class=" bg-blue-900 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2">Jobs List</h3>
                </div>
            </div>
            <a href="javascript:void(0);" @click.prevent="AddJob(false)"
            class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900 ml-3 mt-5">
            Add New Job</a>

           <!-- This example requires Tailwind CSS v2.0+ https://tailwindui.com/components/application-ui/lists/tables -->
            <div class="min-h-screen">
                <div class=" p-5"> 
                    <div class="-my-2 overflow-x-auto lg:overflow-x-hidden sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Position
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            specialization
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">BSHR</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                User
                                                </span>
                                            </td>
                                     
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="javascript:void(0);" @click="Viewjob(1)" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
                                                <a href="javascript:void(0);" @click="Updatejob(1)" class="bg-yellow-600 p-2 rounded text-yellow-200 
                                                hover:text-yellow-900">Update</a>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                    Jane Cooper
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                    jane.cooper@example.com
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
                                                <div class="text-sm text-gray-500">Optimization</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">BSCS</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Employeer
                                                </span>
                                            </td>
                                     
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                                <a href="javascript:void(0);" @click="Viewjob(1)" class="bg-green-600 p-2 rounded text-green-200 hover:text-green-900">View</a>
                                            <a href="javascript:void(0);" @click="Updatejob(1)" class="bg-yellow-600 p-2 rounded text-yellow-200 
                                                hover:text-yellow-900">Update</a>
                                            </td>
                                        </tr> -->
                                        <job-single v-for="(job, index) in jobs.data" :key="index" :job="job" @Viewjob="Viewgetjob" 
                                        @updatingJob="updateJobData"
                                        ></job-single>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Paginations -->
                            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" 
                              v-if="jobs.data && jobs.data.length > 0">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                        </a>
                                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Next
                                        </a>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing
                                                <span class="font-medium">{{ (jobs.to - jobs.data.length) + 1  }}</span>
                                                to
                                                <span class="font-medium">{{ jobs.to }}</span>
                                                of
                                                <span class="font-medium">{{ jobs.total }}</span>
                                                results
                                            </p>
                                        </div>
                                        <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                            <!-- Heroicon name: solid/chevron-left -->
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                                                aria-hidden="true" v-if="jobs.prev_page_url" @click.prevent="getCompanyJobs(parseInt(jobs.current_page) - 1)">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                                            <template v-for="(p, index) in page1" :key="index">
                                                <a href="javascript:void(0);" @click.prevent="getCompanyJobs(p.page)" aria-current="page" class=" relative inline-flex items-center 
                                                px-4 py-2 border text-sm font-medium" :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : p.page == jobs.current_page}">
                                                    {{ p.page }}
                                                </a>
                                            </template>
                                        
                                            <span class="relative inline-flex items-center px-4 py-2 border 
                                            border-gray-300 bg-white text-sm font-medium text-gray-700" v-if="page2.length > 0">
                                            ...
                                            </span>
                                             <template v-for="(p, index) in page2" :key="index">
                                                <a href="javascript:void(0);" @click.prevent="getCompanyJobs(p.page)" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden 
                                                md:inline-flex relative items-center px-4 py-2 border text-sm font-medium" 
                                                :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : p.page == jobs.current_page}">
                                                   {{ p.page }}
                                                </a>
                                            </template>
   
                                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Next</span>
                                            <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5" v-if="jobs.next_page_url" @click.prevent="getCompanyJobs(parseInt(jobs.current_page) + 1)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </nav>
                                        </div>
                                    </div>
                            </div>
                        <!-- End Paginations -->
                    </div>
                </div> 
            </div>

        </div>



        <!-- View Job -->
        <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[jobView ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Job details</h1>
                        <svg @click="jobView = !jobView" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 ">
                    <div class="mx-auto">
                        <div class="">
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                        
                                <div class="px-5 pb-5">
                                    <label for="email" class="block text-xl font-semibold text-gray-600">Title</label>
                                    <input  placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <label for="email" class="block text-xl font-semibold text-gray-600">Position</label>
                                            <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  
                                             transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                             focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                             focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <label for="email" class="block text-xl font-semibold text-gray-600">Specialization</label>
                                            <input placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>
                                     <div class="flex flex-col my-2">
                                         <div class="block">
                                             <label for="email" class="block text-xl font-semibold text-gray-600">Status</label>
                                            <div class="mt-2">
                                                <div>
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
                                                <div>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="radio" value="2" />
                                                        <span class="ml-2">Open</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    
            
                                    <label for="Salary" class="block text-xl font-semibold text-gray-600">Salary</label>
                                    <input  placeholder="Salary" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                    focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                                     <label for="job_details" class="block text-xl font-semibold text-gray-600">Job Details</label>
                                    <textarea name="job_details" id="job_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea>

                                    <label for="additional_details" class="block text-xl font-semibold text-gray-600">Additional Details</label>
                                    <textarea name="additional_details" id="additional_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea>
                                
                                </div>
                            </div>

                     
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="jobView = !jobView">Close</button>
                </div>
             </div>
           </div> -->


        <!-- Add New Job -->
            <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[jobAdd ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Add New Job</h1>
                        <svg @click="jobAdd = !jobAdd" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 ">
                    <div class="mx-auto">
                        <div class="">
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                        
                                <div class="px-5 pb-5">
                                    <label for="email" class="block text-xl font-semibold text-gray-600">Title</label>
                                    <input  placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <label for="email" class="block text-xl font-semibold text-gray-600">Position</label>
                                            <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  
                                             transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                             focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                             focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <label for="email" class="block text-xl font-semibold text-gray-600">Specialization</label>
                                            <input placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>
                                     <div class="flex flex-col my-2">
                                         <div class="block">
                                             <label for="email" class="block text-xl font-semibold text-gray-600">Status</label>
                                            <div class="mt-2">
                                                <div>
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
                                                <div>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="radio" value="2" />
                                                        <span class="ml-2">Open</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    
                                    <label for="Salary" class="block text-xl font-semibold text-gray-600">Salary</label>
                                    <input  placeholder="Salary" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                    focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                                     <label for="job_details" class="block text-xl font-semibold text-gray-600">Job Details</label>
   
                                    <QuillEditor height="1000" theme="snow" toolbar="full" contentType="html" 
                                         /> 

                                    <label for="additional_details" class="block text-xl font-semibold text-gray-600">Additional Details</label>
          
                                    <QuillEditor height="1000" theme="snow" toolbar="full" contentType="html" 
                                         /> 
                                
                                </div>
                            </div>

                     
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="jobAdd = !jobAdd">Close</button>
                    <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                </div>
             </div>
           </div> -->


           <!-- Edit Job -->
            <!-- <div class="h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 overflow-y-auto" 
            :class="[jobEdit ? '' : 'hidden']">
                <div class="bg-white rounded shadow-lg w-4/5 lg:w-2/5 my-auto">
                    <div class="flex justify-between border-b px-4 py-2 ">
                        <h1 class="text-2xl font-bold font-serif">Edit Job</h1>
                        <svg @click="jobEdit = !jobEdit" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 cursor-pointer hover:bg-gray-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                <div class="p-3 ">
                    <div class="mx-auto">
                        <div class="">
                    
                            <div class="mt-2 bg-white rounded-lg shadow">
                        
                                <div class="px-5 pb-5">
                                    <label for="email" class="block text-xl font-semibold text-gray-600">Title</label>
                                    <input  placeholder="Title" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                    <div class="flex flex-col md:flex-row">
                                        <div class="w-full md:flex-grow md:w-2/4 md:pr-2">
                                        <label for="email" class="block text-xl font-semibold text-gray-600">Position</label>
                                            <input  placeholder="Position" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base  
                                             transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                             focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                             focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                        <div class="w-full md:flex-grow md:w-2/4">
                                            <label for="email" class="block text-xl font-semibold text-gray-600">Specialization</label>
                                            <input placeholder="specialization" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                            transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                            focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline 
                                            focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                        </div>
                                    </div>
                                     <div class="flex flex-col my-2">
                                         <div class="block">
                                             <label for="email" class="block text-xl font-semibold text-gray-600">Status</label>
                                            <div class="mt-2">
                                                <div>
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
                                                <div>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="radio" value="2" />
                                                        <span class="ml-2">Open</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    
            
                                    <label for="Salary" class="block text-xl font-semibold text-gray-600">Salary</label>
                                    <input  placeholder="Salary" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  
                                    focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                                     <label for="job_details" class="block text-xl font-semibold text-gray-600">Job Details</label>
                                    <textarea name="job_details" id="job_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea>

                                    <label for="additional_details" class="block text-xl font-semibold text-gray-600">Additional Details</label>
                                    <textarea name="additional_details" id="additional_details" class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base 
                                    transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 
                                    focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current 
                                    ring-offset-2 ring-gray-400" cols="30" rows="10"></textarea>
                                
                                </div>
                            </div>

                     
                          
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center w-100 border-t p-3 space-x-5">
                    <button class="bg-red-500 p-2 rounded text-white hover:bg-red-600" @click="jobEdit = !jobEdit">Close</button>
                    <button class="bg-blue-500 p-2 rounded text-white hover:bg-blue-600">Submit</button>
                </div>
             </div>
           </div> -->

        <template v-if="jobAdd">
            <add-job-modal :jobAdd="jobAdd" @closeModalAdd="AddJob" :SwalAlert="SwalAlert" :spexial="spexialiaxations"></add-job-modal>
        </template>
        <template v-if="jobView">
          <view-job-modal :job="job_data" @closemodalview="Viewjob2" :jobView="jobView"></view-job-modal>  
        </template>
        <template v-if="jobEdit">
             <edit-job-modal :job="job_data" :jobEdit="jobEdit" @CloseEditModal="CloseUpdatejob" :SwalAlert="SwalAlert" 
             :spexial="spexialiaxations"></edit-job-modal>
        </template>
    </div>
</template>

<script>
import {ref, onMounted, inject, computed, onBeforeMount, onUnmounted, onErrorCaptured} from 'vue';
import AddJobModal from '../../components/employeer/AddJobModal';
import { useStore } from 'vuex';
import ViewJobModal from '../../components/employeer/ViewJobModal';
import EditJobModal from '../../components/employeer/EditJobModal';
import JobSingle from '../../components/employeer/JobSingle';
import Pagination from '@/helper/Pagination'
import { useRoute, useRouter } from 'vue-router';
export default {
  components: { AddJobModal, ViewJobModal, JobSingle, EditJobModal },

  setup() {
    const SwalAlert = inject('$Swal');
    const store = useStore();
    const router = useRouter();
    const route = useRoute();
    const spexialiaxations = ref([]);
    const jobView = ref(false);
    const jobAdd = ref(false);
    const jobEdit = ref(false);
    const jobs = ref(computed(() => store.getters['jobs/GET_JOBS']));
    
    const job_data = ref(computed(() => {
        return store.getters['jobs/GET_JOB'];
    }));
    
    const company = ref(null);

    const page1 = ref([]);
    const page2 = ref([]);

    onBeforeMount(async() => {
        try {
            store.commit("Loading", true);
            let {specializations} = await store.dispatch("GET_SPECIALIZATIONS");
            spexialiaxations.value = specializations;
            await reFreshJobs();
        } catch (error) {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Company Data Fetch Failed',
                showConfirmButton: true,
            });
        } finally {
            store.commit("Loading", false);
        }
    });

    onUnmounted(() => { 
        jobView.value = false;
        jobAdd.value = false;
        jobEdit.value = false;
        jobs.value = [];
        job_data.value = null;
        company.value = null;
        page1.value = [];
        page2.value = [];
    });

    onMounted(async () => {
        
    });

    onErrorCaptured((err, vm, info) => {
      console.log("not invoked");
      console.log("Parent: " + err.toString());
      console.log("info: " + info);
      return false;
    });

    const reFreshJobs = async () => {
        await store.dispatch('company/FETCH_COMPANY_DATA');
        company.value = store.getters['company/GET_COMPANY'];
        let page = route.query.page ? route.query.page : null;
        await getCompanyJobs(page);
    }

    const getCompanyJobs = async (page = null) => {
        await store.dispatch('jobs/FETCH_JOBS',{page, id:company.value.id});
        if(page) {
            router.push({query: {page}});
        }
        new Pagination(3, jobs, page1, page2)
    }

    const Viewgetjob = async (id) => {
        try {
            store.commit("Loading", true);
            await store.dispatch('jobs/FETCH_JOB', id);
            jobView.value = !jobView.value;
            store.commit("Loading", false);
        } catch (error) {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Company Job Data Fetch Failed',
                showConfirmButton: true,
            });
        } finally {
             store.commit("Loading", false);
        }
    }

    const Viewjob2 = () => {
        jobView.value = !jobView.value
    }

    const AddJob = async (reload) => {
        jobAdd.value = !jobAdd.value;
        if(reload) {
            try {
                await reFreshJobs();
            } catch (error) {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Company Job Data Fetch Failed',
                    showConfirmButton: true,
                });
            } 
        }
    }

    const updateJobData = async (id) => {
        try {
            store.commit("Loading", true);
            await store.dispatch('jobs/FETCH_JOB', id);
        } catch (error) {
            SwalAlert.fire({
                position: 'center',
                icon: 'error',
                title: 'Company Data Fetch Failed',
                showConfirmButton: true,
            });
        } finally {
             store.commit("Loading", false);
             jobEdit.value = true;
        }
    }

    const CloseUpdatejob = async (reload) => {
        jobEdit.value = !jobEdit.value
        if(reload) {
            try {
                await reFreshJobs();
            } catch (error) {
                SwalAlert.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Company Job Data Fetch Failed',
                    showConfirmButton: true,
                });
            } 
        }
    }

    return { 
        jobView, Viewgetjob, jobAdd, AddJob, jobEdit, updateJobData, jobs, 
        SwalAlert, job_data, Viewjob2, CloseUpdatejob, page1, page2, getCompanyJobs,
        spexialiaxations
    }
  }
}
</script>