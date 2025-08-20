<script setup lang="ts">
import { onMounted } from 'vue'
import { useAppearance } from '@/composables/useAppearance'
import { Moon, Sun } from 'lucide-vue-next'
import { TooltipProvider, Tooltip, TooltipTrigger, TooltipContent } from '@/components/ui/tooltip'
import { Button } from '@/components/ui/button'

const { appearance, updateAppearance } = useAppearance()

onMounted(() => {
    if (appearance.value !== 'light' && appearance.value !== 'dark') {
        const mm = window.matchMedia('(prefers-color-scheme: dark)')
        updateAppearance(mm.matches ? 'dark' : 'light')
    }
})
function toggleTheme() {
    updateAppearance(appearance.value === 'dark' ? 'light' : 'dark')
}
</script>

<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <Button variant="outline" size="icon"
                    class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                    :aria-label="appearance === 'dark' ? 'Ativar tema claro' : 'Ativar tema escuro'"
                    @click="toggleTheme">
                    <component :is="appearance === 'dark' ? Sun : Moon" class="h-5 w-5" />
                </Button>
            </TooltipTrigger>
            <TooltipContent>
                {{ appearance === 'dark' ? 'Tema claro' : 'Tema escuro' }}
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
