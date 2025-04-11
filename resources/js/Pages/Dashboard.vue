<template>
    <MainLayout>
        <div class="min-h-screen bg-gray-50">
            <!-- Header -->
            <!-- <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">Event Dashboard</h1>
                </div>
            </div> -->

            <!-- Stats Cards -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <StatCard title="Total Events" :value="stats.total_events" icon="calendar" color="blue" />
                    <StatCard title="Upcoming Events" :value="stats.upcoming_events" icon="clock" color="green" />
                    <StatCard title="Total Tickets" :value="stats.total_tickets" icon="ticket" color="purple" />
                    <StatCard title="Scanned Tickets" :value="stats.scanned_tickets" icon="check-circle"
                        color="indigo" />
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Events List -->
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <!-- <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h2 class="text-lg font-medium text-gray-900">Your Events</h2>
                                <Link :href="route('events.create')"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                New Event
                                </Link>
                            </div> -->

                            <div class="divide-y divide-gray-200">
                                <div v-for="event in events.data" :key="event.id"
                                    class="p-6 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-12 w-12 rounded-md overflow-hidden mr-4">
                                            <img v-if="event.image_path" :src="'/storage/' + event.image_path"
                                                :alt="event.name" class="h-full w-full object-cover">
                                            <div v-else
                                                class="h-full w-full flex items-center justify-center bg-indigo-50">
                                                <svg class="h-6 w-6 text-indigo-300" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <Link :href="route('events.show', event.id)"
                                                    class="text-lg font-medium text-blue-600 hover:text-blue-800">
                                                {{ event.name }}
                                                </Link>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                    :class="{
                                                        'bg-green-100 text-green-800': new Date(event.date_time) > new Date(),
                                                        'bg-gray-100 text-gray-800': new Date(event.date_time) <= new Date()
                                                    }">
                                                    {{ new Date(event.date_time) > new Date() ? 'Upcoming' : 'Past' }}
                                                </span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ event.description }}
                                            </p>
                                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ formatDate(event.date_time) }}
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ event.venue }}
                                            </div>
                                            <div class="mt-4">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <span class="text-sm font-medium text-gray-900">{{
                                                            event.scanned_tickets_count }}</span>
                                                        <span class="text-sm text-gray-500"> / {{ event.tickets_count }}
                                                            tickets scanned</span>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <Link :href="route('events.show', event.id)"
                                                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                                        Manage
                                                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                        </Link>
                                                    </div>
                                                </div>
                                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                                        :style="`width: ${(event.scanned_tickets_count / event.tickets_count) * 100}%`">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="px-6 py-4 border-t border-gray-200">
                                <Pagination :links="events.links" />
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div>
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-medium text-gray-900">Recent Scans</h2>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div v-if="stats.recent_activity.length === 0" class="p-6 text-center text-gray-500">
                                    No recent ticket scans
                                </div>
                                <div v-for="ticket in stats.recent_activity" :key="ticket.id" class="p-6">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">Ticket #{{ ticket.ticket_number
                                                }}</p>
                                            <p class="text-sm text-gray-500">Scanned at {{
                                                formatDateTime(ticket.scanned_at) }}</p>
                                            <div class="mt-1">
                                                <Link :href="route('events.show', ticket.event_id)"
                                                    class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                                {{ ticket.event?.name }}
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import StatCard from '@/Components/StatCard.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    events: Object,
    stats: Object
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const formatDateTime = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
