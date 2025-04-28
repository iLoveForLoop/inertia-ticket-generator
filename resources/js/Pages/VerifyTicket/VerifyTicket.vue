<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Scanner from '../Partials/Scanner.vue';
import { usePage } from '@inertiajs/vue3';
import { ArrowLeftIcon } from '@heroicons/vue/20/solid';
import { ref } from 'vue';

const props = defineProps({
    event: Object
});

// const formatDate = (dateString) => {
//     if (!dateString) return 'No date set';
//     const options = {
//         year: 'numeric',
//         month: 'short',
//         day: 'numeric',
//         hour: '2-digit',
//         minute: '2-digit'
//     };
//     return new Date(dateString).toLocaleDateString('en-US', options);
// };

const formatDateTime = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
};

const goBack = () => {
    window.history.back()
}

const isShowing = ref(false)

</script>

<template>
    <MainLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <button @click="goBack"
                        class="hidden md:block md:p-2 md:hover:bg-gray-100 md:rounded-full md:transition-colors">
                        <ArrowLeftIcon class="w-6 h-6 cursor-pointer" />
                    </button>
                    <h1 class="md:text-2xl font-bold text-slate-700">Scanning tickets for
                        <span class="text-indigo-600">{{ event.name }}</span>
                    </h1>
                </div>

                <div class="text-sm text-slate-500">
                    <span class="hidden sm:inline">Event ID:</span> #{{ event.id }}
                </div>
            </div>
        </template>

        <div class="min-h-screen bg-slate-200 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto space-y-6">

                <!-- Verification Results Card -->
                <div v-if="$page.props.flash.success || $page.props.flash.error"
                    class="transition-all duration-300 ease-in-out">
                    <div :class="{
                        'bg-green-50 border border-green-200': $page.props.flash.success,
                        'bg-red-50 border border-red-200': $page.props.flash.error
                    }" class="rounded-xl p-4 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <svg v-if="$page.props.flash.success" class="h-5 w-5 text-green-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg v-else class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 :class="{
                                    'text-green-800': $page.props.flash.success,
                                    'text-red-800': $page.props.flash.error
                                }" class="text-sm font-medium">
                                    {{ $page.props.flash.success || $page.props.flash.error }}
                                </h3>
                                <div v-if="$page.props.ticket" class="mt-2 text-sm text-slate-600 space-y-1">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Ticket #{{ $page.props.ticket.ticket_number }}
                                    </p>
                                    <p v-if="props.ticket.scanned_at" class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Scanned at: {{ formatDateTime(props.ticket.scanned_at) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scanner Component -->
                <Scanner :event="event" />

                <!-- Quick Stats -->
                <!-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-indigo-50 text-indigo-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total Tickets</p>
                                <p class="text-lg font-semibold text-slate-800">{{ event.tickets_count }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-green-50 text-green-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Scanned</p>
                                <p class="text-lg font-semibold text-slate-800">{{ event.scanned_tickets_count }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg bg-blue-50 text-blue-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Remaining</p>
                                <p class="text-lg font-semibold text-slate-800">{{ event.tickets_count -
                                    event.scanned_tickets_count }}</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </MainLayout>
</template>



<style scoped>
/* Custom styles if needed */
</style>
