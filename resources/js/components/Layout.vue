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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    </nav>
    <main class="container">
        <article>
            <slot />
        </article>
    </main>
</template>
