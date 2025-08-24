<script setup lang="ts">
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu'
import { Button } from '@/components/ui/button'
import Brazil from '@/components/Brazil.vue'
import USA from '@/components/USA.vue'
import { Check } from 'lucide-vue-next'

import { useI18n } from '@/composables/useI18n'
const { locale, load, t } = useI18n()

async function switchLanguage(l: 'en' | 'pt_BR') {
    try {
        await fetch(`/language/${l}`, { credentials: 'same-origin' })
        await load(l)
    } catch (e) {
        console.error('Falha ao trocar idioma:', e)
    }
}
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button type="button" variant="outline" size="icon"
                class="rounded-full h-11 w-11 transition-transform hover:scale-105" aria-label="Language">
                <component :is="locale === 'pt_BR' ? Brazil : USA" />
            </Button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="end" class="w-48">
            <DropdownMenuLabel>
                {{ t('navbar.language') }}
            </DropdownMenuLabel>
            <DropdownMenuSeparator />

            <DropdownMenuItem class="flex items-center gap-2" :data-state="locale === 'pt_BR' ? 'checked' : 'unchecked'"
                @click="switchLanguage('pt_BR')">
                <Brazil />
                <span class="flex-1">Português (PT)</span>
                <Check v-if="locale === 'pt_BR'" class="size-4 opacity-100" />
            </DropdownMenuItem>

            <DropdownMenuItem class="flex items-center gap-2" :data-state="locale === 'en' ? 'checked' : 'unchecked'"
                @click="switchLanguage('en')">
                <USA />
                <span class="flex-1">English (EN)</span>
                <Check v-if="locale === 'en'" class="size-4 opacity-100" />
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>