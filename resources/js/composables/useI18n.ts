// resources/js/composables/useI18n.ts
import { ref } from 'vue'

type Dict = Record<string, any>

const locale = ref<'en' | 'pt_BR'>('en')
const messages = ref<Dict>({})
const fallbackMessages = ref<Dict>({})

export function useI18n() {
    // ⬇️ Agora `l` é opcional. Sem parâmetro -> usa sessão no backend (/i18n)
    async function load(l?: 'en' | 'pt_BR') {
        const url = l ? `/i18n/${l}` : `/i18n`
        const res = await fetch(url, { credentials: 'same-origin' })
        const data = await res.json()

        locale.value = data.locale
        messages.value = data.messages || {}
        fallbackMessages.value = data.fallbackMessages || {}

        // (opcional) ajuda SEO/AT: atualiza o <html lang="...">
        const html = document.documentElement
        const langCode = data.locale === 'pt_BR' ? 'pt-BR' : 'en'
        html.setAttribute('lang', langCode)

        // (opcional) guardinha de UX local
        try { localStorage.setItem('locale', data.locale) } catch { }
    }

    function t(path: string): any {
        const [group, ...rest] = path.split('.')
        const keyPath = rest.join('.')

        const val = keyPath
            ? messages.value?.[group]?.[keyPath]
            : messages.value?.[group]

        if (val != null) return val

        const fVal = keyPath
            ? fallbackMessages.value?.[group]?.[keyPath]
            : fallbackMessages.value?.[group]

        return fVal ?? path
    }

    return { locale, messages, load, t }
}