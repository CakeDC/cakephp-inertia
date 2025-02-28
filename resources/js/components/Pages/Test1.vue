<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'
import Layout from '@/components/Layout.vue'

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
    <Layout>
        <Link href="/pages/test2">Test2</Link>
        <h1>Welcome</h1>
        <p>{{page.text}}</p>
        <p>{{page.other}}</p>
    </Layout>
</template>
