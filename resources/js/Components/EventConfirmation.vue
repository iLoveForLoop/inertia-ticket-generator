<script setup>
const emit = defineEmits(['review', 'confirm'])
</script>

<template>

    <div class="bg-indigo-50 border border-indigo-200 rounded-lg max-w-md shadow-lg overflow-hidden animate-slide-up">
        <div class="p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-indigo-100 p-2 rounded-full">
                    <!-- Warning Icon -->
                    <svg class="text-indigo-600 w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Important Notice</h3>
            </div>

            <div class="mb-5">
                <p class="text-gray-700 mb-3">
                    You're about to create an event and generate tickets. Please be aware:
                </p>
                <p class="bg-indigo-100 p-3 rounded-md text-indigo-800 font-medium text-sm">
                    The number of tickets cannot be edited after creation. Please verify this information carefully.
                </p>
            </div>

            <div class="space-y-3 mt-6">
                <button @click="emit('confirm', 'yes')"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Confirm Creation
                </button>
                <button @click="emit('review')"
                    class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200">
                    Review Details
                </button>
            </div>
        </div>
    </div>
</template>

<style></style>
