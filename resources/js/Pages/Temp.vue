<template>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50">
        <!-- Navigation - Modernized with gradient and subtle animation -->
        <nav class="bg-white backdrop-blur-sm bg-opacity-90 sticky top-0 z-50 border-b border-indigo-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <h1
                                    class="ml-2 text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                    TicketIt</h1>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="text-indigo-600 hover:text-indigo-800 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')"
                                class="text-indigo-600 hover:text-indigo-800 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            Log in
                            </Link>
                            <Link :href="route('register')"
                                class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-105">
                            Sign up
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section - Redesigned with better spacing and visual elements -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                            <div>
                                <div
                                    class="inline-block px-4 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700 mb-4">
                                    Reimagining Event Management
                                </div>
                                <h1
                                    class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <span class="block">Event Ticket Generator</span>
                                    <span
                                        class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mt-2">with
                                        QR Code Verification</span>
                                </h1>
                                <p class="mt-6 text-base text-gray-500 sm:text-lg md:text-xl max-w-xl">
                                    Create, distribute, and verify event tickets seamlessly. A simple solution designed
                                    for
                                    event
                                    organizers to handle ticketing efficiently with style.
                                </p>
                                <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                                    <Link :href="route('register')"
                                        class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 md:py-4 md:text-lg md:px-10 shadow-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Get started
                                    </Link>
                                    <Link :href="route('login')"
                                        class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-indigo-300 text-base font-medium rounded-full text-indigo-700 bg-white hover:bg-indigo-50 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:scale-105">
                                    Log in
                                    </Link>
                                </div>
                            </div>
                            <div class="hidden lg:block">
                                <div class="relative">
                                    <div
                                        class="absolute -left-8 -top-8 w-72 h-72 bg-purple-200 rounded-full filter blur-3xl opacity-30">
                                    </div>
                                    <div
                                        class="absolute -right-8 -bottom-8 w-72 h-72 bg-indigo-200 rounded-full filter blur-3xl opacity-30">
                                    </div>
                                    <div class="relative bg-white p-6 rounded-xl shadow-xl border border-indigo-100">
                                        <div class="flex justify-between items-center mb-4">
                                            <div>
                                                <h3 class="font-bold text-gray-800">Summer Music Festival</h3>
                                                <p class="text-sm text-gray-500">July 15, 2025</p>
                                            </div>
                                            <div
                                                class="h-12 w-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                            <div class="flex justify-center">
                                                <svg class="h-32 w-32 text-indigo-800" viewBox="0 0 100 100"
                                                    fill="none">
                                                    <rect x="10" y="10" width="80" height="80" rx="10" fill="white"
                                                        stroke="currentColor" stroke-width="4" />
                                                    <path d="M20 20h60v60h-60z" fill="currentColor"
                                                        fill-opacity="0.1" />
                                                    <path
                                                        d="M30 30h10v10h-10zM50 30h10v10h-10zM70 30h-10v10h10zM30 50h10v10h-10zM50 50h10v10h-10zM70 50h-10v10h10zM30 70h10v-10h-10zM50 70h10v-10h-10zM70 70h-10v-10h10z"
                                                        fill="currentColor" />
                                                </svg>
                                            </div>
                                            <p class="text-center text-xs text-gray-500 mt-2">Scan to verify</p>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-xs text-gray-500">Seat</p>
                                                <p class="font-bold">A-12</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500">Gate</p>
                                                <p class="font-bold">East</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500">Time</p>
                                                <p class="font-bold">6:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Features Section - Made more visually interesting with card design -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700">
                        Features
                    </h2>
                    <p class="mt-4 text-3xl font-extrabold text-gray-900 sm:text-4xl">Everything you need for event
                        ticketing
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                        Streamline your event management process with these powerful features.
                    </p>
                </div>

                <div class="mt-16">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 border border-indigo-50 group">
                            <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                            <div class="p-6">
                                <div
                                    class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition-colors duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">QR Code Generation</h3>
                                <p class="text-base text-gray-500">
                                    Generate unique QR codes for each ticket, ensuring security and preventing
                                    duplication.
                                </p>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 border border-indigo-50 group">
                            <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                            <div class="p-6">
                                <div
                                    class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition-colors duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Real-time Scanning</h3>
                                <p class="text-base text-gray-500">
                                    Verify tickets at the entrance with a simple scan, reducing wait times and improving
                                    security.
                                </p>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 border border-indigo-50 group">
                            <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                            <div class="p-6">
                                <div
                                    class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors duration-300">
                                    <svg class="h-6 w-6 text-indigo-600 group-hover:text-white transition-colors duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Bulk PDF Export</h3>
                                <p class="text-base text-gray-500">
                                    Download multiple tickets as PDFs for easy distribution and record-keeping.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works - Redesigned into a vertical timeline -->
        <div class="py-16 bg-gradient-to-br from-indigo-50 to-purple-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700">
                        Process
                    </h2>
                    <p class="mt-4 text-3xl font-extrabold text-gray-900 sm:text-4xl">How it works</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                        Four simple steps to streamline your event ticketing process.
                    </p>
                </div>

                <div class="relative">
                    <!-- Vertical line -->
                    <div
                        class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 bg-gradient-to-b from-indigo-400 to-purple-500 h-full rounded-full">
                    </div>

                    <div class="space-y-12 relative">
                        <!-- Step 1 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="flex-1 md:pr-12 md:text-right order-2 md:order-1 mt-6 md:mt-0">
                                <h3 class="text-xl font-bold text-gray-900">Create your event</h3>
                                <p class="mt-2 text-base text-gray-500">Add event details like name, date, venue, and
                                    ticket
                                    capacity.</p>
                            </div>
                            <div class="md:mx-auto flex items-center justify-center order-1 md:order-2 z-10">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg flex items-center justify-center text-white text-xl font-bold">
                                    1</div>
                            </div>
                            <div class="flex-1 md:pl-12 order-3 mt-6 md:mt-0 md:visible invisible"></div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div
                                class="flex-1 md:pr-12 md:text-right order-2 md:order-3 mt-6 md:mt-0 md:visible invisible">
                            </div>
                            <div class="md:mx-auto flex items-center justify-center order-1 md:order-2 z-10">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg flex items-center justify-center text-white text-xl font-bold">
                                    2</div>
                            </div>
                            <div class="flex-1 md:pl-12 order-3 md:order-1 mt-6 md:mt-0">
                                <h3 class="text-xl font-bold text-gray-900">Generate tickets</h3>
                                <p class="mt-2 text-base text-gray-500">The system creates unique QR-coded tickets for
                                    your
                                    event.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="flex-1 md:pr-12 md:text-right order-2 md:order-1 mt-6 md:mt-0">
                                <h3 class="text-xl font-bold text-gray-900">Distribute tickets</h3>
                                <p class="mt-2 text-base text-gray-500">Download tickets as PDFs and send them to
                                    attendees.</p>
                            </div>
                            <div class="md:mx-auto flex items-center justify-center order-1 md:order-2 z-10">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg flex items-center justify-center text-white text-xl font-bold">
                                    3</div>
                            </div>
                            <div class="flex-1 md:pl-12 order-3 mt-6 md:mt-0 md:visible invisible"></div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div
                                class="flex-1 md:pr-12 md:text-right order-2 md:order-3 mt-6 md:mt-0 md:visible invisible">
                            </div>
                            <div class="md:mx-auto flex items-center justify-center order-1 md:order-2 z-10">
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg flex items-center justify-center text-white text-xl font-bold">
                                    4</div>
                            </div>
                            <div class="flex-1 md:pl-12 order-3 md:order-1 mt-6 md:mt-0">
                                <h3 class="text-xl font-bold text-gray-900">Scan at the event</h3>
                                <p class="mt-2 text-base text-gray-500">Verify tickets at the entrance using our QR
                                    scanner.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Section - Redesigned with card-based layout -->
        <div class="bg-white py-16 lg:py-24">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 shadow-xl">
                    <div class="absolute right-0 bottom-0 opacity-20">
                        <svg width="404" height="384" fill="none" viewBox="0 0 404 384">
                            <defs>
                                <pattern id="de316486-4a29-4312-bdfc-fbce2132a2c1" x="0" y="0" width="20" height="20"
                                    patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-white" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="404" height="384" fill="url(#de316486-4a29-4312-bdfc-fbce2132a2c1)" />
                        </svg>
                    </div>
                    <div class="relative px-6 py-16 sm:px-12 lg:px-16">
                        <div class="md:grid md:grid-cols-2 md:gap-12 items-center">
                            <div>
                                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                                    Streamline your event management
                                </h2>
                                <p class="mt-4 text-lg text-indigo-100">
                                    Join hundreds of event organizers who have simplified their ticketing process with
                                    our
                                    platform.
                                </p>
                                <div class="mt-10">
                                    <Link :href="route('register')"
                                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-md text-indigo-700 bg-white hover:bg-indigo-50 transition duration-300 ease-in-out transform hover:scale-105">
                                    Get started for free
                                    </Link>
                                </div>
                            </div>
                            <div class="mt-12 md:mt-0">
                                <div class="bg-white rounded-lg p-6 shadow-lg">
                                    <div class="flex items-center mb-6">
                                        <div
                                            class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-gray-900">Easy to use</h4>
                                            <p class="text-gray-500">Create tickets in minutes</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-6">
                                        <div
                                            class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-gray-900">Secure</h4>
                                            <p class="text-gray-500">Fraud-proof verification</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div
                                            class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-gray-900">Analytics</h4>
                                            <p class="text-gray-500">Track attendance in real-time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section - More visually appealing with waves -->
        <div class="relative bg-gray-900">
            <div class="absolute inset-x-0 bottom-0">
                <svg class="w-full text-white" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
                    <path d="M0 48h1440V0C1320 0 1200 48 960 48 720 48 480 0 360 0 240 0 120 48 0 48z" />
                </svg>
            </div>
            <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8 relative z-10">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Ready to streamline your event management?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-300">
                    Sign up now and start creating events and tickets in minutes.
                </p>
                <Link :href="route('register')"
                    class="mt-8 inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-md text-gray-900 bg-white hover:bg-gray-100 sm:w-auto transition duration-300 ease-in-out transform hover:scale-105">
                Sign up for free
                </Link>
            </div>
        </div>

        <!-- Footer - Redesigned with modern styling -->
        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">About</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Company</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Team</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Careers</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Resources</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Guides</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Documentation</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Blog</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Legal</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Privacy</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Terms</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Security</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">Contact</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Support</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Sales</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-indigo-600 transition-colors">Feedback</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 border-t border-gray-200 pt-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <h1
                                class="ml-2 text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                TicketIt</h1>
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <p class="mt-8 text-center text-base text-gray-400">
                        &copy; 2025 TicketIt. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
