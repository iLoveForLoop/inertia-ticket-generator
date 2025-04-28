<script setup>
import Searchbar from '@/Components/Searchbar.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    events: {
        type: Array,
        required: true,
        default: () => []
    },
    search: {
        type: String
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
    router.visit(`/verify-ticket/${event.id}`);
};

const search = ref(props.search)

const handleSearch = (data) => {
    router.get(route('scan-event'), { search: data },
        { preserveState: true, replace: true })
}
</script>

<template>
    <MainLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <h1 class="md:text-2xl font-bold text-slate-700">Verify Tickets</h1>
                <Searchbar @search="handleSearch" :search="search" />
            </div>
        </template>
        <div class="min-h-screen bg-slate-200 rounded-lg py-8 px-4 sm:px-6 lg:px-8">
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
                </div>

                <!-- Empty State -->
                <div v-else class="bg-slate-200 rounded-2xl overflow-hidden text-center py-16 px-6">
                    <div class="max-w-md mx-auto">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50">
                            <svg class="h-8 w-8 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl text-gray-900">No events found</h2>
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
