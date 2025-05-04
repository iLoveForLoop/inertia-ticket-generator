<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    events: {
        type: Array,
        default: () => []
    },
})

const formatDate = (dateString) => {
    if (!dateString) return 'No date set';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

</script>

<template>
    <div v-for="event in events" :key="event.id"
        class="bg-slate-100 rounded-2xl shadow-2xl overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <Link :href="route('events.show', event.id)" class="block h-full">
        <!-- Event Image -->
        <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden relative">
            <img v-if="event.image_path" :src="'/storage/' + event.image_path" :alt="event.name"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
            <div v-else class="h-full flex items-center justify-center">
                <span class="text-white text-4xl font-bold opacity-70">{{ event.name.charAt(0) }}</span>
            </div>
            <!-- Status Badge -->
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold"
                    :class="event.date_time && new Date(event.date_time) > new Date() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                    {{ event.date_time && new Date(event.date_time) > new Date() ? 'Upcoming' : 'Past'
                    }}
                </span>
            </div>
        </div>

        <!-- Event Details -->
        <div class="p-6">
            <div class="flex justify-between items-start">
                <h3 class="text-xl font-bold text-gray-900 truncate">{{ event.name || 'Untitled Event'
                }}</h3>
                <span class="flex-shrink-0 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ event.ticket_capacity || 0 }} tickets
                </span>
            </div>

            <p v-if="event.description" class="mt-2 text-gray-600 line-clamp-2">{{ event.description }}
            </p>

            <div class="mt-4 space-y-3">
                <div class="flex items-start">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 text-gray-700">{{ formatDate(event.date_time) }}</span>
                </div>

                <div class="flex items-start">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 text-gray-700">{{ event.venue || 'No venue specified' }}</span>
                </div>
            </div>
            <!-- Tickets Progress -->
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
        </Link>
    </div>
</template>

<style></style>
