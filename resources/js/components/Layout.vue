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
        <div class="container-fluid">
            <Link href="/pages/index" class="navbar-brand">Pages</Link>
            <Link href="/tags/index" class="navbar-brand">Tags</Link>
            <Link href="/categories/index" class="navbar-brand">Categories</Link>
            <div class="collapse navbar-collapse" id="navbarCollapse"></div>
        </div>
    </nav>
    <main class="container">
        <article>
            <slot />
        </article>
    </main>
</template>
