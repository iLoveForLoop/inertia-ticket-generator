<script setup>
import Loader from '@/Components/Loader/Loader.vue';
import ExportLoader from '@/Components/Loader/ExportLoader.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import FlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import 'flatpickr/dist/themes/material_blue.css';
import { ref } from 'vue';

const form = useForm({
    name: '',
    description: '',
    date_time: '',
    venue: '',
    ticket_capacity: 100,
    image: null,
});

const now = new Date();

const dateTimeConfig = {
    enableTime: true,
    altInput: true,
    dateFormat: 'Y-m-d H:i',
    altFormat: 'F j, Y - h:i K',
    minDate: 'today',
    onOpen: updateMinTime,
    onReady: updateMinTime,
    onChange: updateMinTime

};

function updateMinTime(selectedDates, dateStr, instance) {
    const selectedDate = selectedDates[0] || instance.selectedDates[0];
    const now = new Date();

    if (!selectedDate) return;

    const isToday = selectedDate.toDateString() === now.toDateString();

    if (isToday) {
        const currentHour = now.getHours().toString().padStart(2, '0');
        const currentMinute = now.getMinutes().toString().padStart(2, '0');

        instance.set('minTime', `${currentHour}:${currentMinute}`);
    } else {
        instance.set('minTime', '00:00');
    }
}

const imagePreview = ref(null);

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
    form.post(route('events.store'), {
        forceFormData: true,
    });
};
</script>

<template>
    <MainLayout>
        <template #header>
            <h1 class="text-3xl font-bold text-gray-800">🎟️ Create Event & Generate Tickets</h1>
        </template>

        <Loader v-if="form.processing" />


        <div class="max-w-4xl mx-auto mt-6 bg-white shadow-xl rounded-lg overflow-hidden border">
            <form @submit.prevent="submit" class="p-8 space-y-6">
                <!-- Grid layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Event Name -->
                    <div>
                        <label class="form-label">Event Name</label>
                        <input v-model="form.name" type="text" class="form-input" />
                        <p v-if="form.errors.name" class="form-error">{{ form.errors.name }}</p>
                    </div>

                    <!-- Venue -->
                    <div>
                        <label class="form-label">Venue</label>
                        <input v-model="form.venue" type="text" class="form-input" />
                        <p v-if="form.errors.venue" class="form-error">{{ form.errors.venue }}</p>
                    </div>

                    <!-- Date & Time -->
                    <div>
                        <label class="form-label">Date & Time</label>
                        <FlatPickr v-model="form.date_time" :config="dateTimeConfig" class="form-input" />
                        <p v-if="form.errors.date_time" class="form-error">{{ form.errors.date_time }}</p>
                    </div>

                    <!-- Ticket Capacity -->
                    <div>
                        <label class="form-label">Ticket Capacity</label>
                        <input v-model="form.ticket_capacity" type="number" min="1" class="form-input" />
                        <p v-if="form.errors.ticket_capacity" class="form-error">{{ form.errors.ticket_capacity }}</p>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="form-label">Description</label>
                    <textarea v-model="form.description" rows="4" class="form-input resize-none"
                        placeholder="Event details..."></textarea>
                    <p v-if="form.errors.description" class="form-error">{{ form.errors.description }}</p>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="form-label">Event Banner</label>
                    <input @change="handleImageChange" type="file" accept="image/*" class="file-input" />
                    <p v-if="form.errors.image" class="form-error">{{ form.errors.image }}</p>
                    <div v-if="imagePreview" class="mt-4">
                        <img :src="imagePreview" alt="Preview" class="w-full max-w-md rounded shadow" />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center pt-4 border-t">
                    <Link :href="route('events.index')"
                        class="px-4 py-2 text-sm rounded-md border hover:bg-gray-100 transition-all text-gray-700">
                    ← Cancel
                    </Link>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 transition-all"
                        :disabled="form.processing">
                        ➕ Create Event
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<style scoped>
.form-label {
    @apply block text-sm font-medium text-gray-700 mb-1;
}

.form-input {
    @apply w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500;
}

.file-input {
    @apply block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100;
}

.form-error {
    @apply mt-1 text-sm text-red-600;
}
</style>
