<script setup lang="ts">
import { Separator } from '@/components/ui/separator'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip'
import Github from '@/components/Github.vue'
import Linkedin from '@/components/Linkedin.vue'
import Whatsapp from '@/components/Whatsapp.vue'
import { Mail } from 'lucide-vue-next'
import { useI18n } from '@/composables/useI18n'

const { t } = useI18n()

</script>

<template>
    <footer class="relative mt-24">
        <!-- topo com separador suave -->
        <Separator class="mb-10 opacity-60" />

        <div class="max-w-screen-xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                <div>
                    <div class="text-2xl font-bold tracking-tight"> <span class="league-script-regular">
                            Leonardo Augusto
                        </span> </div>
                    <p class="mt-2 text-sm text-muted-foreground max-w-[44ch]">{{ t('footer.description') }}</p>
                    <div class="mt-4">
                        <Badge class="rounded-full px-3 py-1">
                            🔔 {{ t('footer.tag') }}
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

                            <!-- WhatsApp -->
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button as-child variant="outline" size="icon"
                                        class="rounded-full h-11 w-11 transition-transform hover:scale-105"
                                        aria-label="WhatsApp">
                                        <a href="https://wa.me/5511982226852?text=Olá%20Leonardo,%20gostaria%20de%20saber%20mais%20sobre%20seus%20serviços."
                                            target="_blank" rel="noopener noreferrer">
                                            <Whatsapp class="size-5" />
                                        </a>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent>WhatsApp</TooltipContent>
                            </Tooltip>
                        </div>
                    </TooltipProvider>
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row items-center justify-between gap-3 text-center pt-6 pb-2 ">
                <p class="text-xs text-muted-foreground">{{ t('footer.copyright') }}</p>
            </div>
        </div>
    </footer>
</template>
