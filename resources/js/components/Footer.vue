<script setup lang="ts">
// shadcn-vue
import { Separator } from '@/components/ui/separator'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip'
import Github from '@/components/Github.vue'
import Linkedin from '@/components/Linkedin.vue'

// ícones (lucide-vue-next)
import { Mail, Globe } from 'lucide-vue-next'
</script>

<template>
    <footer class="relative mt-24">
        <!-- topo com separador suave -->
        <Separator class="mb-10 opacity-60" />

        <div class="max-w-screen-xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

                <!-- Coluna 1: Marca e status -->
                <div>
                    <div class="text-2xl font-bold tracking-tight"> <span class="league-script-regular">
                            Leonardo Augusto
                        </span> </div>
                    <p class="mt-2 text-sm text-muted-foreground max-w-[44ch]">
                        Engenheiro de Software & Produto — web moderna, automações e IA, com forte atuação em telecom.
                    </p>

                    <div class="mt-4">
                        <Badge class="rounded-full px-3 py-1">
                            🔔 Disponível para novos projetos
                        </Badge>
                    </div>
                </div>

                <!-- Coluna 2: “Dock” de redes sociais -->
                <div class="flex md:justify-end">

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

                            <!-- E-mail -->
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button as-child variant="outline" size="icon"
                                        class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                                        aria-label="E-mail">
                                        <a href="mailto:leonardo@unitbox.com.br">
                                            <Mail class="size-5" />
                                        </a>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>E-mail</TooltipContent>
                            </Tooltip>

                            <!-- Site/portfolio -->
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button as-child variant="outline" size="icon"
                                        class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                                        aria-label="Portfólio">
                                        <a href="https://leonardoaugusto.dev" target="_blank" rel="noopener noreferrer">
                                            <Globe class="size-5" />
                                        </a>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>Portfólio</TooltipContent>
                            </Tooltip>
                        </div>
                    </TooltipProvider>

                </div>
            </div>

            <!-- linha inferior -->
            <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-3 text-center  pt-6 ">
                <p class="text-xs text-muted-foreground">
                    © {{ new Date().getFullYear() }} Todos os direitos reservados.
                </p>


            </div>
        </div>


    </footer>
</template>
