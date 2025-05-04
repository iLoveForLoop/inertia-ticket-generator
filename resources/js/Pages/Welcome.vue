<template>

    <Head title="Welcome" />
    <div class="min-h-screen bg-white">
        <!-- Navigation - Sleeker with subtle shadow -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                            <span class="text-slate-700">Tick</span><span class="text-indigo-500">It</span>
                        </h1>
                    </div>
                    <div class="flex items-center space-x-2">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="text-slate-600 hover:text-slate-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')"
                                class="text-slate-600 hover:text-slate-900 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Log in
                            </Link>
                            <Link :href="route('register')"
                                class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-slate-700 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-colors duration-200">
                            Sign up
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section - More dynamic with gradient and better spacing -->
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

        <!-- Features Section - Cards with hover effects -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <span
                        class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-slate-100 text-slate-700 mb-4">FEATURES</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">Powerful event ticketing</h2>
                    <p class="mt-4 max-w-2xl text-xl text-slate-600 mx-auto">
                        Everything you need to manage your event tickets efficiently.
                    </p>
                </div>

                <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        class="group relative bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-200">
                        <div
                            class="absolute -top-4 left-6 h-8 w-8 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 flex items-center justify-center text-white font-bold">
                            1
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium text-slate-900">QR Code Generation</h3>
                            <p class="mt-2 text-base text-slate-600">
                                Generate unique QR codes for each ticket, ensuring security and preventing duplication.
                            </p>
                        </div>
                        <div class="mt-6">
                            <svg class="h-6 w-6 text-slate-400 group-hover:text-slate-700 transition-colors duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="group relative bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-200">
                        <div
                            class="absolute -top-4 left-6 h-8 w-8 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 flex items-center justify-center text-white font-bold">
                            2
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium text-slate-900">Real-time Scanning</h3>
                            <p class="mt-2 text-base text-slate-600">
                                Verify tickets at the entrance with a simple scan, reducing wait times and improving
                                security.
                            </p>
                        </div>
                        <div class="mt-6">
                            <svg class="h-6 w-6 text-slate-400 group-hover:text-slate-700 transition-colors duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="group relative bg-white p-6 rounded-xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-200">
                        <div
                            class="absolute -top-4 left-6 h-8 w-8 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 flex items-center justify-center text-white font-bold">
                            3
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium text-slate-900">Bulk PDF Export</h3>
                            <p class="mt-2 text-base text-slate-600">
                                Download multiple tickets as PDFs for easy distribution and record-keeping.
                            </p>
                        </div>
                        <div class="mt-6">
                            <svg class="h-6 w-6 text-slate-400 group-hover:text-slate-700 transition-colors duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works - Timeline style -->
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <span
                        class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-slate-100 text-slate-700 mb-4">PROCESS</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">How it works</h2>
                    <p class="mt-4 max-w-2xl text-xl text-slate-600 lg:mx-auto">
                        Four simple steps to streamline your event ticketing process.
                    </p>
                </div>

                <div class="mt-16">
                    <div class="relative">
                        <!-- Vertical line -->
                        <div
                            class="hidden md:block absolute top-0 bottom-0 left-1/2 w-0.5 bg-slate-200 transform -translate-x-1/2">
                        </div>

                        <!-- Steps -->
                        <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-y-16">
                            <!-- Step 1 -->
                            <div class="relative md:pr-8">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 text-white font-bold shadow-md">
                                        1
                                    </div>
                                    <h3 class="ml-4 text-lg font-medium text-slate-900">Create your event</h3>
                                </div>
                                <p class="mt-2 ml-14 text-base text-slate-600">
                                    Add event details like name, date, venue, and ticket capacity.
                                </p>
                            </div>

                            <!-- Step 2 -->
                            <div class="relative md:pl-8 md:mt-0 mt-10">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 text-white font-bold shadow-md">
                                        2
                                    </div>
                                    <h3 class="ml-4 text-lg font-medium text-slate-900">Generate tickets</h3>
                                </div>
                                <p class="mt-2 ml-14 text-base text-slate-600">
                                    The system creates unique QR-coded tickets for your event.
                                </p>
                            </div>

                            <!-- Step 3 -->
                            <div class="relative md:pr-8 md:mt-0 mt-10">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 text-white font-bold shadow-md">
                                        3
                                    </div>
                                    <h3 class="ml-4 text-lg font-medium text-slate-900">Distribute tickets</h3>
                                </div>
                                <p class="mt-2 ml-14 text-base text-slate-600">
                                    Download tickets as PDFs and send them to attendees.
                                </p>
                            </div>

                            <!-- Step 4 -->
                            <div class="relative md:pl-8 md:mt-0 mt-10">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-slate-700 to-indigo-500 text-white font-bold shadow-md">
                                        4
                                    </div>
                                    <h3 class="ml-4 text-lg font-medium text-slate-900">Scan at the event</h3>
                                </div>
                                <p class="mt-2 ml-14 text-base text-slate-600">
                                    Verify tickets at the entrance using our QR scanner.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Section - More visual impact -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-br from-slate-700 to-indigo-600 rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-12 sm:p-16">
                        <div class="text-center">
                            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                                Join hundreds of event organizers
                            </h2>
                            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-200">
                                Who have simplified their ticketing process with our platform.
                            </p>
                            <div class="mt-8 flex justify-center">
                                <Link :href="route('register')"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-slate-700 bg-white hover:bg-slate-100 transition-colors duration-200">
                                Get started for free
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section - More emphasis -->
        <div class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:py-24 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">Ready to streamline your event management?</span>
                    </h2>
                    <p class="mt-4 text-lg leading-6 text-slate-300">
                        Sign up now and start creating events and tickets in minutes.
                    </p>
                    <div class="mt-8 flex justify-center space-x-4">
                        <Link :href="route('register')"
                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-slate-800 bg-white hover:bg-slate-100 transition-colors duration-200">
                        Sign up for free
                        </Link>
                        <Link :href="route('login')"
                            class="inline-flex items-center justify-center px-5 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-white hover:bg-opacity-10 transition-colors duration-200">
                        Log in
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer - Cleaner with social icons -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="border-t border-slate-200 pt-8">
                    <div class="flex flex-col items-center justify-between md:flex-row">
                        <div class="flex space-x-6">
                            <a href="#"
                                class="text-slate-600 hover:text-slate-900 transition-colors duration-200">About</a>
                            <a href="#"
                                class="text-slate-600 hover:text-slate-900 transition-colors duration-200">Terms</a>
                            <a href="#"
                                class="text-slate-600 hover:text-slate-900 transition-colors duration-200">Privacy</a>
                            <a href="#"
                                class="text-slate-600 hover:text-slate-900 transition-colors duration-200">Contact</a>
                        </div>
                        <div class="mt-8 md:mt-0 flex space-x-6">
                            <a href="#" class="text-slate-400 hover:text-slate-700 transition-colors duration-200">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-slate-400 hover:text-slate-700 transition-colors duration-200">
                                <span class="sr-only">GitHub</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <p class="mt-8 text-center text-base text-slate-500">
                        &copy; 2025 TicketIt. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
// import Head from '@inertiajs/vue3';
import { Link, Head } from '@inertiajs/vue3';
</script>
