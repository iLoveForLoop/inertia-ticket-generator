<template>
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
</template>

<script>
export default {

}
</script>

<style></style>
