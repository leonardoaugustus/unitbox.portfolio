<script setup lang="ts">
import { computed } from 'vue'
import { useI18n } from '@/composables/useI18n'
import { Calendar } from 'lucide-vue-next'

const { t } = useI18n()
const companies = computed(() => t<any[]>('experience.companies', []))


</script>

<template>
    <section id="experience" class="relative py-20 px-6 mt-9">
        <div class="max-w-screen-md mx-auto">
            <div class="text-center mb-12"><span data-slot="badge"
                    class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-auto border-transparent bg-secondary text-secondary-foreground [a&amp;]:hover:bg-secondary/90 mb-4">Experience</span>
                <h2 class="text-4xl sm:text-5xl font-bold tracking-tight">{{ t('experience.title') }}</h2>
                <p class="text-muted-foreground mt-2 sm:mt-4 text-lg">
                    {{ t('experience.description') }}
                </p>
            </div>
            <div class="relative">
                <div v-for="(company, idx) in companies" :key="idx" class="relative pl-8 not-last:pb-12">
                    <!-- Linha da timeline -->
                    <div class="absolute left-0 top-2.5 h-full w-[2px] bg-muted">
                        <div
                            class="absolute h-3 w-3 -left-[5px] top-0 rounded-full border-2 border-primary bg-background">
                        </div>
                    </div>

                    <!-- Conteúdo -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 size-9 bg-accent rounded-full flex items-center justify-center">
                                <img :src="`${company.logo}`"
                                    alt="" class="object-cover">
                            </div>
                            <span class="text-lg font-semibold">{{ company.name }}</span>
                        </div>

                        <div>
                            <h3 class="text-xl font-medium">{{ company.position }}</h3>
                            <div class="flex items-center gap-2 mt-1 text-sm">
                                <Calendar class="size-4"/>
                                <span>{{ company.duration }}</span>
                            </div>
                        </div>

                        <p class="text-muted-foreground">{{ company.description }}</p>

                        <div class="flex flex-wrap gap-2">
                            <span v-for="tag in company.tags" :key="tag"
                                class="inline-flex items-center justify-center border px-2 py-0.5 text-xs font-medium rounded-full bg-secondary text-secondary-foreground">
                                {{ tag }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>