<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import { Card, CardContent } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { Mail } from 'lucide-vue-next'
import Whatsapp from '@/components/Whatsapp.vue'
import Linkedin from '@/components/Linkedin.vue'

import { useI18n } from '@/composables/useI18n'
const { t } = useI18n()


type ContactItem = { description?: string; display?: string; href?: string }
const phone    = computed<ContactItem>(() => t<ContactItem>('contact.phone', {} as ContactItem))
const email    = computed<ContactItem>(() => t<ContactItem>('contact.email', {} as ContactItem))
const linkedin = computed<ContactItem>(() => t<ContactItem>('contact.linkedin', {} as ContactItem))

// Intersection Observer (igual ao seu)
const sectionRef = ref<HTMLElement | null>(null)
const showCard = ref(false)
let observer: IntersectionObserver | null = null

onMounted(() => {
  if (!sectionRef.value) return
  observer = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
      showCard.value = true
      observer?.disconnect()
    }
  }, { threshold: 0.2 })
  observer.observe(sectionRef.value)
})

onBeforeUnmount(() => observer?.disconnect())
</script>

<template>
  <section id="contact" ref="sectionRef" class="relative">
    <div class="max-w-screen-xl mx-auto px-6 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
        <!-- Esquerda -->
        <div>
          <p class="tracking-[0.35em] text-xs text-muted-foreground mb-6">
            {{ t('contact.subtitle') }}
          </p>
          <h2 class="text-4xl xs:text-5xl md:text-6xl font-bold tracking-tight leading-[1.1]">
            {{ t('contact.title') }}
          </h2>
          <p class="mt-6 text-base md:text-lg text-muted-foreground max-w-[52ch]">
            {{ t('contact.description') }}
          </p>
        </div>

        <!-- Card com fade-in -->
        <Transition name="fade-up">
          <Card v-if="showCard" class="relative overflow-hidden rounded-3xl border shadow-sm
                       bg-background/40 backdrop-blur-lg ring-1 ring-white/10">
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-60" style="
              background:
                radial-gradient(1200px 400px at 100% -20%, rgba(99,102,241,.12), transparent 60%),
                radial-gradient(800px 400px at -10% 120%, rgba(34,197,94,.10), transparent 55%);
            " />
            <CardContent class="relative p-6 md:p-8">
              <!-- Telefone -->
              <div class="flex items-start gap-4">
                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                  <Whatsapp class="size-5" />
                </div>
                <div class="flex-1">
                  <p class="font-semibold">{{ phone.description }}</p>
                  <a :href="phone.href" class="mt-1 inline-block underline underline-offset-4">
                    {{ phone.display }}
                  </a>
                </div>
              </div>

              <Separator class="my-6 bg-border/60" />

              <!-- Email -->
              <div class="flex items-start gap-4">
                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                  <Mail class="size-5" />
                </div>
                <div class="flex-1">
                  <p class="font-semibold">{{ email.description }}</p>
                  <a :href="email.href" class="mt-1 inline-block underline underline-offset-4">
                    {{ email.display }}
                  </a>
                </div>
              </div>

              <Separator class="my-6 bg-border/60" />

              <!-- Linkedin -->
              <div class="flex items-start gap-4">
                <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl border bg-background/50 backdrop-blur-sm">
                  <Linkedin class="size-5" />
                </div>
                <div class="flex-1">
                  <p class="font-semibold">{{ linkedin.description }}</p>
                  <a :href="linkedin.href" class="mt-1 inline-block underline underline-offset-4">
                    {{ linkedin.display }}
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
.fade-up-enter-active { transition: opacity .6s ease, transform .6s ease; }
.fade-up-enter-from   { opacity: 0; transform: translateY(20px); }
.fade-up-enter-to     { opacity: 1; transform: translateY(0); }
</style>