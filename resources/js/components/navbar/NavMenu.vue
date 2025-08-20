<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps<{
    orientation?: 'horizontal' | 'vertical'
    class?: string
}>()

const baseList =
    'gap-1 space-x-0 data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-start'
</script>

<template>
    <!-- Não force display aqui; deixe o UL controlar com hidden/md:flex -->
    <nav :class="['w-full', $props.class]">
        <ul :class="[
            // visibilidade controlada aqui:
            // escondido no mobile, flex a partir de md
            'hidden md:flex w-full items-center gap-3 justify-center',
            baseList,
            $props.orientation === 'vertical'
                ? 'md:flex-col md:items-start md:justify-start'
                : ''
        ]">
            <li>
                <Link href="#about" class="hover:underline">About</Link>
            </li>
            <li>
                <Link href="#experience" class="hover:underline">Experience</Link>
            </li>
            <li>
                <Link href="#projects" class="hover:underline">Projects</Link>
            </li>
        </ul>
    </nav>
</template>
