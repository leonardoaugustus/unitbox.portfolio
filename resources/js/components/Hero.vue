<script setup lang="ts">

import { Badge } from "@/components/ui/badge"
import { Terminal } from "lucide-vue-next"
import { Calendar } from "lucide-vue-next"
import { Code } from "lucide-vue-next"
import { Workflow } from "lucide-vue-next"
import { CircleArrowDown } from 'lucide-vue-next'
import { Button } from "@/components/ui/button"
import Whatsapp from "@/components/Whatsapp.vue"

</script>

<template>
    <div class="relative min-h-screen px-6 pt-6 overflow-hidden text-center mt-9">
        <Badge class="rounded-lg mx-2 px-3">
            <Calendar class="me-2 text-lg" :size="32" />
            9 years of experience
        </Badge>

        <Badge class="rounded-md mx-2">
            <Code class="" />
            Laravel * Vue JS * Inertia
        </Badge>

        <Badge class="rounded-md  mx-2">
            <Workflow class="" />
            Python Automation
        </Badge>

        <Badge class="rounded-md  mx-2">
            <Terminal class="h-4 w-4" />
            IA Automation
        </Badge>


        <h1 class="mt-6 text-4xl sm:text-5xl md:text-6xl font-bold !leading-[1.2] tracking-tight">
            Transformo ideias em produtos digitais confiáveis e escaláveis.
        </h1>

        <p class="mt-6 text-[17px] md:text-lg">Olá, me chamo Leonardo, sou Desenvolvedor Sênior de Software e Produto.
            Atuo em aplicações web modernas, automação de processos e soluções com Inteligência Artificial. Tenho forte
            experiência em software de telecomunicações e liderança de times de desenvolvimento.
        </p>

        <div class="mt-12 flex items-center justify-center gap-4">

            <Button  class="rounded-full p-6 text-md px-9 [&_svg]:!w-5 [&_svg]:!h-5">
                <span class="mx-2">O que eu faço</span>
                <CircleArrowDown class="ml-0" />
            </Button>
            <!-- <Button 
                class="rounded-full p-6 text-md px-9 [&_svg]:!w-5 [&_svg]:!h-5 bg-[#25D366] hover:bg-[#1ebe5d] text-white">
                <span class="mx-2">Contato</span>
                <Whatsapp class="ml-0" />
            </Button> -->

        </div>
    </div>
</template>
