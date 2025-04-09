<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
defineProps({
    events: {
        type: Array,
        default: []
    }
})
</script>

<template>
    <MainLayout>
        <h1>Ticket Events page</h1>
    </MainLayout>

</template>

<style></style>
