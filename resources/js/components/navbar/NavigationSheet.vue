<script setup lang="ts">
import { ref } from 'vue'
import Logo from '@/components/AppLogo.vue'
import NavMenu from '@/components/navbar/NavMenu.vue'
    
const open = ref(false)
</script>

<template>
    <div>
        <button @click="open = true" class="rounded-full border px-3 h-10 inline-flex items-center justify-center"
            aria-label="Open menu">
            <!-- lucide Menu icon (simplificado) -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <!-- Sheet -->
        <transition name="fade">
            <div v-if="open" class="fixed inset-0 z-50" @keydown.esc="open = false" role="dialog" aria-modal="true">
                <div class="absolute inset-0 bg-black/30" @click="open = false"></div>
                <aside class="absolute right-0 top-0 h-full w-80 bg-background shadow-xl p-6 pt-3">
                    <div class="flex items-center justify-between">
                        <Logo />
                        <button class="p-2 rounded-md hover:bg-muted" @click="open = false" aria-label="Close menu">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                    <NavMenu orientation="vertical" class="mt-12" />
                </aside>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .15s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
