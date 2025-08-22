<!-- resources/js/components/Hero.vue -->
<script setup lang="ts">
import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue'
import { useI18n } from '@/composables/useI18n'

// shadcn-vue
import { Button } from "@/components/ui/button"

// ícones
import { Terminal, CircleArrowDown } from "lucide-vue-next"

const { t } = useI18n()

// título traduzido
const fullTitle = computed(() => String(t('hero.title') ?? ''))

type Tok = { text: string; isSpace: boolean; wordIndex: number | null }

// quebra em tokens preservando espaços
const tokens = computed<Tok[]>(() => {
    const raw = fullTitle.value.match(/\S+|\s+/g) ?? []
    let w = 0
    return raw.map((txt) => {
        const space = /^\s+$/.test(txt)
        return {
            text: txt,
            isSpace: space,
            wordIndex: space ? null : w++,
        }
    })
})

const totalWords = computed(() =>
    tokens.value.reduce((acc, t) => acc + (t.isSpace ? 0 : 1), 0)
)

// estado do typing
const shownCount = ref(0)

// loop suave com rAF
let rafId: number | null = null
let last = 0
let acc = 0
const BASE_INTERVAL = 110 // ms por palavra (ajuste fino)
const JITTER = 60         // variação leve

function nextTargetInterval() {
    // gera intervalo alvo com leve aleatoriedade
    const delta = (Math.random() - 0.5) * JITTER
    return Math.max(60, BASE_INTERVAL + delta)
}
let targetInterval = nextTargetInterval()

function tick(ts: number) {
    if (!last) last = ts
    const dt = ts - last
    last = ts
    acc += dt

    // revela a próxima palavra quando passar o “intervalo alvo”
    if (acc >= targetInterval && shownCount.value < totalWords.value) {
        shownCount.value++
        acc = 0
        targetInterval = nextTargetInterval()
    }

    if (shownCount.value < totalWords.value) {
        rafId = requestAnimationFrame(tick)
    } else {
        rafId = null
    }
}

function startTyping() {
    stopTyping()
    shownCount.value = 0
    last = 0
    acc = 0
    targetInterval = nextTargetInterval()
    if (totalWords.value) {
        rafId = requestAnimationFrame(tick)
    }
}

function stopTyping() {
    if (rafId != null) {
        cancelAnimationFrame(rafId)
        rafId = null
    }
}

// recomputa ao trocar idioma/título
watch(fullTitle, () => startTyping(), { immediate: true })
onMounted(() => startTyping())
onBeforeUnmount(() => stopTyping())

// tokens visíveis
const visibleTokens = computed(() =>
    tokens.value.filter(t => t.isSpace || (t.wordIndex !== null && t.wordIndex < shownCount.value))
)
</script>

<template>
    <section id="hero" class="relative min-h-screen px-6 pt-6 overflow-hidden text-center mt-5">
        <!-- Linha “terminal” fixa acima do título -->
        <div class="mx-auto inline-flex items-center gap-2 rounded-md border px-3 py-1.5 text-sm font-mono bg-background/70 backdrop-blur border-muted-foreground/30 text-foreground/100 shadow-xs"
            aria-label="Terminal prompt">
            <Terminal class="size-4 opacity-80" />
            <span class="opacity-90">{{ t('hero.subtitle') }}</span>
            <span class="terminal-cursor" aria-hidden="true" />
        </div>

        <!-- Título com animação palavra-por-palavra -->
        <h1 class="mt-6 text-4xl sm:text-5xl md:text-6xl font-bold !leading-[1.2] tracking-tight" aria-live="polite"
            role="status">
            <TransitionGroup name="word" tag="span" class="inline will-change-auto">
                <span v-for="(tok, i) in visibleTokens" :key="i"
                    :class="tok.isSpace ? '' : 'inline-block align-baseline will-change-transform'">
                    {{ tok.text }}
                </span>
            </TransitionGroup>
        </h1>

        <!-- Descrição -->
        <p class="mt-6 text-[19px]  max-w-3xl mx-auto text-foreground/100 font-sans">
            {{ t('hero.description') }}
        </p>

        <!-- Ações -->
        <div class="mt-12 flex items-center justify-center gap-4">
            <Button class="rounded-full p-6 text-md px-9 [&_svg]:!w-5 [&_svg]:!h-5">
                <span class="mx-2">{{ t('hero.button') }}</span>
                <CircleArrowDown class="ml-0" />
            </Button>
        </div>
    </section>
</template>

<style scoped>
/* Cursor do “terminal” */
.terminal-cursor {
    display: inline-block;
    width: 8px;
    height: 1.05em;
    margin-left: 4px;
    background: currentColor;
    opacity: .7;
    animation: blink 1s steps(1, end) infinite;
    vertical-align: -2px;
}

/* Transições das PALAVRAS (enter) — suaves e leves (GPU) */
.word-enter-active {
    transition:
        opacity .36s cubic-bezier(.2, .7, .2, 1),
        transform .36s cubic-bezier(.2, .7, .2, 1);
    will-change: opacity, transform;
}

.word-enter-from {
    opacity: 0;
    transform: translate3d(0, .55em, 0) scale(.985);
}

.word-enter-to {
    opacity: 1;
    transform: translate3d(0, 0, 0) scale(1);
}

/* Reduz movimento quando o usuário prefere menos animação */
@media (prefers-reduced-motion: reduce) {
    .word-enter-active {
        transition: opacity .18s linear !important;
    }

    .word-enter-from {
        opacity: 0;
        transform: none;
    }

    .word-enter-to {
        opacity: 1;
    }
}

@keyframes blink {

    0%,
    50% {
        opacity: 0;
    }

    51%,
    100% {
        opacity: .7;
    }
}
</style>