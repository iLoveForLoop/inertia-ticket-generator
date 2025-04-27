<template>
    <div v-if="links?.length > 3"
        class="flex flex-col items-center justify-between gap-4 border-t border-gray-200 px-4 py-6 sm:flex-row sm:px-6">
        <!-- Results -->
        <div class="text-sm text-gray-600">
            Showing
            <span class="font-semibold text-gray-800">{{ from }}</span>
            to
            <span class="font-semibold text-gray-800">{{ to }}</span>
            of
            <span class="font-semibold text-gray-800">{{ total }}</span>
            results
        </div>

        <!-- Pagination -->
        <nav class="flex flex-wrap items-center gap-2" aria-label="Pagination">
            <!-- Previous -->
            <component :is="links[0]?.url ? Link : 'span'" :href="links[0]?.url"
                class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium" :class="links[0]?.url
                    ? 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 transition'
                    : 'bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed'">
                &laquo; Previous
            </component>

            <!-- Pages -->
            <template v-for="(link, index) in links.slice(1, links.length - 1)" :key="index">
                <component v-if="link && link.label !== '...'" :is="link.url ? Link : 'span'" :href="link.url"
                    class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium transition" :class="{
                        'bg-blue-100 text-blue-600 font-semibold border border-blue-300': link.active,
                        'bg-white text-gray-600 border border-gray-300 hover:bg-gray-100': !link.active && link.url,
                        'bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed': !link.url
                    }" v-html="link.label" preserve-state />
            </template>

            <!-- Next -->
            <component :is="links[links.length - 1]?.url ? Link : 'span'" :href="links[links.length - 1]?.url"
                class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium" :class="links[links.length - 1]?.url
                    ? 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 transition'
                    : 'bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed'">
                Next &raquo;
            </component>
        </nav>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    links: Array,
    from: Number,
    to: Number,
    total: Number
});

const currentPage = computed(() => {
    const activeLink = props.links?.find(link => link.active);
    return activeLink ? parseInt(activeLink.label) : 1;
});
</script>
