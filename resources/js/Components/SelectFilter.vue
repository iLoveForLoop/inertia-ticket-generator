<template>
    <div class="w-full sm:w-auto flex items-center justify-center gap-2">
        <div>
            <!-- <label v-if="label" class="block text-sm font-medium text-gray-700 mb-1">
                {{ label }}
            </label> -->
        </div>
        <div>
            <select :value="modelValue" @change="$emit('update:modelValue', $event.target.value)"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 text-sm">
                <option v-for="(option, index) in options" :key="index" :value="option.value">
                    {{ option.label }}
                </option>
            </select>
        </div>

    </div>
</template>

<script setup>
defineProps({
    label: {
        type: String,
        default: ''
    },
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: [String, Number],
        default: ''
    }
});

defineEmits(['update:modelValue']);
</script>
