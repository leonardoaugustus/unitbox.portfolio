<script setup lang="ts">
import Logo from '@/components/AppLogo.vue'
import NavMenu from '@/components/navbar/NavMenu.vue'

// shadcn-vue
import {
    Sheet,
    SheetTrigger,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetClose
} from '@/components/ui/sheet'
import { Button } from '@/components/ui/button'
</script>

<template>
    <!-- Exibe só no mobile -->
    <div class="md:hidden">
        <Sheet>
            <!-- Botão “hamburger” -->
            <SheetTrigger as-child>
                <Button variant="outline" size="icon" class="rounded-full h-10 w-10" aria-label="Abrir menu">
                    <!-- ícone hamburguer -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </Button>
            </SheetTrigger>

            <!-- Painel -->
            <SheetContent side="right" class="w-80 p-0">
                <div class="p-0 border-b">
                    <SheetHeader>
                        <SheetTitle>
                            <div class="flex items-center gap-2">
                                <Logo />
                                <span class="font-semibold">Leonardo Augusto</span>
                            </div>
                        </SheetTitle>
                    </SheetHeader>
                </div>

                <!-- Menu vertical (sem esconder no mobile) -->
                <nav class="p-4">
                    <NavMenu variant="sheet" class="mt-2" />

                    <!-- Fechar ao clicar em um item -->
                    <ul class="mt-6 space-y-2 text-sm text-muted-foreground">
                        <li>
                            <SheetClose as-child>
                                <a href="#about" class="block px-3 py-2 rounded-md hover:bg-muted">Ir para About</a>
                            </SheetClose>
                        </li>
                        <li>
                            <SheetClose as-child>
                                <a href="#experience" class="block px-3 py-2 rounded-md hover:bg-muted">Ir para
                                    Experience</a>
                            </SheetClose>
                        </li>
                        <li>
                            <SheetClose as-child>
                                <a href="#projects" class="block px-3 py-2 rounded-md hover:bg-muted">Ir para
                                    Projects</a>
                            </SheetClose>
                        </li>
                    </ul>
                </nav>
            </SheetContent>
        </Sheet>
    </div>
</template>
