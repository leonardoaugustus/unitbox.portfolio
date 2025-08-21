<!-- resources/js/components/Hero.vue -->
<script setup lang="ts">
import { onMounted } from 'vue'
import { useI18n } from '@/composables/useI18n'

// shadcn-vue
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"

// ícones (lucide-vue-next)
import { Terminal, Calendar, Code, Workflow, CircleArrowDown } from "lucide-vue-next"

// (opcional) ícone/btn WhatsApp se quiser usar depois
// import Whatsapp from "@/components/Whatsapp.vue"

const { t, load } = useI18n()

// carrega traduções do locale atual (definido na sessão pelo backend)
onMounted(() => {
    load() // ou load('pt_BR') / load('en') para forçar
})
</script>

<template>
    <section id="hero" class="relative min-h-screen px-6 pt-6 overflow-hidden text-center mt-9">
        <!-- Badges do topo -->
        <div class="flex flex-wrap items-center justify-center gap-2">
            <Badge class="rounded-lg mx-2 px-3">
                <Calendar class="me-2 text-lg" :size="20" />
                9 years of experience
            </Badge>

            <Badge class="rounded-md mx-2 gap-2">
                <Code />
                Laravel * Vue JS * Inertia
            </Badge>

            <Badge class="rounded-md mx-2 gap-2">
                <Workflow />
                Python Automation
            </Badge>

            <Badge class="rounded-md mx-2 gap-2">
                <Terminal class="h-4 w-4" />
                IA Automation
            </Badge>
        </div>

        <!-- Título traduzido -->
        <h1 class="mt-6 text-4xl sm:text-5xl md:text-6xl font-bold !leading-[1.2] tracking-tight">
            {{ t('hero.title') }}
        </h1>

        <!-- Descrição traduzida -->
        <p class="mt-6 text-[17px] md:text-lg max-w-3xl mx-auto">
            {{ t('hero.description') }}
        </p>

        <!-- Ações -->
        <div class="mt-12 flex items-center justify-center gap-4">
            <Button class="rounded-full p-6 text-md px-9 [&_svg]:!w-5 [&_svg]:!h-5">
                <span class="mx-2">O que eu faço</span>
                <CircleArrowDown class="ml-0" />
            </Button>

            <!-- Exemplo de botão WhatsApp (opcional)
      <Button class="rounded-full p-6 text-md px-9 [&_svg]:!w-5 [&_svg]:!h-5 bg-[#25D366] hover:bg-[#1ebe5d] text-white">
        <span class="mx-2">Contato</span>
        <Whatsapp class="ml-0" />
      </Button>
      -->
        </div>
    </section>
</template>