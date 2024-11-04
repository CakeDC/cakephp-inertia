<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

defineProps({
    csrfToken: String,
    flash: Array,
    page: Array,
})


onMounted(() => {
    console.log('Component Dashboard onMounted hook called')
})
</script>

<template>
    <main>
        <header>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>
