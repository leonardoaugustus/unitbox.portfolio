<script setup lang="ts">
import { Button } from '@/components/ui/button'

import Logo from '@/components/AppLogo.vue'
import NavMenu from '@/components/navbar/NavMenu.vue'
import NavigationSheet from '@/components/navbar/NavigationSheet.vue'
import ThemeDropdown from '@/components/ThemeDropdown.vue'
import Github from '@/components/Github.vue'
import Linkedin from '@/components/Linkedin.vue'
import LanguageDropdown from '@/components/LanguageDropdown.vue'
</script>

<template>
    <nav
        class="fixed z-10 top-6 inset-x-4 h-16 xs:h-20 bg-background/60 backdrop-blur-sm border dark:border-slate-500/40 max-w-screen-xl mx-auto rounded-xl shadow-2xs">
        <div class="h-full flex items-center justify-between mx-auto px-4">
            <!-- Esquerda: Logo + Nome -->
            <div class="flex items-center gap-6 w-full">
                <div class="flex items-center gap-2">
                    <Logo />
                    <span class="league-script-regular text-2xl whitespace-nowrap ms-0">
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
                    <Button as-child variant="outline" size="icon"
                        class="rounded-full h-11 w-11 transition-transform hover:scale-105" aria-label="GitHub">
                        <a href="https://github.com/leonardoaugustus" target="_blank" rel="noopener noreferrer">
                            <Github class="size-5" />
                        </a>
                    </Button>

                    <Button as-child variant="outline" size="icon"
                        class="rounded-full h-11 w-11 transition-transform hover:scale-105" aria-label="LinkedIn">
                        <a href="https://www.linkedin.com/in/leonardo-augustus/" target="_blank"
                            rel="noopener noreferrer">
                            <Linkedin class="size-5" />
                        </a>
                    </Button>

                    <!-- Dropdown de Tema -->
                    <ThemeDropdown />
                </div>

                <!-- Dropdown de Idioma (sempre visível, inclusive no mobile) -->
                <LanguageDropdown />

                <!-- Mobile: botão que abre o menu lateral -->
                <div class="md:hidden">
                    <NavigationSheet />
                </div>
            </div>
        </div>
    </nav>
</template>