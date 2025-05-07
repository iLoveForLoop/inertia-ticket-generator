<template>
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
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style></style>
