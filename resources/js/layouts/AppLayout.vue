<script setup lang="ts">
import { onMounted } from 'vue'
import { useI18n } from '@/composables/useI18n'
import Navbar from '@/components/navbar/Navbar.vue'

const { load, locale } = useI18n()

onMounted(async () => {
    await load()

    // heurística do navegador (opcional, se quiser manter)
    if (locale.value !== 'pt_BR') {
        const navLang = (navigator.language || navigator.languages?.[0] || 'en').toLowerCase()
        if (navLang.startsWith('pt')) {
            await fetch('/language/pt_BR', { credentials: 'same-origin' })
            await load('pt_BR')
        }
    }
})
</script>

<template>
    <div class="min-h-screen bg-background text-foreground">
        <Navbar />
        <main class="pt-28 max-w-screen-md mx-auto px-4">
            <slot />
        </main>
    </div>
</template>