<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import StatCard from '@/Components/StatCard.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';
import EmptyState from '@/Components/Dashboard/EmptyState.vue';
import EventCard from '@/Components/Dashboard/EventCard.vue';
import RecentActivity from '@/Components/Dashboard/RecentActivity.vue';


const props = defineProps({
    events: Object,
    stats: Object
});

const greeting = computed(() => {
    const now = new Date();
    const hour = now.getHours();

    if (hour >= 5 && hour < 12) {
        return 'Good Morning';
    } else if (hour >= 12 && hour < 18) {
        return 'Good Afternoon';
    } else {
        return 'Good Evening';
    }
});
</script>

<template>
    <MainLayout>
        <template #header>
            <h1 class=" md:text-2xl font-bold text-slate-700">{{ greeting }}, {{ $page.props.auth.user.name }}
            </h1>
        </template>


        <div class="min-h-screen p-6  md:p-0">

            <div class="mb-6">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <StatCard title="Total Events" :value="stats.total_events" icon="calendar" color="blue" />
                    <StatCard title="Upcoming Events" :value="stats.upcoming_events" icon="clock" color="green" />
                    <StatCard title="Total Tickets" :value="stats.total_tickets" icon="ticket" color="purple" />
                    <StatCard title="Scanned Tickets" :value="stats.scanned_tickets" icon="check-circle"
                        color="indigo" />
                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2">


                    <div v-if="!events.data || events.data.length === 0" class=" rounded-lg overflow-hidden">
                        <EmptyState />
                    </div>


                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <EventCard :events="events" />
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <RecentActivity :stats="stats" />

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
