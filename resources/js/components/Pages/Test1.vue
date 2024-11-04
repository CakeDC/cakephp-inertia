<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
})


onMounted(() => {
    console.log('Component Dashboard onMounted hook called')
})
</script>

<template>
    <div>
        <Link href="/pages/test2">Test2</Link>
        <h1>Welcome</h1>
        <p>{{page.text}}</p>
        <p>{{page.other}}</p>
    </div>
</template>
