<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import Logo from '@/components/AppLogo.vue'
import NavMenu from '@/components/navbar/NavMenu.vue'
import NavigationSheet from '@/components/navbar/NavigationSheet.vue'
import ThemeDropdown from '@/components/ThemeDropdown.vue'
</script>

<template>
    <nav
        class="fixed z-10 top-6 inset-x-4 h-16 xs:h-20 bg-background/60 backdrop-blur-sm border dark:border-slate-500/40 max-w-screen-xl mx-auto rounded-full">
        <div class="h-full flex items-center justify-between mx-auto px-6">
            <!-- Esquerda: Logo + Nome -->
            <div class="flex items-center gap-6 w-full">
                <div class="flex items-center gap-2">
                    <Logo />
                    <!-- <span class="font-semibold text-lg whitespace-nowrap">Leonardo Augusto</span> -->
                    <span class="league-script-regular text-2xl whitespace-nowrap ms-2">
                        Leonardo Augusto
                    </span>
                </div>

                <!-- Menu principal: só no desktop -->
                <NavMenu class="hidden md:block" />
            </div>

            <!-- Direita -->
            <div class="flex items-center gap-3">
                <!-- Ações (LinkedIn, GitHub, Tema): só no desktop -->
                <div class="hidden md:flex items-center gap-3">
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/in/leonardo-augustus/" target="_blank" rel="noopener noreferrer"
                        class="inline-flex rounded-full border h-11 w-11 items-center justify-center shadow-none"
                        aria-label="LinkedIn">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm6 0h3.8v1.71h.05c.53-.95 1.84-1.96 3.79-1.96 4.05 0 4.8 2.66 4.8 6.12V21h-4v-5.33c0-1.27-.02-2.9-1.77-2.9-1.78 0-2.05 1.38-2.05 2.8V21H9V9Z" />
                        </svg>
                    </a>

                    <!-- GitHub -->
                    <a href="https://github.com/leonardoaugustus" target="_blank" rel="noopener noreferrer"
                        class="inline-flex rounded-full border h-11 w-11 items-center justify-center shadow-none"
                        aria-label="GitHub">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M12 .5A12 12 0 0 0 8.21 23.9c.6.11.82-.26.82-.58v-2.02c-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.35-1.76-1.35-1.76-1.1-.75.08-.74.08-.74 1.22.09 1.86 1.25 1.86 1.25 1.08 1.85 2.84 1.32 3.53 1.01.11-.78.42-1.32.76-1.62-2.67-.3-5.47-1.33-5.47-5.91 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.52.12-3.17 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 6.01 0c2.29-1.55 3.3-1.23 3.3-1.23.66 1.65.24 2.87.12 3.17.77.84 1.24 1.91 1.24 3.22 0 4.6-2.8 5.61-5.48 5.91.43.37.81 1.1.81 2.22v3.29c0 .32.21.7.82.58A12 12 0 0 0 12 .5Z" />
                        </svg>
                    </a>

                    <!-- Dropdown de Tema -->
                    <ThemeDropdown />
                </div>

                <!-- Mobile: botão que abre o menu lateral -->
                <div class="md:hidden">
                    <NavigationSheet />
                </div>
            </div>
        </div>
    </nav>
</template>
