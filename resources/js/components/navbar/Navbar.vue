<script setup lang="ts">
import Logo from '@/components/AppLogo.vue'
import NavMenu from '@/components/navbar/NavMenu.vue'
import NavigationSheet from '@/components/navbar/NavigationSheet.vue'
import ThemeDropdown from '@/components/ThemeDropdown.vue'

import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip'
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu'
import { Button } from '@/components/ui/button'
import Github from '@/components/Github.vue'
import Linkedin from '@/components/Linkedin.vue'
import { Languages, Check } from 'lucide-vue-next'
import Brazil from '@/components/Brazil.vue'
import USA from '@/components/USA.vue'

</script>

<template>
    <nav
        class="fixed z-10 top-6 inset-x-4 h-16 xs:h-20 bg-background/60 backdrop-blur-sm border dark:border-slate-500/40 max-w-screen-xl mx-auto rounded-full">
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
                    <TooltipProvider>
                        <div class="flex items-center gap-2">
                            <!-- GitHub -->
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button as-child variant="outline" size="icon"
                                        class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                                        aria-label="GitHub">
                                        <a href="https://github.com/leonardoaugustus" target="_blank"
                                            rel="noopener noreferrer">
                                            <Github class="size-5" />
                                        </a>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>GitHub</TooltipContent>
                            </Tooltip>

                            <!-- LinkedIn -->
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button as-child variant="outline" size="icon"
                                        class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                                        aria-label="LinkedIn">
                                        <a href="https://www.linkedin.com/in/leonardo-augustus/" target="_blank"
                                            rel="noopener noreferrer">
                                            <Linkedin class="size-5" />
                                        </a>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>LinkedIn</TooltipContent>
                            </Tooltip>
                        </div>
                    </TooltipProvider>

                    <!-- Dropdown de Tema -->
                    <ThemeDropdown />
                </div>

                <!-- Dropdown de Idioma (sempre visível, inclusive no mobile) -->
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button type="button" variant="outline" size="icon"
                            class="rounded-full h-11 w-11 transition-transform hover:scale-105" aria-label="Language">
                            <!-- Bandeira do Brasil (ícone do botão) -->
                            <Brazil />
                        </Button>
                    </DropdownMenuTrigger>

                    <DropdownMenuContent align="end" class="w-48">
                        <DropdownMenuLabel>Language</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <!-- Padrão Brasil “selecionado” visualmente -->
                        <DropdownMenuItem class="flex items-center gap-2 cursor-default">
                            <Brazil />
                            <span class="flex-1">Português (PT)</span>
                            <Check class="size-4 opacity-100" />
                        </DropdownMenuItem>

                        <DropdownMenuItem class="flex items-center gap-2 cursor-default">
                            <!-- Bandeira dos EUA -->
                            <USA />
                            <span class="flex-1">English (EN)</span>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>

                <!-- Mobile: botão que abre o menu lateral -->
                <div class="md:hidden">
                    <NavigationSheet />
                </div>
            </div>
        </div>
    </nav>
</template>