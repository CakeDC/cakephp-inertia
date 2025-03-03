<script setup>
import {Head, Link} from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
})


onMounted(() => {
    console.log('Component Header onMounted hook called')
})
</script>
<template>
    <div class="header">
        <div class="col-left">
            <h5 class="mb-0">APP</h5>
        </div>
        <div class="col-right">
            <nav class="menu-nav d-none d-lg-flex">
            </nav>
            <button class="btn btn-light d-lg-none" id="toggleSidebar"><i data-feather="menu"></i></button>
        </div>
    </div>
</template>
