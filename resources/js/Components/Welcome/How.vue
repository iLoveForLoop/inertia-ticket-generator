<template>
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
</template>

<script>
export default {

}
</script>

<style></style>
