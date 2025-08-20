<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import { Progress } from '@/components/ui/progress'

const showing = ref(true)
const progress = ref(0)
const progressNum = computed(() => Number(progress.value)) // garante número

let tick: ReturnType<typeof setInterval> | null = null

function finish() {
  if (tick) clearInterval(tick)
  progress.value = 100
  // pequeno delay para “ver” 100% e sumir
  setTimeout(() => (showing.value = false), 200)
}

onMounted(() => {
  // anima até 90% enquanto a página carrega
  tick = setInterval(() => {
    if (progress.value < 90) progress.value += 2
  }, 80)

  if (document.readyState === 'complete') {
    finish()
  } else {
    window.addEventListener('load', finish, { once: true })
  }
})

onBeforeUnmount(() => {
  if (tick) clearInterval(tick)
})
</script>

<template>
  <Transition name="fade">
    <div v-if="showing" class="fixed inset-0 z-50 bg-background">
      <div class="relative h-1 w-full overflow-hidden">
        <!-- ✅ Progress do shadcn-vue -->
        <!-- TENTE PRIMEIRO model-value; se não preencher, troque para :value="progressNum" -->
        <Progress :model-value="progressNum" class="h-1 w-full rounded-none" />

        <!-- Fallback ultra fino (não vai aparecer “texto”) -->
        <div class="pointer-events-none absolute left-0 top-0 h-[1px] w-full" aria-hidden="true">
          <div class="h-full bg-primary" :style="{ width: progressNum + '%' }" />
        </div>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .35s
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0
}
</style>