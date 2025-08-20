<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue'
import { Card, CardContent } from '@/components/ui/card'
import Button from './ui/button/Button.vue'

const closed = ref(false)
const minimized = ref(false)
const maximized = ref(false)

// trava/destrava o scroll da página
function setScrollLocked(locked: boolean) {
  if (typeof window === 'undefined') return
  const el = document.documentElement
  el.style.overflow = locked ? 'hidden' : ''
}

// observa mudanças do maximizado p/ travar/destravar o scroll
watch(maximized, (isMax) => {
  setScrollLocked(isMax)
  // ao sair do maximizado, desfaz minimização
  if (!isMax) minimized.value = false
})

// classes de superfície (com ou sem blur)
const surfaceClass = computed(() => {
  // maximizado e NÃO minimizado => SEM blur
  if (maximized.value && !minimized.value) {
    return 'bg-background'
  }
  // estado normal OU maximizado+minimizado => COM blur
  return 'bg-background/60 backdrop-blur supports-[backdrop-filter]:bg-background/50'
})

// classes dinâmicas do Card
const cardClass = computed(() => [
  'pt-0 rounded-xl border shadow-sm overflow-hidden',
  surfaceClass.value,
  'transition-[transform,opacity,height,width,margin] duration-300 ease-out',
  maximized.value ? 'fixed inset-4 z-50 max-w-none mx-0' : 'relative'
])

function onClose() {
  // fecha e limpa estados que afetem o layout
  closed.value = true
  minimized.value = false
  maximized.value = false
  setScrollLocked(false)
}

function onReopen() {
  // reabre já "como se estivesse minimizado"
  closed.value = false
  minimized.value = false
  maximized.value = false
  setScrollLocked(false)
}

function onMinimize() {
  // só permite minimizar quando estiver maximizado
  maximized.value = !maximized.value
}

function onMaximize() {
  maximized.value = !maximized.value
}

// Sair do maximizado com ESC
function onKey(e: KeyboardEvent) {
  if (e.key === 'Escape' && maximized.value) {
    maximized.value = false
  }
}

onMounted(() => window.addEventListener('keydown', onKey))
onBeforeUnmount(() => {
  window.removeEventListener('keydown', onKey)
  setScrollLocked(false)
})
</script>

<template>
  <section id="about" class="relative">
    <div class="max-w-screen-md mx-auto">
      <Card v-if="!closed" :class="cardClass">
        <!-- Barra superior estilo navegador -->
        <div class="flex items-center gap-2 px-4 py-2 border-b bg-muted/40 select-none" @dblclick="onMaximize"
          :title="maximized ? 'Duplo clique para restaurar' : 'Duplo clique para maximizar'">
          <div class="flex items-center gap-2">
            <!-- Fechar -->
            <button
              class="group relative inline-grid place-items-center size-3 rounded-full bg-[#ff5f57] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)]"
              aria-label="Fechar" title="Fechar" @click="onClose">
              <svg class="absolute opacity-0 group-hover:opacity-100 transition-opacity duration-150" width="7"
                height="7" viewBox="0 0 12 12" fill="none">
                <path d="M3 3l6 6M9 3 3 9" stroke="white" stroke-width="1.5" stroke-linecap="round" />
              </svg>
            </button>

            <!-- Minimizar (só habilitado quando maximizado) -->
            <button
              class="group relative inline-grid place-items-center size-3 rounded-full bg-[#febc2e] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)] disabled:opacity-40 disabled:cursor-not-allowed"
              aria-label="Minimizar" title="Minimizar" :disabled="!maximized" @click="onMinimize">
              <svg class="absolute opacity-0 group-hover:opacity-100 transition-opacity duration-150" width="7"
                height="7" viewBox="0 0 12 12" fill="none">
                <path d="M3 6h6" stroke="white" stroke-width="1.5" stroke-linecap="round" />
              </svg>
            </button>

            <!-- Maximizar / Restaurar -->
            <button
              class="group relative inline-grid place-items-center size-3 rounded-full bg-[#28c840] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)]"
              :aria-label="maximized ? 'Restaurar' : 'Maximizar'" :title="maximized ? 'Restaurar' : 'Maximizar'"
              @click="onMaximize">
              <svg class="absolute opacity-0 group-hover:opacity-100 transition-opacity duration-150" width="7"
                height="7" viewBox="0 0 12 12" fill="none">
                <path d="M6 3v6M3 6h6" stroke="white" stroke-width="1.5" stroke-linecap="round" />
              </svg>
            </button>
          </div>

          <div
            class="flex-1 mx-4 px-3 py-1 text-xs text-muted-foreground bg-background/70 rounded-md border border-muted-foreground/20 truncate">
            www.leonardoaugusto.dev/about
          </div>

          <div class="w-4 h-4 rounded-full bg-muted-foreground/40" />
        </div>

        <!-- Conteúdo (esconde quando minimizado) -->
        <CardContent :class="[
          'transition-[opacity,transform,height,margin] duration-300',
          minimized ? 'opacity-0 -translate-y-1 h-0 p-0 m-0 overflow-hidden' : 'opacity-100 translate-y-0 p-6'
        ]">
          <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1 text-center md:text-left">
              <h2 class="text-2xl font-bold mb-4 tracking-tight">
                Passionate about creating impactful web experiences
              </h2>
              <p class="text-muted-foreground mb-4 text-justify">
                Com mais de 5 anos de experiência em desenvolvimento full-stack, sou especialista em construir
                aplicações web escaláveis utilizando tecnologias modernas. Desenvolvedor Sênior de Software e Produto,
                especializado em aplicações web modernas, automação de processos e soluções com Inteligência Artificial.
                Tenho forte atuação em software de telecomunicações e experiência como líder de times de
                desenvolvimento, transformando requisitos complexos em soluções digitais seguras, escaláveis e de fácil
                manutenção.
              </p>
            </div>

            <div class="flex flex-col items-center">
              <div class="w-40 h-40 md:w-52 md:h-52 rounded-lg overflow-hidden bg-accent">
                <img src="https://avatars.githubusercontent.com/u/62160298?v=4" alt="Foto de Leonardo Augusto"
                  class="object-cover w-full h-full border-2 border-muted-foreground" />
              </div>
              <p class="mt-2 text-xs text-muted-foreground select-none">
                Leonardo Augusto.png
              </p>
            </div>
          </div>
        </CardContent>
      </Card>

      <!-- Botão "Reabrir" quando estiver fechado -->
      <Button v-else @click="onReopen" variant="secondary"
        class="fixed rounded-full bottom-4 right-4 z-40 animate-pulse-slow" aria-label="Reabrir janela" title="Reabrir">
        Reabrir janela
      </Button>
    </div>
  </section>

</template>
<style scoped>
@keyframes pulse-slow {

  0%,
  100% {
    opacity: 1;
  }

  50% {
    opacity: 0.6;
  }
}

.animate-pulse-slow {
  animation: pulse-slow 2.5s ease-in-out infinite;
}
</style>
