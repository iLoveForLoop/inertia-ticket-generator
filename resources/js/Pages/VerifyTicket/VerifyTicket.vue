<template>
    <MainLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-gray-800">Scanning tickets for: <span
                    class="font-semibold text-blue-600">{{ event.name }}</span></h1>
        </template>
        <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

                <!-- Header -->
                <!-- <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                        Ticket Verification
                    </h1>
                    <p class="mt-3 text-xl text-gray-600">
                        Scanning tickets for: <span class="font-semibold text-blue-600">{{ event.name }}</span>
                    </p>
                </div> -->

                <!-- Event Info Card -->
                <!-- <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                    <div class="p-6 sm:flex sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 h-12 w-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl">
                                    {{ event.name.charAt(0) }}
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900">{{ event.name }}</h3>
                                    <p class="text-sm text-gray-500">
                                        {{ event.date_time ? formatDate(event.date_time) : 'No date set' }} • {{
                                            event.venue }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ event.ticket_capacity }} tickets
                            </span>
                        </div>
                    </div>
                </div> -->

                <!-- Verification Results -->
                <div v-if="$page.props.flash.success || $page.props.flash.error"
                    class="mt-8 transition-all duration-300 ease-in-out">
                    <div :class="{
                        'bg-green-50 border-green-200': $page.props.flash.success,
                        'bg-red-50 border-red-200': $page.props.flash.error
                    }" class="border rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg v-if="$page.props.flash.success" class="h-5 w-5 text-green-400" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg v-else class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
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
                                <div v-if="$page.props.ticket" class="mt-2 text-sm text-gray-700">
                                    <p>Ticket #: {{ $page.props.ticket.ticket_number }}</p>
                                    <p v-if="$page.props.ticket.scanned_at">Scanned at: {{
                                        formatDateTime($page.props.ticket.scanned_at) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scanner Component -->
                <Scanner :event="event" />



            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Scanner from '../Partials/Scanner.vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    event: Object
});

const formatDate = (dateString) => {
    if (!dateString) return 'No date set';
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString('en-US', options);
};

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
</script>

<style scoped>
/* Custom styles if needed */
</style>
