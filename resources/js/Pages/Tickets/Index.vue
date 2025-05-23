<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { ref, watch } from 'vue';
import Pagination from '@/Components/Pagination.vue'
import SelectFilter from '@/Components/SelectFilter.vue';
import { router } from '@inertiajs/vue3';
import ExportLoader from '@/Components/Loader/ExportLoader.vue';
import { ArrowLeftIcon } from '@heroicons/vue/20/solid';
import axios from 'axios';


const props = defineProps({
    event: {
        type: Object,

    },
    tickets: {
        type: Object
    },
    filter: {
        type: String
    }
});

const isPrinting = ref(false);
const loadingTime = ref((props.event.ticket_capacity / 100) * 9000)
// console.log(loadingTime.value)
const isBulkDownloading = ref(false);


const printTicket = (ticketId) => {
    const iframe = document.getElementById('pdf-iframe');

    iframe.onload = () => {
        if (isPrinting.value) {
            iframe.contentWindow?.print();
            isPrinting.value = false;
        }
    };

    isPrinting.value = true;
    iframe.src = route('print-ticket', { ticket: ticketId });
};

const downloadTicket = (ticketId) => {
    window.location.href = route('download', { event: props.event.id, ticket: ticketId });
};

const bulkDownloadTicket = async () => {
    isBulkDownloading.value = true

    try {
        const { data } = await axios.get(
            route('bulk-download', { event: props.event.id }),
            { responseType: 'blob' }
        )

        // create a link to download the blob
        const blobUrl = URL.createObjectURL(data)
        const a = document.createElement('a')
        a.href = blobUrl
        a.download = `${props.event.name}-tickets.zip`
        document.body.appendChild(a)
        a.click()
        URL.revokeObjectURL(blobUrl)
    } catch (e) {
        console.error(e)
    } finally {
        isBulkDownloading.value = false
    }
};

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

const filter = ref(props.filter || 'all');

// watch(filter, (newFilter) => {
//     router.get(route('tickets', { event: props.event.id }), { filter: newFilter }, { preserveState: true, preserveScroll: true });
// });

watch(filter, (newFilter) => {
    router.get(route('tickets', { event: props.event.id }), { filter: newFilter }, { preserveState: true, preserveScroll: true });
});

const goBack = () => {
    window.history.back();
}
</script>

<template>
    <!-- <Loader /> -->
    <ExportLoader v-if="isBulkDownloading" />
    <MainLayout>
        <template #header>
            <div class="w-full flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <button @click="goBack"
                        class="hidden md:block md:p-2 md:hover:bg-gray-100 md:rounded-full md:transition-colors">
                        <ArrowLeftIcon class="w-6 h-6 cursor-pointer" />
                    </button>
                    <h1 class="md:text-2xl font-bold text-slate-700">Tickets</h1>
                </div>

                <SelectFilter v-model="filter" label="Filter Tickets" :options="[
                    { label: 'All Tickets', value: 'all' },
                    { label: 'Scanned', value: 'scanned' },
                    { label: 'Not Scanned', value: 'not_scanned' },
                ]" />
            </div>

        </template>
        <iframe id="pdf-iframe" style="display: none;"></iframe>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-3 border-b pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ event.name }}</h1>

                </div>
                <button
                    class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded-md shadow-sm flex items-center"
                    @click="bulkDownloadTicket">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Download All Tickets
                </button>
            </div>

            <div class="bg-white shadow overflow-hidden rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ticket Number
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Scanned At
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="ticket in tickets.data" :key="ticket.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ ticket.ticket_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="ticket.is_scanned ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'">
                                    {{ ticket.is_scanned ? 'Scanned' : 'Not Scanned' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ formatDate(ticket.scanned_at) ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-4"
                                    @click="downloadTicket(ticket.id)">
                                    Download
                                </button>
                                <button class="text-gray-600 hover:text-gray-900" @click="printTicket(ticket.id)">
                                    Print
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty state if no tickets -->
            <div v-if="!tickets.data || tickets.data.length === 0" class="text-center py-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No tickets found</h3>
                <p class="mt-1 text-sm text-gray-500">There are no tickets available for this event yet.</p>
            </div>

            <Pagination :links="tickets.links" :from="tickets.from" :to="tickets.to" :total="tickets.total" />
        </div>
    </MainLayout>
</template>

<style>
/* Add any additional custom styling here */
</style>
