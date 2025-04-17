<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import StatCard from '@/Components/StatCard.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

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

const greeting = computed(() => {
    const now = new Date();
    const hour = now.getHours();

    if (hour >= 5 && hour < 12) {
        return 'Good Morning';
    } else if (hour >= 12 && hour < 18) {
        return 'Good Afternoon';
    } else {
        return 'Good evening';
    }
});
</script>

<template>
    <MainLayout>
        <template #header>
            <h1 class="text-3xl font-bold text-slate-700">{{ greeting }}, {{ $page.props.auth.user.name }}</h1>
        </template>

        <!-- Main container with proper padding and structure -->
        <div class="min-h-screen p-6  md:p-0">
            <!-- Stats Cards Section -->
            <div class="mb-6">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <StatCard title="Total Events" :value="stats.total_events" icon="calendar" color="blue" />
                    <StatCard title="Upcoming Events" :value="stats.upcoming_events" icon="clock" color="green" />
                    <StatCard title="Total Tickets" :value="stats.total_tickets" icon="ticket" color="purple" />
                    <StatCard title="Scanned Tickets" :value="stats.scanned_tickets" icon="check-circle"
                        color="indigo" />
                </div>
            </div>

            <!-- Content area with two-column layout for desktop -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Events List (wider column) -->
                <div class="lg:col-span-2">
                    <!-- <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900">Your Events</h2>
                            <div class="text-sm text-gray-500" v-if="events.data && events.data.length > 0">
                                Showing {{ events.data.length }} of {{ events.total }} events
                            </div>
                        </div>
                    </div> -->

                    <!-- Empty state when no events are available -->
                    <div v-if="!events.data || events.data.length === 0"
                        class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="p-12 text-center">
                            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-50">
                                <svg class="h-16 w-16 text-blue-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-6 text-xl font-medium text-gray-900">No events yet</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
                                Get started by creating your first event. You can add details, set the date and venue,
                                and start
                                selling tickets.
                            </p>
                            <div class="mt-6">
                                <Link :href="route('events.create')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create your first event
                                <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Grid of vertical cards (only shown when there are events) -->
                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div v-for="event in events.data" :key="event.id"
                            class="bg-white shadow rounded-lg overflow-hidden transition-all duration-200 hover:shadow-lg flex flex-col">
                            <!-- Event Image (top portion) -->
                            <div class="relative h-48 w-full bg-gray-100">
                                <img v-if="event.image_path" :src="'/storage/' + event.image_path" :alt="event.name"
                                    class="h-full w-full object-cover">
                                <div v-else class="h-full w-full flex items-center justify-center bg-indigo-50">
                                    <svg class="h-16 w-16 text-indigo-300" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <!-- Status badge -->
                                <span
                                    class="absolute top-3 right-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                    :class="{
                                        'bg-green-100 text-green-800': new Date(event.date_time) > new Date(),
                                        'bg-gray-100 text-gray-800': new Date(event.date_time) <= new Date()
                                    }">
                                    {{ new Date(event.date_time) > new Date() ? 'Upcoming' : 'Past' }}
                                </span>
                            </div>

                            <!-- Event Details -->
                            <div class="p-4 flex-1 flex flex-col bg-slate-200 shadow-lg">
                                <div class="mb-2">
                                    <Link :href="route('events.show', event.id)"
                                        class="text-lg font-medium text-blue-600 hover:text-blue-800">
                                    {{ event.name }}
                                    </Link>
                                </div>

                                <p class="text-sm text-gray-600 line-clamp-2 mb-3 flex-grow">{{ event.description }}</p>

                                <div class="space-y-2 mt-auto">
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ formatDate(event.date_time) }}
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ event.venue }}
                                    </div>
                                </div>

                                <!-- Tickets progress -->
                                <div class="mt-4 pt-3 border-t border-gray-100">
                                    <div class="flex items-center justify-between mb-1">
                                        <div>
                                            <span class="text-xs font-medium text-gray-900">{{
                                                event.scanned_tickets_count
                                            }}</span>
                                            <span class="text-xs text-gray-500"> / {{ event.tickets_count }} tickets
                                                scanned</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full"
                                            :style="`width: ${(event.scanned_tickets_count / event.tickets_count) * 100}%`">
                                        </div>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <Link :href="route('events.show', event.id)"
                                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-blue-600 rounded-md text-sm font-medium text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        Manage Event
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination (only shown when there are events) -->
                    <!-- <div v-if="events.data && events.data.length > 0"
                        class="mt-6 bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <Pagination :links="events.links" />
                        </div>
                    </div> -->
                </div>

                <!-- Recent Activity (narrower column) -->
                <div class="lg:col-span-1">
                    <div class="rounded-lg overflow-hidden sticky top-6 bg-slate-700 text-gray-50 shadow-xl">
                        <div class="px-6 py-4 ">
                            <h2 class="text-lg font-medium text-gray-50">Recent Scans</h2>
                        </div>
                        <div class="">
                            <div v-if="stats.recent_activity.length === 0" class="p-6 text-center text-gray-500">
                                <div
                                    class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p>No recent ticket scans</p>
                                <p class="mt-1 text-xs">Scan activity will appear here</p>
                            </div>
                            <div v-for="ticket in stats.recent_activity" :key="ticket.id" class="p-6 md:py-2 md:px-6 ">
                                <div class="flex items-start ">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-50 flex items-center justify-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="ml-4 truncate">
                                        <p class="text-sm font-medium text-gray-300 ">Ticket #{{
                                            ticket.ticket_number }}
                                        </p>
                                        <p class="text-sm text-gray-500">Scanned at {{ formatDateTime(ticket.scanned_at)
                                        }}</p>
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
    </MainLayout>
</template>


<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
