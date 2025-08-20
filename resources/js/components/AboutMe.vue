<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card'
</script>

<template>
  <section id="about" class="relative">
    <div class="max-w-screen-md mx-auto">
      <!-- Card estilo navegador -->
      <Card
        class="pt-0 rounded-xl border shadow-sm overflow-hidden bg-background/60 backdrop-blur supports-[backdrop-filter]:bg-background/50"
      >
        <!-- Barra superior estilo navegador -->
        <div class="flex items-center gap-2 px-4 py-2 border-b bg-muted/40">
          <!-- Botões macOS -->
          <div class="flex items-center gap-2">
            <button
              class="size-3 rounded-full bg-[#ff5f57] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)]"
              aria-label="Fechar"
            />
            <button
              class="size-3 rounded-full bg-[#febc2e] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)]"
              aria-label="Minimizar"
            />
            <button
              class="size-3 rounded-full bg-[#28c840] shadow-[inset_0_0_0_1px_rgba(0,0,0,.15)]"
              aria-label="Maximizar"
            />
          </div>

          <!-- Barra de navegação -->
          <div
            class="flex-1 mx-4 px-3 py-1 text-xs text-muted-foreground bg-background/70 rounded-md border border-muted-foreground/20 truncate select-none"
          >
            www.leonardoaugusto.dev/about
          </div>

          <!-- Ícone fictício à direita -->
          <div class="w-4 h-4 rounded-full bg-muted-foreground/40" />
        </div>

        <!-- Conteúdo -->
        <CardContent class="p-6">
          <div class="flex flex-col md:flex-row items-center gap-8">
            <!-- Texto -->
            <div class="flex-1 text-center md:text-left">
              <h2 class="text-2xl font-bold mb-4 tracking-tight">
                Passionate about creating impactful web experiences
              </h2>
              <p class="text-muted-foreground mb-4 text-justify">
                Com mais de 5 anos de experiência em desenvolvimento full-stack, sou especialista em construir aplicações web escaláveis utilizando tecnologias modernas.
                Desenvolvedor Sênior de Software e Produto,
                especializado em aplicações web modernas, automação de processos e
                soluções com Inteligência Artificial. Tenho forte atuação em software
                de telecomunicações e experiência como líder de times de desenvolvimento,
                transformando requisitos complexos em soluções digitais seguras, escaláveis
                e de fácil manutenção.
              </p>
            </div>

            <!-- Imagem + nome -->
            <div class="flex flex-col items-center">
              <div class="w-40 h-40 md:w-52 md:h-52 rounded-lg overflow-hidden bg-accent">
                <img
                  src="https://avatars.githubusercontent.com/u/62160298?v=4"
                  alt="Foto de Leonardo Augusto"
                  class="object-cover w-full h-full border-2 border-muted-foreground"
                />
              </div>
              <p class="mt-2 text-xs text-muted-foreground select-none">
                Leonardo Augusto.png
              </p>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  </section>
</template>
