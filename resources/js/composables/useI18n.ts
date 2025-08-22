// resources/js/composables/useI18n.ts
import { ref } from 'vue'

type Dict = Record<string, any>
export type Locale = 'en' | 'pt_BR'

const locale = ref<Locale>('en')
const messages = ref<Dict>({})
const fallbackMessages = ref<Dict>({})

export function useI18n() {
    async function load(l?: Locale) {
        const url = l ? `/i18n/${l}` : `/i18n`

        try {
            const res = await fetch(url, { credentials: 'same-origin' })
            if (!res.ok) throw new Error(`i18n fetch failed: ${res.status}`)
            const data = await res.json()

            locale.value = data.locale as Locale
            messages.value = data.messages || {}
            fallbackMessages.value = data.fallbackMessages || {}

            // Atualiza <html lang="..."> (ajuda SEO/acessibilidade)
            const html = document.documentElement
            const langCode = locale.value === 'pt_BR' ? 'pt-BR' : 'en'
            html.setAttribute('lang', langCode)

            try { localStorage.setItem('locale', locale.value) } catch { }
        } catch (err) {
            // Falhou? Mantém estado anterior e loga (sem quebrar a página)
            console.error('Falha ao carregar traduções:', err)
        }
    }

    /**
     * t() genérico:
     * - Por padrão retorna string
     * - Se você espera array/objeto, informe o tipo: t<MyType>('hero.tags', fallback)
     */
    function t<T = string>(path: string, fallback?: T): T {
        const [group, ...rest] = path.split('.')
        const keyPath = rest.join('.')

        const pick = (src: Dict) =>
            keyPath ? src?.[group]?.[keyPath] : src?.[group]

        const normalize = (v: unknown) => {
            if (typeof v !== 'string') return v as T
            // normaliza: \r\n -> \n, \r -> \n, "\\n" (barra+n literal) -> \n real
            return v
                .replace(/\r\n/g, '\n')
                .replace(/\r/g, '\n')
                .replace(/\\n/g, '\n') as unknown as T
        }

        const val = pick(messages.value)
        if (val != null) return normalize(val)

        const fVal = pick(fallbackMessages.value)
        if (fVal != null) return normalize(fVal)

        return (fallback ?? (path as unknown)) as T
    }

    return { locale, messages, load, t }
}