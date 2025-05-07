<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, computed, watch, onMounted } from 'vue';
import EditForm from './Partials/EditForm.vue';
import Confirmation from '@/Components/Confirmation.vue';
import { ArrowLeftIcon } from '@heroicons/vue/20/solid';
import Notification from '@/Components/Notification.vue';
import { useUIStore } from '@/stores/ui';

const props = defineProps({
    event: Object
});

const useNotif = useUIStore()
const notifData = computed(() => useNotif.notifInfo)
const isNotifying = ref(false)


const isEditing = ref(false)
const isConfirming = ref(false)

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
    isConfirming.value = true

};

const editEvent = () => {
    isEditing.value = true;
    // router.get(route('events.edit', props.event.id));
};


const confirmedDeleteEvent = () => {
    router.delete(route('events.destroy', props.event.id));
    useNotif.setNotification({ showing: true, title: 'Delete', type: 'error', message: "Event Deleted" })

}

const goBack = () => {
    window.history.back();
}

const handleCloseEdit = (data) => {
    isEditing.value = false
    console.log('PROPS', data)
    if (data) {
        console.log('Abot')
        console.log('type of: ', useNotif.notifInfo.type)
        isNotifying.value = true
        setTimeout(() => {
            useNotif.hideNotif(false)
            isNotifying.value = false

        }, 1000)
    }
}

// watch(useNotif.notifInfo.showing, (data) => {
//     setTimeout(() => {
//         useNotif.hideNotif()
//     }, 5000)
// })

onMounted(() => {
    if (useNotif.notifInfo.showing) {
        isNotifying.value = useNotif.notifInfo.showing

        setTimeout(() => {
            useNotif.hideNotif(false)
            isNotifying.value = false
            console.log('Im here: ', useNotif.notifInfo.showing)
        }, 1000)
    }
})

</script>

<template>
    <Transition name="notification">
        <Notification v-if="isNotifying" :type="notifData.type" :title="notifData.title" :message="notifData.message"
            :duration="1000" />
    </Transition>

    <!-- Confirmation Modal -->
    <div v-if="isConfirming" @click.self="isConfirming = false"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50">
        <Confirmation @close="isConfirming = false" @confirm="confirmedDeleteEvent()" />
    </div>



    <!-- Edit Modal -->
    <div v-if="isEditing" @click.self="isEditing = false"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-40">
        <EditForm :event="event" @closeEdit="handleCloseEdit" />
    </div>

    <MainLayout>
        <!-- Header -->
        <template #header>
            <button @click="goBack"
                class="hidden md:block md:p-2 md:hover:bg-gray-100 md:rounded-full md:transition-colors">
                <ArrowLeftIcon class="w-6 h-6 cursor-pointer" />
            </button>
        </template>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <!-- Event Header -->
            <div class="flex flex-col md:flex-row md:items-center mb-6 gap-6">
                <!-- Date Badge -->
                <div class="bg-white shadow-md rounded-xl p-4 text-center flex-shrink-0 min-w-20">
                    <span class="text-3xl font-bold text-gray-900">{{ formattedDate.day }}</span>
                    <p class="text-sm uppercase tracking-wider text-gray-500">{{ formattedDate.month }}</p>
                </div>

                <!-- Event Title and Info -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ event.name }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2">
                        <span class="inline-flex items-center text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ formattedDate.time }}
                        </span>
                        <span class="inline-flex items-center text-sm text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ event.venue }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                            :class="isUpcoming ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'">
                            {{ isUpcoming ? 'Upcoming' : 'Past' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Event Image -->
            <div class="w-full rounded-2xl overflow-hidden mb-8 h-64 md:h-80">
                <div v-if="event.image_path" class="h-full w-full">
                    <img :src="'/storage/' + event.image_path" :alt="event.name" class="w-full h-full object-cover">
                </div>
                <div v-else class="h-full w-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - About -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl p-6 shadow-sm h-full">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">About This Event</h2>
                        <p class="text-gray-700 leading-relaxed">{{ event.description }}</p>
                    </div>
                </div>

                <!-- Right Column - Details & Actions -->
                <div class="space-y-6">
                    <!-- Event Details -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Event Details</h3>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1 bg-blue-50 p-2 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Date & Time</p>
                                    <p class="text-sm text-gray-600">{{ formatDate(event.date_time) }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1 bg-blue-50 p-2 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Venue</p>
                                    <p class="text-sm text-gray-600">{{ event.venue }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1 bg-blue-50 p-2 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Ticket Capacity</p>
                                    <p class="text-sm text-gray-600">{{ event.ticket_capacity }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <button @click="router.get(route('tickets', event.id))"
                            class="w-full bg-slate-600 hover:bg-slate-700 text-white font-medium py-3 px-4 rounded-lg mb-3 transition-colors duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            View Tickets
                        </button>

                        <div class="grid grid-cols-2 gap-3">
                            <button @click="editEvent"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button @click="deleteEvent"
                                class="bg-white hover:bg-red-50 text-red-600 py-2 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center border border-gray-200">
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


/* Main form transition */
.form-fade-enter-active,
.form-fade-leave-active {
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.form-fade-enter-from,
.form-fade-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

/* Staggered children transitions */
.staggered-fade-enter-active {
    transition: all 0.4s ease;
    transition-delay: calc(0.15s * var(--i));
}

.staggered-fade-leave-active {
    transition: all 0.2s ease;
}

.staggered-fade-enter-from,
.staggered-fade-leave-to {
    opacity: 0;
    transform: translateY(20px);
}

/* Right column slide-in */
.slide-fade-enter-active {
    transition: all 0.6s ease;
    transition-delay: 0.3s;
}

.slide-fade-leave-active {
    transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

/* Buttons fade-up */
.fade-up-enter-active {
    transition: all 0.5s ease;
    transition-delay: 0.6s;
}

.fade-up-leave-active {
    transition: all 0.3s ease;
}

.fade-up-enter-from,
.fade-up-leave-to {
    opacity: 0;
    transform: translateY(20px);
}
</style>
