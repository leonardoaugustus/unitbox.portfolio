<script setup lang="ts">
import Autoplay from "embla-carousel-autoplay"
import type { CarouselApi } from "@/components/ui/carousel"
import { watchOnce } from "@vueuse/core"
import { ref, computed } from "vue"
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel"

type ImgItem = string | { src: string; alt?: string }

const props = withDefaults(defineProps<{
    images: ImgItem[]
    heightClass?: string
    rounded?: boolean
    altBase?: string
    eagerFirst?: boolean
    /* autoplay */
    autoplay?: boolean
    autoplayDelay?: number
    stopOnMouseEnter?: boolean
    stopOnInteraction?: boolean
}>(), {
    heightClass: "h-64",
    rounded: true,
    altBase: "Slide",
    eagerFirst: false,
    autoplay: true,
    autoplayDelay: 6000,
    stopOnMouseEnter: true,
    stopOnInteraction: false,
})

const api = ref<CarouselApi>()
const totalCount = ref(0)
const current = ref(0)

/* plugin de autoplay (igual ao exemplo) */
const plugin = Autoplay({
    delay: props.autoplayDelay,
    stopOnMouseEnter: props.stopOnMouseEnter,
    stopOnInteraction: props.stopOnInteraction,
})

function setApi(val: CarouselApi) {
    api.value = val
}

watchOnce(api, (api) => {
    if (!api) return
    totalCount.value = api.scrollSnapList().length
    current.value = api.selectedScrollSnap() + 1
    api.on("select", () => {
        current.value = api.selectedScrollSnap() + 1
    })
})

const normImages = computed<{ src: string; alt: string }[]>(() =>
    (props.images || []).map((it, i) =>
        typeof it === "string"
            ? { src: it, alt: `${props.altBase} ${i + 1}` }
            : { src: it.src, alt: it.alt ?? `${props.altBase} ${i + 1}` }
    )
)
</script>

<template>
    <div class="w-full">
        <Carousel class="relative w-full" :plugins="autoplay ? [plugin] : []" @init-api="setApi"
            @mouseenter="plugin.stop" @mouseleave="[plugin.reset(), plugin.play()]">
            <CarouselContent>
                <CarouselItem v-for="(img, index) in normImages" :key="index"
                    :class="['w-full', heightClass, rounded ? 'rounded-xl overflow-hidden' : '']">
                    <img :src="img.src" :alt="img.alt" :loading="eagerFirst && index === 0 ? 'eager' : 'lazy'"
                        decoding="async"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-[1.02]"
                        draggable="false" />
                </CarouselItem>
            </CarouselContent>

            <CarouselPrevious v-if="totalCount > 1" class="absolute left-2 top-1/2 -translate-y-1/2" />
            <CarouselNext v-if="totalCount > 1" class="absolute right-2 top-1/2 -translate-y-1/2" />
        </Carousel>

        <!-- contador -->
        <div v-if="totalCount > 1"
            class="absolute right-2 top-2 rounded-md bg-background/80 px-2 py-0.5 text-xs text-foreground shadow-sm backdrop-blur">
            {{ current }} / {{ totalCount }}
        </div>
    </div>
</template>
