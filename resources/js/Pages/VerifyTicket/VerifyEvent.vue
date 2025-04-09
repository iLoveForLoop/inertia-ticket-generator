<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    events: {
        type: Array,
        required: true,
        default: () => []
    }
});

const formatDate = (dateString) => {
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString('en-US', options);
};

const selectEvent = (event) => {
    // Redirect to scanning page with event ID
    router.visit(`/verify-ticket/${event.id}`);
};
</script>

<template>
    <MainLayout>
        <template #header>
            <h1 class="text-2xl font-bold text-gray-800">Select Event to Scan Tickets</h1>
        </template>
        <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <!-- <div class="text-center mb-12">
                    <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Select Event to Scan Tickets
                    </h1>
                    <p class="mt-3 text-xl text-gray-500">
                        Choose which event you're verifying tickets for
                    </p>
                </div> -->

                <!-- Events Grid -->
                <div v-if="events.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="event in events" :key="event.id" @click="selectEvent(event)"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer group">
                        <!-- Event Image -->
                        <div class="h-48 bg-gray-200 overflow-hidden">

                            <img v-if="event.image_path" :src="'/storage/' + event.image_path" :alt="event.name"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div v-else
                                class="w-full h-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600">
                                <span class="text-white text-2xl font-bold">{{ event.name.charAt(0) }}</span>
                            </div>
                        </div>

                        <!-- Event Content -->
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ event.name }}</h2>
                                <span
                                    class="flex-shrink-0 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ event.ticket_capacity }} tickets
                                </span>
                            </div>

                            <p class="text-gray-600 line-clamp-2 mb-4 truncate">{{ event.description }}</p>

                            <div class="flex items-center text-gray-500 mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ formatDate(event.date_time) }}</span>
                            </div>

                            <div class="flex items-center text-gray-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ event.venue }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No events found</h3>
                    <p class="mt-1 text-sm text-gray-500">Create your first event to start selling tickets.</p>
                    <div class="mt-6">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            New Event
                        </a>
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
