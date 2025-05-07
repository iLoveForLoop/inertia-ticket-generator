<template>
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
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<style></style>
