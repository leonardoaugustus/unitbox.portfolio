// resources/js/composables/useI18n.ts
import { ref } from 'vue'

type Dict = Record<string, any>

const locale = ref<'en' | 'pt_BR'>('en')
const messages = ref<Dict>({})
const fallbackMessages = ref<Dict>({})

export function useI18n() {
    async function load(l = 'en') {
        const res = await fetch(`/i18n/${l}`)
        const data = await res.json()
        locale.value = data.locale
        messages.value = data.messages || {}
        fallbackMessages.value = data.fallbackMessages || {}
    }

    function t(path: string): string {
        const [group, ...rest] = path.split('.')
        const keyPath = rest.join('.')

        const val = keyPath
            ? messages.value?.[group]?.[keyPath]
            : messages.value?.[group]

        if (val != null) return val

        // fallback
        const fVal = keyPath
            ? fallbackMessages.value?.[group]?.[keyPath]
            : fallbackMessages.value?.[group]

        return fVal ?? path
    }

    return { locale, messages, load, t }
}