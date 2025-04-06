<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    event: Object
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

const deleteEvent = () => {
    if (confirm('Are you sure you want to delete this event?')) {
        router.delete(route('events.destroy', props.event.id));
    }
};

const editEvent = () => {
    router.get(route('events.edit', props.event.id));
}

const downloadTicket = (ticketId) => {
    window.location.href = route('download', { event: props.event.id, ticket: ticketId });
};

const bulkDownloadTicket = () => {
    window.location.href = route('bulk-download', { event: props.event.id });
};


const isPrinting = ref(false); // Track button click

const printTicket = (ticketId) => {
    const iframe = document.getElementById('pdf-iframe');

    // Set up load handler ONLY when button is clicked
    iframe.onload = () => {
        if (isPrinting.value) { // Only print if button was clicked
            iframe.contentWindow?.print();
            isPrinting.value = false; // Reset
        }
    };

    isPrinting.value = true; // Mark that we want to print
    iframe.src = route('print-ticket', { ticket: ticketId });
};





</script>

<template>
    <MainLayout>
        <iframe id="pdf-iframe" style="display: none;" @load="triggerPrint"></iframe>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div v-if="event.image_path" class="w-full md:w-1/3">
                        <img :src="'/storage/' + event.image_path" :alt="event.name" class="w-full h-auto rounded-lg">
                    </div>
                    <div class="w-full md:w-2/3">
                        <div class="space-y-4">
                            <div class="flex justify-between w-full">

                                <p class="mt-1 text-lg text-gray-900">{{ event.name }}</p>
                                <button class="bg-gray-500 px-4 py-2 rounded-full m-10"
                                    @click="bulkDownloadTicket">Download all tickets</button>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Event Details</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ event.description }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date & Time</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ formatDate(event.date_time) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Venue</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ event.venue }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Ticket Capacity</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ event.ticket_capacity }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <p class="mt-1 text-sm font-medium"
                                        :class="new Date(event.date_time) > new Date() ? 'text-green-600' : 'text-gray-500'">
                                        {{ new Date(event.date_time) > new Date() ? 'Upcoming' : 'Past' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">


                <div class="flex justify-end items-center mb-4 gap-5">
                    <!-- <div>
                        <button @click="generateTickets"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Generate Tickets
                        </button>
                    </div> -->
                    <div>
                        <button @click="deleteEvent"
                            class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                            Delete
                        </button>
                    </div>

                    <div>
                        <button @click="editEvent"
                            class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            Edit
                        </button>
                    </div>
                </div>



                <h3 class="text-lg font-medium text-gray-900 mb-4">Tickets</h3>
                <ul>
                    <li v-for="ticket in event.tickets" :key="ticket.id">
                        <div v-html="ticket.qr_code_svg"></div>

                        <button class="bg-gray-500 px-4 py-2 rounded-full m-10"
                            @click="downloadTicket(ticket.id)">Download</button>

                        <button class="bg-gray-700 px-4 py-2 rounded-full m-10"
                            @click="printTicket(ticket.id)">Print</button>
                    </li>

                </ul>



                <!-- <div v-if="event.tickets" class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="ticket in event.tickets" :key="ticket.id">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-indigo-600 truncate">Ticket #{{ ticket.id }}</p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="ticket.is_scanned ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                                            {{ ticket.is_scanned ? 'Scanned' : 'Not Scanned' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Created: {{ formatDate(ticket.created_at) }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-4">
                                            Download
                                        </button>
                                        <button class="text-indigo-600 hover:text-indigo-900">
                                            View QR
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="" v-else>
                    <h1 class="">No Tickets Generated yet</h1>
                </div> -->
            </div>
        </div>
    </MainLayout>


</template>
