<template>
    <div class="rounded-lg overflow-hidden sticky top-6 bg-slate-100 text-gray-50 shadow-2xl z-10">
        <div class="px-6 py-4 ">
            <h2 class="text-lg font-medium text-gray-600">Recent Scans</h2>
        </div>
        <div class="">
            <div v-if="stats.recent_activity.length === 0" class="p-6 text-center text-gray-500">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 mb-4">
                    <svg class="h-6 w-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p>No recent ticket scans</p>
                <p class="mt-1 text-xs">Scan activity will appear here</p>
            </div>
            <div v-for="ticket in stats.recent_activity" :key="ticket.id" class="p-6 md:py-0 md:px-6 ">
                <div class="flex items-start">
                    <div
                        class="flex-shrink-0 h-10 w-10 rounded-full bg-slate-700 flex items-center justify-center text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4 min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-600 truncate">Ticket
                            #{{ ticket.ticket_number }}
                        </p>
                        <p class="text-sm text-gray-500">Scanned at {{ formatDateTime(ticket.scanned_at)
                            }}</p>
                        <div class="mb-3">
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
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    stats: Object
})

const formatDateTime = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<style></style>
