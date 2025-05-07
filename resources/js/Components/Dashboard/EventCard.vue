<template>
    <div v-for="event in events.data" :key="event.id"
        class="bg-white shadow-2xl rounded-lg overflow-hidden transition-all duration-200 hover:shadow-3xl flex flex-col">
        <!-- Event Image (top portion) -->
        <div class="relative h-48 w-full bg-gray-100">
            <img v-if="event.image_path" :src="'/storage/' + event.image_path" :alt="event.name"
                class="h-full w-full object-cover">
            <div v-else
                class="h-full w-full flex items-center justify-center bg-gradient-to-r from-purple-300 to-slate-600">
                <span class="text-white text-4xl font-bold opacity-70">{{ event.name.charAt(0)
                }}</span>
            </div>
            <!-- Status badge -->
            <span class="absolute top-3 right-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                :class="{
                    'bg-green-100 text-green-800': new Date(event.date_time) > new Date(),
                    'bg-gray-100 text-gray-800': new Date(event.date_time) <= new Date()
                }">
                {{ new Date(event.date_time) > new Date() ? 'Upcoming' : 'Past' }}
            </span>
        </div>

        <!-- Event Details -->
        <div class="p-4 flex-1 flex flex-col bg-slate-100 shadow-lg">
            <div class="mb-2">
                <Link :href="route('events.show', event.id)"
                    class="text-lg font-medium text-blue-600 hover:text-blue-800">
                {{ event.name }}
                </Link>
            </div>

            <p class="text-sm text-gray-600 line-clamp-2 mb-3 flex-grow truncate">{{
                event.description }}
            </p>

            <div class="space-y-2 mt-auto">
                <div class="flex items-center text-xs text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ formatDate(event.date_time) }}
                </div>
                <div class="flex items-center text-xs text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
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
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    events: {
        type: Object
    }
})

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
</script>

<style></style>
