<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import { useI18n } from '@/composables/useI18n'

defineProps<{
    orientation?: 'horizontal' | 'vertical'
    class?: string
}>()

const baseList =
    'gap-1 space-x-0 data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-start'

// i18n
const { t } = useI18n()

// itens traduzidos (reativos ao locale)
const items = computed(() => [
    { id: 'about', label: t<string>('navbar.about', 'About') },
    { id: 'experience', label: t<string>('navbar.experience', 'Experience') },
    { id: 'projects', label: t<string>('navbar.projects', 'Projects') },
    { id: 'contact', label: t<string>('navbar.contact', 'Contact') },
])

// hash ativo
const active = ref('#about')

function syncFromHash() {
    active.value = window.location.hash || '#about'
}

function onClickAnchor(id: string) {
    active.value = `#${id}` // atualiza imediatamente
    // deixa o navegador cuidar do scroll com o próprio hash
}

onMounted(() => {
    syncFromHash()
    window.addEventListener('hashchange', syncFromHash, { passive: true })
})

onBeforeUnmount(() => {
    window.removeEventListener('hashchange', syncFromHash)
})
</script>

<template>
    <nav :class="['w-full', $props.class]">
        <ul :class="[
            'hidden md:flex w-full items-center gap-3 justify-center',
            baseList,
            $props.orientation === 'vertical'
                ? 'md:flex-col md:items-start md:justify-start'
                : ''
        ]">
            <li v-for="it in items" :key="it.id">
                <a :href="`#${it.id}`" @click="onClickAnchor(it.id)" :class="[
                    'px-3 py-2 rounded-full text-sm font-medium transition-colors',
                    active === `#${it.id}`
                        ? 'bg-primary text-primary-foreground'
                        : 'hover:bg-muted hover:text-foreground'
                ]">
                    {{ it.label }}
                </a>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
html {
    scroll-behavior: smooth;
}
</style>