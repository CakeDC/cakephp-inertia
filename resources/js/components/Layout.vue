<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'
import Header from '@/components/Theme/Header.vue'
import Nav from '@/components/Theme/Nav.vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Object|Array,
})


onMounted(() => {
    console.log('Layout onMounted hook called')

    document.getElementById('toggleSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });
})
</script>

<template>
    <div>
        <Header/>
        <Nav/>
        <div class="content">
            <slot />
        </div>
    </div>
</template>
