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
        <h2 class="mt-3 mb-3">Dashboard</h2>
        <p>{{page.text}}</p>
    </Layout>
</template>
