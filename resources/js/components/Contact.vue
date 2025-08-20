<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { Phone, Mail, MapPin } from 'lucide-vue-next'

// dados de contato (fácil de trocar)
const phoneDisplay = '+55 (11) 99999-9999'
const phoneHref = 'tel:+5511999999999'

const emailDisplay = 'leonardo@unitbox.com.br'
const emailHref = 'mailto:leonardo@unitbox.com.br'

const addressDisplay = 'Rua Griffin, 192, Osasco — SP'
const mapsHref =
    'https://maps.google.com/?q=Rua+Griffin,+192,+Osasco,+SP'
</script>

<template>
    <section id="contact" class="relative">
        <div class="max-w-screen-xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
                <!-- Lado esquerdo: título e descrição -->
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

                <!-- Lado direito: card com contatos -->
                <Card class="rounded-3xl bg-muted/30 border-muted/30 shadow-sm backdrop-blur-sm">
                    <CardContent class="p-6 md:p-8">
                        <!-- item: telefone -->
                        <div class="flex items-start gap-4">
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border bg-background">
                                <Phone class="size-5" />
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Ligue para mim</p>
                                <a :href="phoneHref" class="mt-1 inline-block underline underline-offset-4">{{
                                    phoneDisplay }}</a>
                            </div>
                        </div>

                        <Separator class="my-6" />

                        <!-- item: e-mail -->
                        <div class="flex items-start gap-4">
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border bg-background">
                                <Mail class="size-5" />
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Escreva um e-mail</p>
                                <a :href="emailHref" class="mt-1 inline-block underline underline-offset-4">{{
                                    emailDisplay }}</a>
                            </div>
                        </div>

                        <Separator class="my-6" />

                        <!-- item: endereço -->
                        <div class="flex items-start gap-4">
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border bg-background">
                                <MapPin class="size-5" />
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold">Visite meu escritório</p>
                                <a :href="mapsHref" target="_blank" rel="noopener noreferrer"
                                    class="mt-1 inline-block underline underline-offset-4">{{ addressDisplay }}</a>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </section>
</template>
