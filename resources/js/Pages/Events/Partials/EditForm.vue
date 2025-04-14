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
    ticket_capacity: props.event.ticket_capacity,
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
            emit('closeEdit');
        }
    });
};
</script>

<template>

    <div class="bg-white rounded-xl shadow-sm w-full max-w-7xl mx-auto overflow-hidden">
        <form @submit.prevent="submit" class="p-8">
            <div class="space-y-6 flex flex-col md:flex-row">
                <!-- Event Name -->

                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Event Name</label>
                        <input v-model="form.name" type="text" class="form-input" placeholder="Enter event title" />
                        <p v-if="form.errors.name" class="form-error">{{ form.errors.name }}</p>
                    </div>

                    <!-- Grid for Venue and Date/Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Venue -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Venue</label>
                            <input v-model="form.venue" type="text" class="form-input"
                                placeholder="Where is the event?" />
                            <p v-if="form.errors.venue" class="form-error">{{ form.errors.venue }}</p>
                        </div>

                        <!-- Date & Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date & Time</label>
                            <FlatPickr v-model="form.date_time" :config="dateTimeConfig" class="form-input" />
                            <p v-if="form.errors.date_time" class="form-error">{{ form.errors.date_time }}</p>
                        </div>
                    </div>

                    <!-- Ticket Capacity -->
                    <div class="w-1/3 min-w-[150px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Capacity</label>
                        <input v-model="form.ticket_capacity" type="number" min="1" class="form-input" />
                        <p v-if="form.errors.ticket_capacity" class="form-error">{{ form.errors.ticket_capacity }}</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea v-model="form.description" rows="4" class="form-input resize-none"
                            placeholder="Tell people about your event..."></textarea>
                        <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
                    </div>
                </div>



                <!-- Image Upload with Safe Container -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Banner</label>
                    <div class="mt-1 flex items-center gap-4">
                        <label class="cursor-pointer">
                            <span
                                class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Select Image
                            </span>
                            <input @change="handleImageChange" type="file" accept="image/*" class="hidden" />
                        </label>
                        <span class="text-sm text-gray-500">JPEG, PNG (Max 5MB)</span>
                    </div>
                    <p v-if="form.errors.image" class="form-error">{{ form.errors.image }}</p>

                    <!-- Safe Image Preview Container -->
                    <div v-if="imagePreview"
                        class="mt-4 w-full overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                        <img :src="imagePreview" alt="Event banner preview"
                            class="w-full h-auto object-contain max-h-64" />
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-6 mt-8 border-t border-gray-200">
                <Link :href="route('events.show', props.event.id)"
                    class="px-4 py-2 text-sm font-medium rounded-md border border-gray-300 shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                ← Cancel
                </Link>
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all"
                    :disabled="form.processing">
                    <span v-if="form.processing">Updating...</span>
                    <span v-else>💾 Update Event</span>
                </button>
            </div>
        </form>
    </div>






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
</style>
