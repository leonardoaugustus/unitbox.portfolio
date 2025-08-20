<!-- resources/js/Pages/LandingPage.vue -->
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import Hero from '@/components/Hero.vue';
import AboutMe from '@/components/AboutMe.vue';
import Experience from '@/components/Experience.vue';
import Project from '@/components/Project.vue';
import ContactCompose from '@/components/Contact.vue'
import Footer from '@/components/Footer.vue';
import TopLoader from '@/components/TopLoader.vue'
</script>

<template>
    <AppLayout>

        <TopLoader />

        <Head title="Landing Page" />

        <Hero />

        <AboutMe />

        <Experience />

        <Project />


        <ContactCompose />

        <Footer />

    </AppLayout>
</template>
