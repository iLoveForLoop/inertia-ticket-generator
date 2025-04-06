<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    event: Object
});


const formatDateTime = (dateString) => {
    if (!dateString) return '';


    const date = new Date(dateString);
    const offset = date.getTimezoneOffset() * 60000; // Offset in milliseconds
    const localDate = new Date(date - offset).toISOString().slice(0, 16); // Extract YYYY-MM-DDTHH:MM

    return localDate;
};


const form = useForm({
    image: null,
    name: props.event.name,
    description: props.event.description,
    date_time: formatDateTime(props.event.date_time), // Ensure correct format
    venue: props.event.venue,
    ticket_capacity: props.event.ticket_capacity,
    _method: "PUT",

});


const handleImageChange = (e) => {
    form.image = e.target.files[0];
};

const submit = () => {
    console.log(form.image)

    console.log("Submitting Form Data:", form); // Debugging log
    form.post(route('events.update', props.event.id), {
        forceFormData: true,
        onSuccess: () => console.log("Updated successfully"),
        onError: (errors) => console.log(errors) // Logs validation errors
    });
};

</script>




<template>
    <MainLayout>
        <div class="max-w-3xl mx-auto bg-white shadow-sm rounded-lg overflow-hidden">
            <form @submit.prevent="submit" class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input v-model="form.name" type="text" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea v-model="form.description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
                        <input v-model="form.date_time" type="datetime-local" id="date_time"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p v-if="form.errors.date_time" class="mt-2 text-sm text-red-600">{{ form.errors.date_time }}
                        </p>
                    </div>

                    <div>
                        <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
                        <input v-model="form.venue" type="text" id="venue"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p v-if="form.errors.venue" class="mt-2 text-sm text-red-600">{{ form.errors.venue }}</p>
                    </div>

                    <div>
                        <label for="ticket_capacity" class="block text-sm font-medium text-gray-700">Ticket
                            Capacity</label>
                        <input v-model="form.ticket_capacity" type="number" id="ticket_capacity" min="1"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p v-if="form.errors.ticket_capacity" class="mt-2 text-sm text-red-600">{{
                            form.errors.ticket_capacity }}</p>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Event Image</label>
                        <div v-if="event.image_path" class="mt-2">
                            <img :src="'/storage/' + event.image_path" :alt="event.name" class="h-32 w-auto rounded-md">
                        </div>
                        <input @change="handleImageChange" type="file" id="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p v-if="form.errors.image" class="mt-2 text-sm text-red-600">{{ form.errors.image }}</p>


                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <Link :href="route('events.show', event.id)"
                        class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                    </Link>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :disabled="form.processing">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>

</template>
