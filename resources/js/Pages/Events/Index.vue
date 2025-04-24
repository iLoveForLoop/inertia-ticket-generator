<script setup>
import { Link, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import Searchbar from '@/Components/Searchbar.vue';
import { ref } from 'vue';

const props = defineProps({
    events: {
        type: Array,
        default: () => []
    },
    search: {
        type: String,
        default: ''
    }
});

// const searchData = ref(props.search)

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


const handleSearch = (data) => {
    console.log(data)
    router.get(
        route('events.index'),
        { search: data },
        { preserveState: true, replace: true })

}

// const handleSearch = (data) => {
//     console.log(data)
//     router.get(
//         route('events.index'),
//         { search: data },
//         { preserveState: true, replace: true }
//     )
// }

</script>

<template>
    <MainLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Events</h1>
                <Searchbar @search="handleSearch" :search="search" />
            </div>

        </template>

        <div class="min-h-screen bg-slate-200 py-8 px-4 sm:px-6 lg:px-8 rounded-lg">
            <div class="max-w-7xl mx-auto">
                <!-- Header Section -->
                <!-- <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Your Events</h1>
                        <p class="mt-2 text-lg text-gray-600">Manage and scan tickets for your upcoming events</p>
                    </div>
                    <Link :href="route('events.create')"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                    <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Event
                    </Link>
                </div> -->

                <!-- Empty State -->
                <div v-if="events.length === 0"
                    class="bg-white rounded-2xl shadow-xl overflow-hidden text-center py-16 px-6">
                    <div class="max-w-md mx-auto">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-purple-100">
                            <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-2xl font-bold text-gray-900">No events yet</h2>
                        <p class="mt-2 text-gray-600">Create your first event to start selling and scanning tickets.</p>
                        <div class="mt-8">
                            <Link :href="route('events.create')"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            New Event
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Events Grid -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                <span
                                    class="flex-shrink-0 bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ event.ticket_capacity || 0 }} tickets
                                </span>
                            </div>

                            <p v-if="event.description" class="mt-2 text-gray-600 line-clamp-2">{{ event.description }}
                            </p>

                            <div class="mt-4 space-y-3">
                                <div class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mt-0.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 text-gray-700">{{ formatDate(event.date_time) }}</span>
                                </div>

                                <div class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mt-0.5"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 text-gray-700">{{ event.venue || 'No venue specified' }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <div
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 group">
                                    <span>Manage event</span>
                                    <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        </Link>
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

/* Smooth transitions for hover effects */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
</style>
