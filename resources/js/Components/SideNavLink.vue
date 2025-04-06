<!-- resources/js/Components/NavLink.vue -->
<template>
    <Link :href="href" :class="[
        active
            ? 'bg-indigo-800 text-white'
            : 'text-indigo-100 hover:bg-indigo-600 hover:bg-opacity-75',
        'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200'
    ]">
    <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    href: {
        type: String,

    },
    active: {
        type: Boolean,
        default: false,
    },
})
</script>
