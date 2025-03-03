<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
})

onMounted(() => {
    console.log('Component Nav onMounted hook called')
})
</script>
<template>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">

    <hr class="mt-0">

    <h6 style="color: white;"></h6>
    <!-- app menu -->
    <span></span>

  </div>
</template>
