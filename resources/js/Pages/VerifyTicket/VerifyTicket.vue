<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Scanner from '../Partials/Scanner.vue';

defineProps({
    event: Object
})

</script>

<template>
    <MainLayout>
        <Scanner :event="event" />
    </MainLayout>

</template>


<style></style>
