<template>
    <div class="relative bg-gradient-to-b from-white to-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-slate-900 sm:text-5xl md:text-6xl">
                            <span class="block">Event Ticket Generator</span>
                            <span
                                class="block text-transparent bg-clip-text bg-gradient-to-r from-slate-700 to-indigo-500">with
                                QR Verification</span>
                        </h1>
                        <p
                            class="mt-4 text-lg text-slate-600 sm:mt-5 sm:text-xl sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Create, distribute, and verify event tickets seamlessly. A simple solution designed for
                            event
                            organizers to handle ticketing efficiently.
                        </p>
                        <div
                            class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start space-y-3 sm:space-y-0 sm:space-x-4">
                            <div class="rounded-md shadow">
                                <Link :href="route('register')"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-slate-700 hover:bg-slate-800 md:py-4 md:text-lg md:px-10 transition-colors duration-200">
                                Get started
                                </Link>
                            </div>
                            <div>
                                <Link :href="route('login')"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-slate-300 text-base font-medium rounded-md text-slate-700 bg-white hover:bg-slate-50 md:py-4 md:text-lg md:px-10 transition-colors duration-200">
                                Log in
                                </Link>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 hidden lg:block">
            <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full flex items-center justify-center p-10">
                <div class="relative w-full h-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-slate-700 to-indigo-500 rounded-2xl shadow-2xl transform rotate-2">
                    </div>
                    <div
                        class="absolute inset-0 bg-white rounded-2xl shadow-lg flex items-center justify-center transform -rotate-1">
                        <div class="p-6 text-center">
                            <div
                                class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-slate-700 mb-4">
                                <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v12h16V6H4zm9 3h5v2h-5V9zm0 4h5v2h-5v-2zm-6-4h4v6H7V9z" />
                                    <rect x="8" y="9" width="2" height="2" />
                                    <rect x="8" y="12" width="2" height="2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900">Sample Ticket</h3>
                            <!-- <p class="mt-2 text-sm text-slate-500">Event Name Here</p> -->
                            <div class="mt-4 flex justify-center">
                                <div class=" h-auto w-auto bg-slate-100 flex items-center justify-center">
                                    <div
                                        class="h-auto w-auto bg-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                        <!-- QR CODE -->
                                        <img src=" /logo/sample.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style></style>
