<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance'
import {
    DropdownMenu,
    DropdownMenuTrigger,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu'
import { Monitor, Moon, Sun } from 'lucide-vue-next'

const { appearance, updateAppearance } = useAppearance()

const tabs = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const

const current = () => tabs.find(t => t.value === appearance.value) ?? tabs[2] // system
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <button type="button"
                class="rounded-full border h-10 w-10 inline-flex items-center justify-center shadow-none"
                aria-label="Theme">
                <component :is="current().Icon" class="h-5 w-5" />
            </button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="end" class="w-44">
            <DropdownMenuLabel>Theme</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem v-for="{ value, Icon, label } in tabs" :key="value" role="menuitemradio"
                :aria-checked="appearance === value ? 'true' : 'false'"
                :data-checked="appearance === value ? 'true' : 'false'" @click="updateAppearance(value)"
                class="flex items-center gap-2 data-[checked=true]:bg-muted">
                <Icon class="h-4 w-4" />
                <span class="text-sm">{{ label }}</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
