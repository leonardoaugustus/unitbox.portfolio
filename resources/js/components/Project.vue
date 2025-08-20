<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'

// shadcn-vue
import { Card, CardContent } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'

type Project = {
    title: string
    description: string
    image: string
    tags: string[]
    liveUrl?: string
    codeUrl?: string
}

const projects: Project[] = [
    {
        title: 'E-Commerce Platform',
        description:
            'Plataforma completa com gestão de estoque em tempo real, pagamentos e dashboard administrativo.',
        image: '/placeholder.svg',
        tags: ['Next.js', 'TypeScript', 'Stripe', 'Prisma', 'PostgreSQL'],
        liveUrl: 'https://ecommerce-demo.com',
        codeUrl: 'https://github.com/username/ecommerce'
    },
    {
        title: 'AI Task Manager',
        description:
            'App que usa IA para categorizar, priorizar e sugerir agendamento ideal de tarefas.',
        image: '/placeholder.svg',
        tags: ['React', 'Python', 'TensorFlow', 'FastAPI', 'MongoDB'],
        liveUrl: 'https://ai-taskmanager.com',
        codeUrl: 'https://github.com/username/ai-taskmanager'
    },
    {
        title: 'Real-time Chat Application',
        description:
            'Chat em tempo real com envio de arquivos, chamadas de vídeo e salas privadas.',
        image: '/placeholder.svg',
        tags: ['React', 'Socket.io', 'WebRTC', 'Node.js', 'Redis'],
        liveUrl: 'https://chatapp-demo.com',
        codeUrl: 'https://github.com/username/chat-app'
    },
    {
        title: 'AI Image Generator',
        description:
            'Gerador de imagens via IA a partir de prompts, com histórico e compartilhamento.',
        image: '/placeholder.svg',
        tags: ['React', 'Next.js', 'Tailwind CSS', 'Shadcn UI'],
        liveUrl: 'https://ai-image-generator.com',
        codeUrl: 'https://github.com/username/ai-image-generator'
    }
]

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
                    Projects
                </span>
                <h2 class="text-4xl sm:text-5xl font-bold tracking-tight">Featured Work</h2>
                <p class="text-muted-foreground mt-2 sm:mt-4 text-lg">
                    Showcasing some of my best projects and technical achievements
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <Card v-for="(p, idx) in projects" :key="p.title"
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