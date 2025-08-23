<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import { useI18n } from '@/composables/useI18n'
import { Card, CardContent } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'

const { t } = useI18n()

const projects = computed(() => t<any[]>('project.projects', []))

// animação
const sectionRef = ref<HTMLElement | null>(null)
const visible = ref(false)
let observer: IntersectionObserver | null = null

onMounted(() => {
    if (!sectionRef.value) return
    observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                visible.value = true
                if (observer) {
                    observer.disconnect() // dispara só uma vez
                }
            }
        },
        { threshold: 0.25 }
    )
    observer.observe(sectionRef.value)
})

onBeforeUnmount(() => {
    if (observer) observer.disconnect()
})
</script>

<template>
    <section id="projects" ref="sectionRef" class="relative py-20 px-6">
        <div class="max-w-screen-md mx-auto">
            <div class="text-center mb-12">
                <span
                    class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap bg-secondary text-secondary-foreground mb-4">
                    {{ t('project.tag') }}
                </span>
                <h2 class="text-4xl sm:text-5xl font-bold tracking-tight">{{ t('project.title') }}</h2>
                <p class="text-muted-foreground mt-2 sm:mt-4 text-lg">
                    {{ t('project.description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <Card v-for="(p, idx) in projects" :key="idx"
                    class="relative flex flex-col overflow-hidden rounded-xl border border-accent transition-all duration-300 hover:-translate-y-2 hover:border-primary/60 hover:shadow-lg"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                    :style="{ transitionDelay: visible ? `${idx * 150}ms` : '0ms' }">
                    <div class="relative h-64 overflow-hidden bg-accent">
                        <img :alt="p.title" :src="p.image" loading="lazy" decoding="async"
                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105" />
                    </div>

                    <CardContent class="flex-1 flex flex-col p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ p.title }}</h3>
                        <p class="text-muted-foreground mb-4">{{ p.description }}</p>

                        <div class="flex flex-wrap gap-2 mb-6">
                            <Badge v-for="tag in p.tags" :key="tag" variant="secondary" class="rounded-full">
                                {{ tag }}
                            </Badge>
                        </div>

                        <div class="flex gap-3 mt-auto">
                            <a v-if="p.liveUrl" :href="p.liveUrl" target="_blank" rel="noopener noreferrer">
                                <Button class="rounded-full h-9 px-4 py-2">Live Demo</Button>
                            </a>
                            <a v-if="p.codeUrl" :href="p.codeUrl" target="_blank" rel="noopener noreferrer">
                                <Button variant="outline" class="rounded-full h-9 px-4 py-2">View Code</Button>
                            </a>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </section>
</template>