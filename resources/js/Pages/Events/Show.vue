<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import EditForm from './Partials/EditForm.vue';

const props = defineProps({
    event: Object
});

const isEditing = ref(false)

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

const isUpcoming = computed(() => {
    return new Date(props.event.date_time) > new Date();
});

const formattedDate = computed(() => {
    const date = new Date(props.event.date_time);
    return {
        day: date.toLocaleDateString('en-US', { day: 'numeric' }),
        month: date.toLocaleDateString('en-US', { month: 'short' }),
        time: date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }),
        year: date.toLocaleDateString('en-US', { year: 'numeric' })
    };
});

const deleteEvent = () => {
    if (confirm('Are you sure you want to delete this event?')) {
        router.delete(route('events.destroy', props.event.id));
    }
};

const editEvent = () => {
    isEditing.value = true;
    // router.get(route('events.edit', props.event.id));
};
</script>

<template>
    <MainLayout>
        <iframe id="pdf-iframe" style="display: none;" @load="triggerPrint"></iframe>

        <!-- Edit Form -->

        <div v-if="isEditing" @click.self="isEditing = false"
            class="bg-black bg-opacity-50 inset-0 z-40 w-screen h-screen fixed flex justify-center items center py-10">
            <EditForm :event="event" @closeEdit="isEditing = false" />
        </div>



        <!-- Hero section with full-width image and gradient overlay -->
        <div class="relative w-full">
            <div class="w-full h-96 overflow-hidden relative">
                <div v-if="event.image_path" class="absolute inset-0">
                    <img :src="'/storage/' + event.image_path" :alt="event.name"
                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90">
                    </div>
                </div>
                <div v-else class="absolute inset-0 bg-gradient-to-r from-purple-900 to-blue-900"></div>

                <!-- Event title overlay -->
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <div class="flex items-center">
                        <div class="mr-6">
                            <div class="bg-white/10 backdrop-blur-md p-3 rounded-lg text-center border border-white/20">
                                <span class="text-3xl font-bold text-white">{{ formattedDate.day }}</span>
                                <p class="text-sm uppercase tracking-wider text-white/90">{{ formattedDate.month }}</p>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg mb-2">{{ event.name }}
                            </h1>
                            <div class="flex items-center gap-3">
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ formattedDate.time }}
                                </span>
                                <span class="bg-white/20 px-3 py-1 rounded-full text-sm text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ event.venue }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium flex items-center"
                                    :class="isUpcoming ? 'bg-green-500/90 text-white' : 'bg-gray-500/90 text-white'">
                                    {{ isUpcoming ? 'Upcoming' : 'Past' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-5">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden backdrop-blur-lg border border-gray-100 dark:border-gray-700">
                <!-- Details -->
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left column - Description -->
                        <div class="lg:col-span-2">
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">About This Event</h2>
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6">{{ event.description }}</p>

                            <!-- Additional details can go here -->
                            <div
                                class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 border border-gray-100 dark:border-gray-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <p class="mb-2">Join us for an unforgettable night of music and entertainment.</p>
                                    <p>Doors open one hour before the show. Valid ID required for entry.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right column - Event Details -->
                        <div
                            class="bg-gray-50 dark:bg-gray-700/30 rounded-lg p-6 border border-gray-100 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Event Information</h3>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Date & Time</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{
                                            formatDate(event.date_time) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Venue</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ event.venue }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Ticket Capacity
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ event.ticket_capacity }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="mt-8 flex flex-col gap-3">
                                <button @click="router.get(route('tickets', event.id))"
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center pulse ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    View Tickets
                                </button>
                                <div class="flex gap-3">
                                    <button @click="editEvent"
                                        class="flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button @click="deleteEvent"
                                        class="flex-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 py-2 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style>
/* Optional: Additional animations and transitions */
@keyframes pulse {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0.8;
    }
}

.pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
