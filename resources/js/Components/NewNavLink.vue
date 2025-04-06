<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link :href="href" :class="[
        active
            ? 'bg-indigo-50 text-indigo-700'
            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
        'group flex items-center px-3 py-2 text-sm font-medium rounded-md'
    ]">
    <span :class="[
        active ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500',
        'flex-shrink-0 h-6 w-6 mr-3'
    ]" aria-hidden="true">
        <slot name="icon" />
    </span>
    <span class="flex-1">
        <slot />
    </span>
    </Link>
</template>
