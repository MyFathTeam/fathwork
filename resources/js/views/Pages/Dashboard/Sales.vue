<template>
    <div class="mt-4">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="md:col-span-2 lg:col-span-1" >
                <DashboardAgenda />
            </div>
            <div>
                <div class="h-full py-6 px-6 rounded-xl bg-white dark:bg-dark-header">
                    <h5 class="text-xl text-gray-700 dark:text-gray-300">Sales</h5>
                    <div class="my-8">
                        <h1 class="text-5xl font-bold text-gray-800 dark:text-gray-400"><span class="text-green-400 text-2xl"><i class="fas fa-arrow-up"></i></span> 21.4%</h1>
                        <span class="text-gray-500">Against last week $8,848</span>
                    </div>
                    <svg class="w-full" viewBox="0 0 218 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 67.5C27.8998 67.5 24.6002 15 52.5 15C80.3998 15 77.1002 29 105 29C132.9 29 128.6 52 156.5 52C184.4 52 189.127 63.8158 217.027 63.8158" stroke="url(#paint0_linear_622:13664)" stroke-width="3" stroke-linecap="round"/>
                        <path d="M0 67.5C27.2601 67.5 30.7399 31 58 31C85.2601 31 80.7399 2 108 2C135.26 2 134.74 43 162 43C189.26 43 190.74 63.665 218 63.665" stroke="url(#paint1_linear_622:13664)" stroke-width="3" stroke-linecap="round"/>
                        <defs>
                        <linearGradient id="paint0_linear_622:13664" x1="217.027" y1="15" x2="7.91244" y2="15" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#8f0045"/>
                        <stop offset="1" stop-color="#d80068"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_622:13664" x1="218" y1="18.3748" x2="5.4362" y2="18.9795" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E323FF"/>
                        <stop offset="1" stop-color="#7517F8"/>
                        </linearGradient>
                        </defs>
                    </svg>
                    <table class="mt-6 -mb-2 w-full text-gray-600 dark:text-gray-400">
                        <tbody>
                            <tr>
                                <td class="py-2">New Customers</td>
                                <td class="text-gray-500">142</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E323FF"/>
                                        <stop offset="1" stop-color="#7517F8"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Existing Customers</td>
                                <td class="text-gray-500">1827</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#8AFF6C"/>
                                        <stop offset="1" stop-color="#02C751"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div class="lg:h-full py-8 px-6 text-gray-600 dark:text-gray-400 rounded-xl bg-white dark:bg-dark-header">
                    <h5 class="text-xl text-gray-700 dark:text-gray-500">Active Projects</h5>
                    <svg class="w-full" viewBox="0 0 1000 500"   xmlns="http://www.w3.org/2000/svg" >     		     <path d="  M0,500  h66.66666666666667  v-289.2526354965531  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M83.33333333333333,500  h66.66666666666667  v-80.00071573694512  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M166.66666666666666,500  h66.66666666666667  v-125.93285546340209  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M250,500  h66.66666666666667  v-324.4381963554072  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M333.3333333333333,500  h66.66666666666667  v-217.51495295520542  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M416.66666666666663,500  h66.66666666666667  v-381.49380746433917  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M500,500  h66.66666666666667  v-236.50725092313903  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M583.3333333333333,500  h66.66666666666667  v-257.7504822707  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M666.6666666666666,500  h66.66666666666667  v-76.68879775895343  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M750,500  h66.66666666666667  v-204.7521413659322  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M833.3333333333333,500  h66.66666666666667  v-226.30308453282  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> <path d="  M916.6666666666666,500  h66.66666666666667  v-157.1383351721643  q0,-33.333333333333336 -33.333333333333336,-33.333333333333336  h-0  q-33.333333333333336,0 -33.333333333333336,33.333333333333336  Z" fill="#f7459f" /> </svg>

                    <div class="mt-6">
                        <div class="mt-2 flex justify-center gap-4">
                            <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-500">42</h3>
                            <div class="flex items-end gap-1 text-green-500">
                                <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                                </svg>
                                <span>10.2%</span>
                            </div>
                        </div>
                        <span class="block text-center text-gray-500">Against last week #38</span>
                    </div>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <tbody>
                            <tr>
                                <td class="py-2 dark:text-gray-400">FathERP Projects</td>
                                <td class="text-gray-500">8</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7C8.62687 7 7.61194 16 17.7612 16C27.9104 16 25.3731 9 34 9C42.6269 9 44.5157 5 51.2537 5C57.7936 5 59.3731 14.5 68 14.5" stroke="url(#paint0_linear_622:13631)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13631" x1="68" y1="7.74997" x2="1.69701" y2="8.10029" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E323FF"/>
                                        <stop offset="1" stop-color="#7517F8"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 dark:text-gray-400">FathWA Project</td>
                                <td class="text-gray-500">10</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 12.929C8.69077 12.929 7.66833 9.47584 17.8928 9.47584C28.1172 9.47584 25.5611 15.9524 34.2519 15.9524C42.9426 15.9524 44.8455 10.929 51.6334 10.929C58.2217 10.929 59.3092 5 68 5" stroke="url(#paint0_linear_622:13640)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13640" x1="34" y1="5" x2="34" y2="15.9524" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#8AFF6C"/>
                                        <stop offset="1" stop-color="#02C751"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 dark:text-gray-400">FathCMS Project</td>
                                <td class="text-gray-500">16</td>
                                <td>
                                    <svg class="w-16 ml-auto" viewBox="0 0 68 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 6C8.62687 6 6.85075 12.75 17 12.75C27.1493 12.75 25.3731 9 34 9C42.6269 9 42.262 13.875 49 13.875C55.5398 13.875 58.3731 6 67 6" stroke="url(#paint0_linear_622:13649)" stroke-width="2" stroke-linejoin="round"/>
                                        <defs>
                                        <linearGradient id="paint0_linear_622:13649" x1="67" y1="7.96873" x2="1.67368" y2="8.44377" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFD422"/>
                                        <stop offset="1" stop-color="#FF7D05"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DashboardSales'
}
</script>

<script setup>
import DashboardAgenda from "./Agenda.vue"

</script>