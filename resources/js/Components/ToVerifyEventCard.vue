<script setup>
import { router } from '@inertiajs/vue3';
defineProps({
    events: {
        type: Array,
        required: true,
        default: () => []
    }
})


const selectEvent = (event) => {
    router.visit(`/verify-ticket/${event.id}`);
};

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
</script>

<template>
    <div v-for="event in events" :key="event.id" @click="selectEvent(event)"
        class="bg-white rounded-xl shadow-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer group">
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
            <p class="text-gray-600 line-clamp-2 mb-4 truncate">{{ event.description }} </p>

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

            </div>
        </div>
    </div>
</template>

<style></style>
