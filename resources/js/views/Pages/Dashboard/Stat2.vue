<template>
    <div class="h-full py-8 px-6 space-y-6 rounded-xl bg-white dark:bg-dark-header">
        <h5 class="text-xl text-gray-600">Grand Total</h5>
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-1/2" viewBox="0 0 180 180"><path id="0" fill="#c450" d="M90, 0 A90,90 0 0 1 138.65647225764334,14.286410021442094 L122.43764817176222,39.52427334762806 A60,60 0 0 0 90,30 Z"></path><path id="1" fill="#a59292" d="M138.65647225764334, 14.286410021442094 A90,90 0 0 1 171.86569311818414,52.61005094575147 L144.5771287454561,65.07336729716765 A60,60 0 0 0 122.43764817176222,39.52427334762806 Z"></path><path id="2" fill="#14f2a9" d="M171.86569311818414, 52.61005094575147 A90,90 0 0 1 179.08453934370425,102.80409504494587 L149.38969289580285,98.53606336329725 A60,60 0 0 0 144.5771287454561,65.07336729716765 Z"></path><path id="3" fill="#83d66b" d="M179.08453934370425, 102.80409504494587 A90,90 0 0 1 158.02120211065886,148.93314910490443 L135.34746807377257,129.2887660699363 A60,60 0 0 0 149.38969289580285,98.53606336329725 Z"></path><path id="4" fill="#a25241" d="M158.02120211065886, 148.93314910490443 A90,90 0 0 1 115.36278079974112,176.35235578780862 L106.90852053316075,147.5682371918724 A60,60 0 0 0 135.34746807377257,129.2887660699363 Z"></path><path id="5" fill="#57551b" d="M115.36278079974112, 176.35235578780862 A90,90 0 0 1 64.65229091573313,176.3567811128887 L73.10152727715541,147.5711874085925 A60,60 0 0 0 106.90852053316075,147.5682371918724 Z"></path><path id="6" fill="#b407c9" d="M64.65229091573313, 176.3567811128887 A90,90 0 0 1 21.989084700215585,148.94502014662095 L44.65938980014373,129.2966800977473 A60,60 0 0 0 73.10152727715541,147.5711874085925 Z"></path><path id="7" fill="#54d979" d="M21.989084700215585, 148.94502014662095 A90,90 0 0 1 0.917696749282257,102.81964303509118 L30.611797832854833,98.54642869006078 A60,60 0 0 0 44.65938980014373,129.2966800977473 Z"></path><path id="8" fill="#7ad3a" d="M0.917696749282257, 102.81964303509118 A90,90 0 0 1 8.127782351553293,52.624339774053865 L35.4185215677022,65.08289318270258 A60,60 0 0 0 30.611797832854833,98.54642869006078 Z"></path><path id="9" fill="#896aed" d="M8.127782351553293, 52.624339774053865 A90,90 0 0 1 41.330313969167925,14.294903331015888 L57.55354264611195,39.52993555401059 A60,60 0 0 0 35.4185215677022,65.08289318270258 Z"></path><path id="10" fill="#ef78ce" d="M41.330313969167925, 14.294903331015888 A90,90 0 0 1 89.98429203681187,0.0000013707783779182137 L89.98952802454124,30.000000913852254 A60,60 0 0 0 57.55354264611195,39.52993555401059 Z"></path></svg>
        </div>
        <div>
            <div class="mt-2 flex justify-center gap-4">
                <h3 class="text-3xl font-bold text-gray-700">$230,174</h3>
                <div class="flex items-end gap-1 text-green-500">
                    <svg class="w-3" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.00001 0L12 8H-3.05176e-05L6.00001 0Z" fill="currentColor"/>
                    </svg>
                    <span>2.4%</span>
                </div>
            </div>
            <!-- <span class="block text-center text-gray-500">Against last month $24,149</span> -->
        </div>
        <table class="w-full text-gray-600">
            <tbody>
                <tr>
                    <td class="py-2 dark:text-gray-400">Development</td>
                    <td class="text-gray-500">143</td>
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
                    <td class="py-2 dark:text-gray-400">Services</td>
                    <td class="text-gray-500">2481</td>
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
</template>