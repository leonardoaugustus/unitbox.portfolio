<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Card, CardContent } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { Phone, Mail, MapPin } from 'lucide-vue-next'

// dados de contato
const phoneDisplay = '+55 (11) 99999-9999'
const phoneHref = 'tel:+5511999999999'

const emailDisplay = 'leonardo@unitbox.com.br'
const emailHref = 'mailto:leonardo@unitbox.com.br'

const addressDisplay = 'Rua Griffin, 192, Osasco — SP'
const mapsHref = 'https://maps.google.com/?q=Rua+Griffin,+192,+Osasco,+SP'

// refs
const sectionRef = ref<HTMLElement | null>(null)
const showCard = ref(false)
let observer: IntersectionObserver | null = null

onMounted(() => {
    if (!sectionRef.value) return
    observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                showCard.value = true
                observer?.disconnect() // dispara só uma vez
            }
        },
        { threshold: 0.2 } // quando 20% da section aparecer
    )
    observer.observe(sectionRef.value)
})

onBeforeUnmount(() => observer?.disconnect())
</script>

<template>
    <section id="contact" ref="sectionRef" class="relative">
        <div class="max-w-screen-xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                <!-- Lado esquerdo -->
                <div>
                    <p class="tracking-[0.35em] text-xs text-muted-foreground mb-6">
                        ENTRE EM CONTATO COMIGO
                    </p>
                    <h2 class="text-4xl xs:text-5xl md:text-6xl font-bold tracking-tight leading-[1.1]">
                        Vamos conversar!
                    </h2>
                    <p class="mt-6 text-base md:text-lg text-muted-foreground max-w-[52ch]">
                        Entre em contato! Estou aqui para ajudar e respondo em até 24 horas.
                        Suas perguntas são importantes para mim.
                    </p>
                </div>

                <!-- Card com fade-in -->
                <Transition name="fade-up">
                    <Card v-if="showCard" class="relative overflow-hidden rounded-3xl border shadow-sm
                   bg-background/40 backdrop-blur-lg ring-1 ring-white/10
                   transition-colors">
                        <!-- Gradiente decorativo -->
                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-60" style="
                background:
                  radial-gradient(1200px 400px at 100% -20%, rgba(99,102,241,.12), transparent 60%),
                  radial-gradient(800px 400px at -10% 120%, rgba(34,197,94,.10), transparent 55%);
              " />
                        <CardContent class="relative p-6 md:p-8">
                            <!-- Telefone -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                                    <Phone class="size-5" />
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold">Ligue para mim</p>
                                    <a :href="phoneHref" class="mt-1 inline-block underline underline-offset-4">
                                        {{ phoneDisplay }}
                                    </a>
                                </div>
                            </div>

                            <Separator class="my-6 bg-border/60" />

                            <!-- Email -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                                    <Mail class="size-5" />
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold">Escreva um e-mail</p>
                                    <a :href="emailHref" class="mt-1 inline-block underline underline-offset-4">
                                        {{ emailDisplay }}
                                    </a>
                                </div>
                            </div>

                            <Separator class="my-6 bg-border/60" />

                            <!-- Endereço -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                                    <MapPin class="size-5" />
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold">Visite meu escritório</p>
                                    <a :href="mapsHref" target="_blank" rel="noopener noreferrer"
                                        class="mt-1 inline-block underline underline-offset-4">
                                        {{ addressDisplay }}
                                    </a>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </Transition>
            </div>
        </div>
    </section>
</template>

<style scoped>
.fade-up-enter-active {
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-up-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.fade-up-enter-to {
    opacity: 1;
    transform: translateY(0);
}
</style>