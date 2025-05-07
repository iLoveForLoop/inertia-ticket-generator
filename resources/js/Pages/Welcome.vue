<script setup>
import { Link, Head } from '@inertiajs/vue3';
import Nav from '@/Components/Welcome/Nav.vue';
import Hero from '@/Components/Welcome/Hero.vue';
import Features from '@/Components/Welcome/Features.vue';
import How from '@/Components/Welcome/How.vue';
import Testimonial from '@/Components/Welcome/Testimonial.vue';
import CTA from '@/Components/Welcome/CTA.vue';
import Footer from '@/Components/Welcome/Footer.vue';
</script>

<template>

    <Head title="Welcome" />
    <div class="min-h-screen bg-white">

        <Nav />


        <Hero />

        <Features />


        <How />


        <Testimonial />

        <CTA />


        <Footer />

    </div>
</template>
