<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import FlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import 'flatpickr/dist/themes/material_blue.css';
import { ref, watch } from 'vue';

const props = defineProps({
    event: Object
});

const emit = defineEmits(['closeEdit']);

const showNotification = ref(false)

const showSuccessNotification = () => {
    showNotification.value = true
    setTimeout(() => {
        showNotification.value = false
    }, 3000)
}

const dateTimeConfig = {
    enableTime: true,
    altInput: true,
    dateFormat: 'Y-m-d H:i',
    altFormat: 'F j, Y - h:i K',
    minDate: 'today'
};

const form = useForm({
    image: null,
    name: props.event.name,
    description: props.event.description,
    date_time: props.event.date_time,
    venue: props.event.venue,
    _method: 'PUT',
});


const imagePreview = ref(props.event.image_path ? `/storage/${props.event.image_path}` : null);

const handleImageChange = (e) => {
    const file = e.target.files[0];
    form.image = file;

    if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imagePreview.value = event.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    form.post(route('events.update', props.event.id), {
        forceFormData: true,
        onFinish: () => {
            showSuccessNotification()
            emit('closeEdit');
        }
    });
};
</script>

<template>


    <form @submit.prevent="submit" class="p-8">

        <div class="bg-white rounded-lg shadow-md p-8 max-w-4xl mx-auto animate-slide-up">
            <h1 class="text-xl mb-5">Edit Event</h1>
            <div class="space-y-8 flex flex-col md:flex-row justify-between gap-8">
                <!-- Left Column: Form Fields -->
                <div class="flex-1 space-y-6">
                    <!-- Event Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Event Name</label>
                        <input v-model="form.name" type="text"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            placeholder="Enter event title" />
                        <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>

                    <!-- Grid for Venue and Date/Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Venue -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Venue</label>
                            <input v-model="form.venue" type="text"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                placeholder="Where is the event?" />
                            <p v-if="form.errors.venue" class="mt-1 text-sm text-red-600">{{ form.errors.venue }}</p>
                        </div>

                        <!-- Date & Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date & Time</label>
                            <FlatPickr v-model="form.date_time" :config="dateTimeConfig"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" />
                            <p v-if="form.errors.date_time" class="mt-1 text-sm text-red-600">{{ form.errors.date_time
                            }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea v-model="form.description" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none"
                            placeholder="Tell people about your event..."></textarea>
                        <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description
                        }}</p>
                    </div>
                </div>

                <!-- Right Column: Image Upload -->
                <div class="md:w-1/3 space-y-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Event Banner</label>

                    <!-- Image Upload Area -->
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition-all">
                        <div v-if="!imagePreview" class="space-y-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-500">JPEG, PNG (Max 5MB)</p>
                        </div>

                        <!-- Image Preview -->
                        <div v-if="imagePreview" class="relative">
                            <img :src="imagePreview" alt="Event banner preview"
                                class="w-full h-auto object-contain max-h-64 rounded-md" />
                            <!-- <button type="button" @click="removeImage"
                                    class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-md hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button> -->
                        </div>

                        <!-- Hidden File Input -->
                        <input @change="handleImageChange" type="file" accept="image/*" id="image-upload"
                            class="hidden" />
                    </div>

                    <!-- Upload Button -->
                    <label for="image-upload" class="mt-4 inline-block cursor-pointer w-full">
                        <span
                            class="flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Select Image
                        </span>
                    </label>
                    <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-8 mt-8 border-t border-gray-200">
                <Link :href="route('events.show', props.event.id)"
                    class="px-5 py-2.5 text-sm font-medium rounded-lg border border-gray-300 shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Cancel
                </Link>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all flex items-center"
                    :disabled="form.processing">
                    <span v-if="form.processing" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Updating...
                    </span>
                    <span v-else class="flex items-center">
                        Update Event
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </form>




    <!-- <Transition name="notification">
        <div v-if="true" class="fixed bottom-4 right-4 bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-lg">
            Form updated successfully!
        </div>
    </Transition> -->


</template>

<style scoped>
.form-input {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm;
}

.form-error {
    @apply mt-1 text-sm text-red-600;
}

.file-input {
    @apply block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100;
}

/* Notification animation */
.notification-enter-active,
.notification-leave-active {
    transition: all 0.3s ease;
}

.notification-enter-from,
.notification-leave-to {
    opacity: 0;
    transform: translateY(30px);
}
</style>
