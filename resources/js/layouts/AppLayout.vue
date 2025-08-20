<script setup lang="ts">
import Navbar from '@/components/navbar/Navbar.vue'

</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <Navbar />
        <main class="pt-28 max-w-screen-md mx-auto px-4">
            <slot />
        </main>
    </div>
</template>
