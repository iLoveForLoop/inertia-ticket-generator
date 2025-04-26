<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import Searchbar from '@/Components/Searchbar.vue';

defineProps({
    events: {
        type: Array,
        default: () => []
    },
    search: {
        type: String
    }
});

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const handleSearch = (data) => {
    router.get(route('events.tickets'),
        { search: data },
        { preserveState: true, replace: true })
}
</script>

<template>
    <MainLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h1 class="md:text-2xl font-bold text-slate-700">Tickets</h1>
                <Searchbar @search="handleSearch" :search="search" />
            </div>

        </template>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            <!-- Events List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <li v-for="event in events" :key="event.id">
                        <Link :href="`/events/tickets/${event.id}`" class="block hover:bg-gray-50">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <!-- Event Image/Icon (small) -->
                                    <div class="flex-shrink-0 h-12 w-12 rounded-md overflow-hidden mr-4">
                                        <img v-if="event.image_url" :src="event.image_url" :alt="event.name"
                                            class="h-full w-full object-cover">
                                        <div v-else class="h-full w-full flex items-center justify-center bg-indigo-50">
                                            <svg class="h-6 w-6 text-indigo-300" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Event Title & Description -->
                                    <div>
                                        <h3 class="text-lg font-medium text-indigo-600">{{ event.name }}</h3>
                                        <p class="mt-1 text-sm text-gray-500 line-clamp-1">
                                            {{ event.description || 'No description provided' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="ml-2 flex-shrink-0">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium"
                                        :class="event.is_upcoming ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                                        {{ event.is_upcoming ? 'Upcoming' : 'Past' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Event Details -->
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <div class="flex items-center text-sm text-gray-500 mr-6">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ event.venue }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ formatDate(event.date_time) }}
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <span class="font-medium">{{ event.tickets_count }} / {{ event.ticket_capacity
                                        }}</span>
                                    <span class="ml-1">tickets</span>
                                    <svg class="ml-2 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Empty State -->
            <div v-if="events.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No events yet</h3>
                <p class="mt-1 text-gray-500">Get started by creating your first event.</p>
                <div class="mt-6">
                    <Link href="/events/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    New Event
                    </Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
