<script setup lang="ts">
import { onMounted, onBeforeUnmount, reactive, ref } from 'vue'

interface Props {
    width?: number
    height?: number
    x?: number
    y?: number
    strokeDasharray?: string | number
    numSquares?: number
    className?: string
    maxOpacity?: number
    duration?: number // em segundos
}
const props = withDefaults(defineProps<Props>(), {
    width: 40,
    height: 40,
    x: -1,
    y: -1,
    strokeDasharray: 0,
    numSquares: 50,
    maxOpacity: 0.1,
    duration: 3.5,
})

const containerRef = ref<SVGSVGElement | null>(null)
const dims = reactive({ width: 0, height: 0 })

type Sq = { id: number; x: number; y: number; delay: number }
const squares = ref<Sq[]>([])

function gridPos() {
    const cols = Math.max(1, Math.floor(dims.width / props.width))
    const rows = Math.max(1, Math.floor(dims.height / props.height))
    return {
        gx: Math.floor(Math.random() * cols),
        gy: Math.floor(Math.random() * rows),
    }
}

function genSquares() {
    const arr: Sq[] = []
    for (let i = 0; i < props.numSquares!; i++) {
        const { gx, gy } = gridPos()
        arr.push({
            id: i,
            x: gx * props.width + 1,
            y: gy * props.height + 1,
            delay: i * 0.08, // “onda” digital
        })
    }
    squares.value = arr
}

function randomizeSquare(id: number) {
    const s = squares.value.find(sq => sq.id === id)
    if (!s) return
    const { gx, gy } = gridPos()
    s.x = gx * props.width + 1
    s.y = gy * props.height + 1
}

let ro: ResizeObserver | null = null
onMounted(() => {
    ro = new ResizeObserver(entries => {
        for (const e of entries) {
            dims.width = e.contentRect.width
            dims.height = e.contentRect.height
        }
        genSquares()
    })
    if (containerRef.value) ro.observe(containerRef.value)
})
onBeforeUnmount(() => {
    if (ro && containerRef.value) ro.unobserve(containerRef.value)
})
</script>

<template>
    <svg ref="containerRef" aria-hidden="true"
        class="pointer-events-none absolute inset-0 h-full w-full fill-purple-500/20 stroke-purple-400/20"
        :class="props.className">
        <defs>
            <pattern :id="'grid-pattern'" :width="props.width" :height="props.height" patternUnits="userSpaceOnUse"
                :x="props.x" :y="props.y">
                <path :d="`M.5 ${props.height}V.5H${props.width}`" fill="none"
                    :stroke-dasharray="props.strokeDasharray" />
            </pattern>
        </defs>

        <!-- Grid base -->
        <rect width="100%" height="100%" :fill="`url(#grid-pattern)`" />

        <!-- Quadradinhos “digitais” -->
        <svg :x="props.x" :y="props.y" class="overflow-visible">
            <rect v-for="sq in squares" :key="sq.id" :width="props.width - 1" :height="props.height - 1" :x="sq.x"
                :y="sq.y" class="animate-gridpulse" :style="{
                    '--max': props.maxOpacity?.toString() ?? '0.25',
                    '--dur': (props.duration ?? 3.5) + 's',
                    '--delay': sq.delay + 's'
                }" fill="currentColor" stroke-width="0" @animationiteration="randomizeSquare(sq.id)" />
        </svg>
    </svg>
</template>

<style scoped>
@keyframes gridpulse {
    0% {
        opacity: 0
    }

    50% {
        opacity: var(--max)
    }

    100% {
        opacity: 0
    }
}

.animate-gridpulse {
    animation: gridpulse var(--dur) linear var(--delay) infinite alternate;
}
</style>
