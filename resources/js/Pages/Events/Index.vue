<script setup>
import { Link, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import Searchbar from '@/Components/Searchbar.vue';
import { onMounted, ref } from 'vue';
import EventCard from '@/Components/EventCard.vue';
import Notification from '@/Components/Notification.vue';
import { useUIStore } from '@/stores/ui';

const useNotif = useUIStore()
const notifData = ref(useNotif.notifInfo)
const isNotifying = ref(false)

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


onMounted(() => {
    if (useNotif.notifInfo.showing) {
        isNotifying.value = useNotif.notifInfo.showing
        setTimeout(() => {
            useNotif.hideNotif()
            isNotifying.value = false
        }, 1000)
    }
})

</script>

<template>
    <transition name="notification">
        <Notification v-if="isNotifying" :type="notifData.type" :title="notifData.title" :message="notifData.message"
            :duration="1000" />
    </transition>
    <MainLayout>
        <template #header>
            <div class="w-full flex items-center justify-between gap-5">
                <h1 class="md:text-2xl font-bold text-slate-700">Events</h1>
                <Searchbar :search="search" @search="handleSearch" />
            </div>


        </template>

        <div class="min-h-screen bg-slate-200 py-8 px-4 sm:px-6 lg:px-8 rounded-lg">
            <div class="max-w-7xl mx-auto">

                <!-- Empty State -->
                <div v-if="events.length === 0" class="bg-slate-200 rounded-2xl overflow-hidden text-center py-16 px-6">
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

                <!-- Events Grid -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <EventCard :events="events" />
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


.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}
</style>
