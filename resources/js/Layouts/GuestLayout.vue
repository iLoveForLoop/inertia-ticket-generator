<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-gradient-to-b from-white to-slate-50 flex flex-col items-center justify-center p-6">
        <Link href="/" class="hidden md:block fixed left-10 top-8 ">
        <ArrowLeftIcon class="h-7 w-7" />
        </Link>
        <!-- <div class="mb-8">
            <Link href="/">
            <h1 class="text-2xl font-bold tracking-tight">
                <span class="text-slate-700">Tick</span><span class="text-indigo-500">It</span>
            </h1>
            </Link>
        </div> -->

        <div
            class="w-full max-w-md bg-gradient-to-b from-white to-slate-50 rounded-xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8">
                <slot />
            </div>
        </div>


    </div>
</template>
